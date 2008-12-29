<?php

/********************************************************************************
*	Modified from phpicalendar 2.0a distribution by Jim Hu
*	philosophical changes 
*		- instead of having separate generators, use a date range for all views (done)
*		- change the rss generation method to conform to standards(not done)
*	PHP note: #@ is error control operator to suppress execution halt on error
*		- used below to deal with undef?
*
*	using rssview, RSS feeds can be specified to return events for a given day, week, month, or year 
*	feeds can be specified for a number of days to or from a given date
*	feeds can be specified for a range of dates
*
*********************************************************************************/

/* Modified from 2.21 by dyfrin 2006/03/08 19:09:28
   Changes:
   -RSS changed to 2.0, encoding removed, languages converted to ISO standard for feeds
   -RSS title changed to be set by config.inc.php.  Make sure that is added to it. 
   Lines modified: 135-165, 208-223
   Additional mods by J. Hu
*/
$current_view = 'rss';   
require(BASE.'functions/init.inc.php');

if ($phpiCal_config->enable_rss != 'yes') {
	die ("RSS feeds are not enabled on this site.");
}

include_once(BASE.'functions/date_functions.php');


//set the range of days to return based on the view chosen
$rssview = $_GET['rssview'];
if (isset($_GET['getdate']) && $_GET['getdate'] !=''){
	$getdate = $_GET['getdate'];
}else{
	$getdate = date("Ymd");
}
# for all views, $fromdate is the first day to be shown and $todate should be the last day.
switch ($rssview){
	case 'day':
		$fromdate = $getdate;
		$todate = date("Ymd", strtotime($getdate) + 60*60*24);
		$theview = $lang['l_day'];
		break;
	case 'today':
		$fromdate = date("Ymd");
		$todate = date("Ymd", strtotime('tomorrow'));
		$theview = $lang['l_todays'] ;
		break;
	case 'tomorrow':
		$fromdate = date("Ymd",strtotime('tomorrow'));
		$todate = date("Ymd", strtotime('tomorrow') + 60*60*24);
		$theview = $lang['l_tomorrows'] ;
		break;
	case 'week':
		$fromdate = dateOfWeek($getdate, 'Sunday');
		$todate = date("Ymd", strtotime($fromdate) + 6*24*60*60);
		$theview = $lang['l_week']." of ".date('n/d/Y',strtotime($fromdate));
		break;
	case 'month':
		$parse_month = date ("Ym", strtotime($getdate));
		$fromdate = ($parse_month *100) + 1;
		$todate = ($parse_month *100) + date("t",strtotime($getdate));
		$theview = date('M Y',strtotime($fromdate));
		break;
	case 'year':
		if(isset($_GET['year'])){
			$theyear = $_GET['year'];
		}else{
			$theyear = substr($getdate,0,4);
		}
		$fromdate = ($theyear*10000)+101;	
		$todate = date("Ymd", strtotime($theyear*10000+1231));
		$theview = $theyear;
		break;
	case 'daysfrom':
		$fromdate = $getdate;
		$todate = date("Ymd", strtotime($getdate) + $_GET['days']*60*60*24);
		$theview = $_GET['days']." days from ".date('n/d/Y',strtotime($fromdate));
		break;
	case 'daysto':
		$todate = $getdate;
		$fromdate = date("Ymd", strtotime($getdate) - $_GET['days']*60*60*24);
		$theview = $_GET['days']." days before ".date('n/d/Y',strtotime($todate));
		break;
	case 'range':
		if(isset($_GET['from'])){
		$fromdate = $_GET['from'];
		}else{
			$fromdate = $getdate;
		}
		$todate = $_GET['to'];
		$theview = date('n/d/Y',strtotime($fromdate)).'-'.date('n/d/Y',strtotime($todate));
		break;
	default:
		#default to week
		$fromdate = dateOfWeek($getdate, 'Sunday');
		$todate = date("Ymd", strtotime($fromdate) + 6*24*60*60);
		$theview = "";

}
#need to give ical_parser the most distant date to correctly set up master_array.
$getdate = $todate;
#echo "from:$fromdate to:$todate";

#Note that ical_parser supplies cal_displayname.
$current_view = 'rss';
$mArray_begin = strtotime($fromdate);
$mArray_end = strtotime($todate);

include(BASE.'functions/ical_parser.php');

$events_count = 0;

// calculate a value for Last Modified and ETag
$cal = implode(",",$cals);

//get filemtime from master array
$filemod = 0; #default to start of unix era, overwrite with most recent mtime from master array
foreach ($master_array['-4'] as $calinfo){
	if ($calinfo['mtime'] > $filemod) $filemod = $calinfo['mtime']; 
}	
$filemodtime = date("r", $filemod);

//send relevant headers
header ("Last-Modified: $filemodtime");
header ("ETag:\"$filemodtime\"");

