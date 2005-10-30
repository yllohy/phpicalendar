<?php

/********************************************************************************
*	Modified from phpicalendar 2.0a distribution by Jim Hu
*	philosophical changes 
*		- instead of having separate generators, use a date range for all views (done)
*		- change the rss generation method to conform to standards(not done)
*	PHP note: #@ is error control operator to suppress execution halt on error
*		- used below to deal with undef?
*********************************************************************************/
define('BASE', '../');
include(BASE.'functions/ical_parser.php');

if ($enable_rss != 'yes') {
	die ("RSS feeds are not enabled on this site.");
}

//set the range of days to return based on the view chosen
$rssview = $_GET['rssview'];

if (!$getdate){$getdate = date("Ymd");}

switch ($rssview){
	case 'day':
		$fromdate = $getdate;
		$todate = $getdate;
		$theview = $lang['l_day'];
		break;
	case 'month':
		$parse_month = date ("Ym", strtotime($getdate));
		$fromdate = ($parse_month *100) + 1;
		$nextmonth = ($parse_month +1) * 100;   #should give the 0th day of following month
		$todate = date('Ymd',strtotime($nextmonth));	
		$theview = date('M Y',strtotime($fromdate));
		break;
	case 'daysfrom':
		$fromdate = $getdate;
		$todate = $getdate + $_GET['days'];
		#print "from:$fromdate to: $todate<br>";
		$theview = $_GET['days']." days from ".date('n/d/Y',strtotime($fromdate));
		break;
	case 'daysto':
		$todate = $getdate;
		$fromdate = $getdate - $_GET['days'];
		#print "from:$fromdate to: $todate<br>";
		$theview = $_GET['days']." days before ".date('n/d/Y',strtotime($todate));
		break;
	case 'range':
		$fromdate = $_GET['from'];
		$todate = $_GET['to'];
		$theview = date('n/d/Y',strtotime($fromdate)).'-'.date('n/d/Y',strtotime($todate));
		break;
	default:
		#default to week
		$fromdate = dateOfWeek($getdate, $week_start_day);
		$todate = $fromdate + 6;
		$theview = $lang['l_week']." of ".date('n/d/Y',strtotime($fromdate));

}
//Set calendar or calendar directory name for feed
//Note that this depends on other modifications I've made to 
//allow phpicalendar to use calendar subdirectories - see bbs

$cal_displayname = str_replace("32", " ", $cal);
if ($cal == $ALL_CALENDARS_COMBINED) {
	$temp = explode("/",$calendar_path);
	$cal_displayname = str_replace("32"," ",ucfirst(array_pop($temp)));
}

$events_count = 0;

// calculate a value for Last Modified and ETag
if ($cal == $ALL_CALENDARS_COMBINED) {
	$filemod = filemtime("$calendar_path");
}else{
	$filemod = filemtime("$calendar_path/$cal.ics");
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
$rss .= '<title>'.$cal_displayname.' - '.$theview.'</title>'."\n";
$rss .= '<link>'.htmlspecialchars ("$default_path").'</link>'."\n";
$rss .= '<description>'.$cal_displayname.' '.$lang['l_calendar'].' - '.$theview.'</description>'."\n";
$rss .= '<language>'.$rss_language.'</language>'."\n";
$rss .= '<copyright>Copyright '.date(Y).', '.htmlspecialchars ("$default_path").'</copyright>'."\n";

//generate the items
$numdays = round((strtotime($todate) - strtotime($fromdate))/(60*60*24)-1);
$thisdate = $fromdate; 	#	start at beginning of date range, 
						# 	note that usage of $thisdate is different from distribution
						# 	I use it as a date, dist uses it as a time
$i = 0;  #day counter

	do {
	$thisdate=date('Ymd', strtotime($thisdate));
	#echo "Date: $thisdate\n";
	$dayofweek = localizeDate ("%a %b %e %Y", strtotime($thisdate));
	if (isset($master_array[($thisdate)]) && sizeof($master_array[($thisdate)]) > 0) {
		foreach ($master_array[("$thisdate")] as $event_times) {
			foreach ($event_times as $val) {
				if(!$val["event_start"]){
					$event_start = "All Day";
				}else{	
					$event_start 	= @$val["event_start"];	
					$event_start 	= date ($timeFormat, @strtotime ("$event_start"));
				}	
				$event_text 	= stripslashes(urldecode($val["event_text"]));
				$event_text 	= strip_tags($event_text, '<b><i><u>');
				$event_text		= str_replace('&','&amp;',$event_text);
				$event_text		= str_replace('&amp;amp;','&amp;',$event_text);
			#uncomment for shorter event text with ...
			#	$event_text 	= word_wrap($event_text, 21, $tomorrows_events_lines); 		
				$description 	= stripslashes(urldecode($val["description"]));
				$description 	= strip_tags($description, '<b><i><u>');
				$description		= str_replace('&','&amp;',$description);
				$description		= str_replace('&amp;amp;','&amp;',$description);


				$rss_title		= htmlspecialchars ("$dayofweek: $event_text");
				$rss_link		= htmlspecialchars ("$default_path/day.php?getdate=$getdate&cal=$cal&cpath=$cpath");
				if ($description == '') $description = $event_text;
				$rss_description	= htmlspecialchars ("$dayofweek $event_start: $description");
				
				$rss .= '<item>'."\n";
				$rss .= '<title>'.$rss_title.'</title>'."\n";
				/*
				$rss .= '<event_start>'.$event_start.'</event_start>'."\n";
				$rss .= '<seminardate>'.$dayofweek.'</seminardate>'."\n";
				$rss .= '<seminarspeaker>'.$event_text.'</seminarspeaker>'."\n";
				$rss .= '<seminartitle>'.$description.'</seminartitle>'."\n";
				$rss .= '<tagged>'.$val["description"].'</tagged>'."\n";
				$rss .= '<seminarhost>'.$val['attendee'].'</seminarhost>'."\n";
				$rss .= '<organizer>'.$val['organizer'].'</organizer>'."\n";
				$rss .= '<status>'.$val['status'].'</status>'."\n";
				$location		= str_replace('&','&amp;',$val['location']);
				$location		= str_replace('&amp;amp;','&amp;',$location);
				$rss .= '<location>'.$location.'</location>';
				*/
				$rss .= '<link>'.$rss_link.'</link>'."\n";
				$rss .= '<description>'.$rss_description.'</description>'."\n";
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

header ("Content-Type: text/xml");

echo "$rss";

?>
