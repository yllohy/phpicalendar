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
define('BASE', '../');
include(BASE.'functions/init.inc.php');

include_once(BASE.'functions/date_functions.php');


//set the range of days to return based on the view chosen
$rssview = $_GET['rssview'];
if (isset($_GET['getdate']) && $_GET['getdate'] !=''){
	$getdate = $_GET['getdate'];
}else{
	$getdate = date("Ymd");
}

switch ($rssview){
	case 'day':
		$fromdate = $getdate;
		$todate = $getdate;
		$theview = $lang['l_day'];
		break;
	case 'week':
		$fromdate = dateOfWeek($getdate, 'Sunday');
		$todate = $fromdate + 6;
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
			$theyear = date('Y');
		}
		$fromdate = ($theyear*10000)+101;	
		$todate = date("Ymd", strtotime($fromdate) + 365*60*60*24);
		$theview = $theyear;
		break;
	case 'daysfrom':
		$fromdate = $getdate;
		$todate = date("Ymd", strtotime($getdate) + $_GET['days']*60*60*24);
		#print "from:$fromdate to: $todate<br>";
		$theview = $_GET['days']." days from ".date('n/d/Y',strtotime($fromdate));
		break;
	case 'daysto':
		$todate = $getdate;
		$fromdate = date("Ymd", strtotime($getdate) - $_GET['days']*60*60*24);
		#print "from:$fromdate to: $todate<br>";
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
		$todate = $fromdate + 6;
		$theview = "";

}
#need to give ical_parser the most distant date to correctly set up master_array.
$getdate = $todate;
#echo "from:$fromdate to:$todate";
include(BASE.'functions/ical_parser.php');
if ($enable_rss != 'yes') {
	die ("RSS feeds are not enabled on this site.");
}

//Set calendar or calendar directory name for feed
//Note that this depends on other modifications I've made to 
//allow phpicalendar to use calendar subdirectories - see bbs

$cal_displayname = urldecode($cal);
if ($cal == $ALL_CALENDARS_COMBINED) {
	$temp = explode("/",$calendar_path);
	$cal_displayname = str_replace("32"," ",ucfirst(array_pop($temp)));
}

$events_count = 0;

// calculate a value for Last Modified and ETag
$filemod = time(); #default to now in case filemtime can't find the mod date
$cal = str_replace("+"," ",$cal);
$calendar_path = str_replace("+"," ",$calendar_path);
$filemod = time(); #default to now in case filemtime can't find the mod date
$cal = str_replace("+"," ",$cal);
$calendar_path = str_replace("+"," ",$calendar_path);
if ($cal == $ALL_CALENDARS_COMBINED) {
	$filemod = filemtime("$calendar_path");
}else{
	if (is_file("$calendar_path/$cal.ics")){
	$filemod = filemtime("$calendar_path/$cal.ics");
}	
}	
$filemodtime = date("r", $filemod);

//send relevant headers
header ("Last-Modified: $filemodtime");
header ("ETag:\"$filemodtime\"");

// checks the user agents headers to see if they kept track of our
// stuff, if so be nice and send back a 304 and exit.

if ( ($_SERVER['HTTP_IF_MODIFIED_SINCE'] == $filemodtime) || ($_SERVER['HTTP_IF_NONE_MATCH'] == $filemodtime))
{
	header ("HTTP/1.1 304 Not Modified");
	exit;
}

//If client needs new feed - make the header
$rss = 	"<?xml version=\"1.0\" encoding=\"UTF-8\"?>"."\n";
$rss .= '<!DOCTYPE rss PUBLIC "-//Netscape Communications//DTD RSS 0.91//EN" "http://my.netscape.com/publish/formats/rss-0.91.dtd">'."\n";
$rss .= '<rss version="0.91">'."\n";
$rss .= '<channel>'."\n";
$rss .= '<title>'.$cal_displayname;
if ($theview !=""){$rss .= ' - '.$theview;} 
$rss .= "</title>\n";
$rss .= '<link>'.htmlspecialchars ("$default_path").'</link>'."\n";
$rss .= '<description>'.$cal_displayname.' '.$lang['l_calendar'].' - '.$theview.'</description>'."\n";
$rss .= '<language>'.$language.'</language>'."\n";
$rss .= '<copyright>Copyright '.date('Y').', '.htmlspecialchars ("$default_path").'</copyright>'."\n";

//generate the items
$numdays = round((strtotime($todate) - strtotime($fromdate))/(60*60*24)+1);
$thisdate = $fromdate; 	#	start at beginning of date range, 
						# 	note that usage of $thisdate is different from distribution
						# 	I use it as a date, dist uses it as a time
$i = 0;  #day counter
$uid_arr = array();
	do {
	$thisdate=date('Ymd', strtotime($thisdate));
	#echo "Date: $thisdate<br>\n";
	$dayofweek = localizeDate ("%a %b %e %Y", strtotime($thisdate));
	if (isset($master_array[($thisdate)]) && sizeof($master_array[($thisdate)]) > 0) {
		foreach ($master_array[("$thisdate")] as $event_times) {
			foreach ($event_times as $uid=>$val) {
				#handle multiday all day events
				if(!$val["event_start"]){
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
				$event_text		= urlencode($event_text);
			#uncomment for shorter event text with ...
			#	$event_text 	= word_wrap($event_text, 21, $tomorrows_events_lines); 		
				$description 	= stripslashes(urldecode($val["description"]));
				$description 	= strip_tags($description, '<b><i><u>');
				$description		= str_replace('&','&amp;',$description);
				$description		= str_replace('&amp;amp;','&amp;',$description);


				$rss_title		= urldecode ("$dayofweek: $event_text");
				$rss_link		= htmlspecialchars ("$default_path/day.php?getdate=$thisdate&cal=$cal&cpath=$cpath");
				$rss_description	= htmlspecialchars ("$dayofweek $event_start: $description");
				
				$rss .= '<item>'."\n";
				$rss .= '<uid>'.$uid.'</uid>'."\n";
				$rss .= '<event_start>'.$event_start.'</event_start>'."\n";
				$rss .= '<title>'.$rss_title.'</title>'."\n";
				/* custom stuff for Jim Hu's RSS feeds. Deprecated
				$rss .= '<seminardate>'.$dayofweek.'</seminardate>'."\n";
				$rss .= '<seminarspeaker>'.$event_text.'</seminarspeaker>'."\n";
				$rss .= '<seminartitle>'.$description.'</seminartitle>'."\n";
				$rss .= '<tagged>'.$val["description"].'</tagged>'."\n";
				$rss .= '<seminarhost>'.$val['attendee'].'</seminarhost>'."\n";
				$rss .= '<organizer>'.$val['organizer'].'</organizer>'."\n";
				$rss .= '<status>'.$val['status'].'</status>'."\n";
				*/
				$rss .= '<link>'.$rss_link.'</link>'."\n";
				$rss .= '<description>'.$rss_description.'</description>'."\n";
				$location		= str_replace('&','&amp;',$val['location']);
				$location		= str_replace('&amp;amp;','&amp;',$location);
				$rss .= '<location>'.$location.'</location>';
				$rss .= '</item>'."\n";
				$events_count++;
			}
		}
	}
	if (($events_count < 1) && ($i == $numdays)) {
		$rss .= '<item>'."\n";
		$rss .= '<title>No events found</title>'."\n";
		$rss .= '<link>'.htmlspecialchars ("$default_path").'</link>'."\n";
		$rss .= '</item>'."\n";
	}
	$thisdate++;
	$i++;	
	} while ($i <= $numdays);

$rss .= '</channel>'."\n";
$rss .= '</rss>'."\n";

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