// checks the user agents headers to see if they kept track of our
// stuff, if so be nice and send back a 304 and exit.

if ( (@$_SERVER['HTTP_IF_MODIFIED_SINCE'] == $filemodtime) || (@$_SERVER['HTTP_IF_NONE_MATCH'] == $filemodtime)){
	header ("HTTP/1.1 304 Not Modified");
	exit;
}

/* Change languages to ISO 639-1 to validate RSS without changing long version in config.inc.php */
$user_language = array ("english", "polish", "german", "french", "dutch", "italian", "japanese", "norwegian", "spanish",  "swedish", "portuguese", "catalan", "traditional_chinese", "esperanto", "korean");
$iso_language = array ("en", "pl", "de", "fr", "nl", "da", "it", "ja", "no", "es", "sv", "pt", "ca", "zh-tw", "eo", "ko");
$rss_language = str_replace($user_language, $iso_language, $language);
/* End language modification */

$rss = 	rss_top();

//generate the items
$numdays = round((strtotime($todate) - strtotime($fromdate))/(60*60*24))+1;
$thisdate = $fromdate; 	#	start at beginning of date range, 
						# 	note that usage of $thisdate is different from distribution
						# 	I use it as a date, dist uses it as a time
$thistime = strtotime($thisdate);						
$i = 1;  #day counter

$rss_list = '';
$rss_items = '';
$uid_arr = array();
do {
	$thisdate=date('Ymd', $thistime);
	#	echo "Date: $thisdate\ti:$i\tnumdays:$numdays<br>\n";
	$dayofweek = localizeDate ("%a %b %e %Y", strtotime($thisdate));
	if (isset($master_array[($thisdate)]) && sizeof($master_array[($thisdate)]) > 0) {
		foreach ($master_array[("$thisdate")] as $event_times) {
			foreach ($event_times as $uid=>$val) {
				#handle multiday all day events
				if(!isset($val["event_start"])){
					if (isset($uid_arr[$uid])){
						$uid_arr[$uid] .= "+$dayofweek" ;
						continue;
					}else{
						$uid_arr[$uid] = "$dayofweek" ;
					}
					$event_start = $lang['l_all_day'];
				}else{	
					$event_start 	= @$val["event_start"];	
					$event_start 	= date ($timeFormat, @strtotime ("$event_start"));
				}	
				$event_text 	= stripslashes(urldecode($val["event_text"]));
				$event_text 	= strip_tags($event_text, '<b><i><u>');
				$event_text		= str_replace('&','&amp;',$event_text);
				$event_text		= str_replace('&amp;amp;','&amp;',$event_text);
			#	$event_text		= urlencode($event_text);
			#uncomment for shorter event text with ...
			#	$event_text 	= word_wrap($event_text, 21, $tomorrows_events_lines); 		
				$description 	= stripslashes(urldecode($val["description"]));
				$description 	= strip_tags($description, '<b><i><u>');
				$description		= str_replace('&','&amp;',$description);
				$description		= str_replace('&amp;amp;','&amp;',$description);
				$rss_title		= urldecode ("$dayofweek: $event_text");	
				$urlcal 		= rawurlencode ("$cal");
				if (isset($rss_link_to_event) && $rss_link_to_event == 'yes'){
					$event_data = urlencode(serialize($val));
					$rss_link		= $phpiCal_config->default_path."/includes/event.php?getdate=$thisdate&amp;cal=$cal&amp;event_data=$event_data";
				}else{
					$rss_link		=  ($phpiCal_config->default_path."/day.php?getdate=$thisdate&amp;cal=$urlcal");
	
				}
				if (isset($cpath) && $cpath !='') $rss_link.="&amp;cpath=$cpath";
				$rss_description	= htmlspecialchars ("$dayofweek $event_start: $description");
				$rss_list .= rss_li($rss_link,$uid);
				$rss_items .= rss_item();
				$events_count++;
			}
		}
	}
	$thistime = $thistime+(60*60*24); # echo "$thisdate: ".strtotime($thisdate)."->$thistime<br>\n";
	$i++;	
} while ($i <= $numdays);
if (($events_count < 1) && ($i == $numdays)) $rss_items = rss_noitems();

$rss_list = enclose_items($rss_list);
$rss .= $rss_list.$rss_items.rss_close();

foreach ($uid_arr as $uid=>$date_range){
	#echo "date_range:$date_range<br>";

	if(strpos($date_range,"+")>0){
		#echo "+ in date_range<br>";
		$temp = explode("+",$date_range);
		$date_range = $temp[0].'-'.array_pop($temp);
	}
	$rss = str_replace("<uid>$uid</uid>\n<event_start>".$lang['l_all_day']."</event_start>","<uid>$uid</uid>\n<event_start>$date_range</event_start>", $rss);

}
header ("Content-Type: text/xml");

echo "$rss";

?>
