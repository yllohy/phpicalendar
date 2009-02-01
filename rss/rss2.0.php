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
*/
   
define('BASE', '../');
require(BASE.'rss/rss_common.php');
function rss_top(){
	global $cal_displayname, $theview, $phpiCal_config, $cpath, $lang, $rss_link, $rss_language;

	$rss = 	"<?xml version=\"1.0\" encoding=\"UTF-8\"?>"."\n";
	/* Use 2.0 and strip encoding, use rss_language */
	$rss .= '<rss version="2.0"'."\n";
	$rss .= 	'xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"  
	xmlns:ev="http://purl.org/rss/1.0/modules/event/" '.
#	'xmlns:atom="http://www.w3.org/2005/Atom"'.
	'xmlns:dc="http://purl.org/dc/elements/1.1/">'."\n";
	$rss .= '<channel>'."\n";
	$rss .= '<title>'.$cal_displayname;
	if ($theview !=""){$rss .= ' - '.$theview;} 
	$rss .= "</title>\n";
	
	$rss .= '<link>'.$phpiCal_config->default_path.'/rss/rss2.0.php/';
	if (isset($cpath) && $cpath !='') $rss_link.="?cpath=$cpath";
	$rss .='</link>'."\n";
	$rss .= '<description>'.$cal_displayname.' '.$lang['l_calendar'].' - '.$theview.'</description>'."\n";
	$rss .= '<language>'.$rss_language.'</language>'."\n";
	return $rss;
}

function rss_li($rss_link, $uid){
	$return = "";
}

function enclose_items($rss_items){
	return $rss_items;
}

function rss_item(){
	global $uid,$event_start,$rss_title,$rss_link, $dayofweek, $event_text, $rss_description, $val, $thisdate;
	$rss = '<item>'."\n";
	/* Create guid, and use uid to make link unique */
	$rss .= '<guid isPermaLink="false">'.$rss_link.'&amp;uid='.$uid.'</guid>'."\n";
	/* End guid modification */
	$rss .= '<title>'.$rss_title.'</title>'."\n";
	$rss .= '<ev:startdate>'.date("Y-m-d\TH:i:s", @$val["start_unixtime"]).'</ev:startdate>'."\n";
	$rss .= '<ev:enddate>'.date("Y-m-d\TH:i:s", @$val["end_unixtime"]).'</ev:enddate>'."\n";

	$rss .= '<link>'.$rss_link.'</link>'."\n";
	$rss .= '<description>'.$rss_description.'</description>'."\n";
	if (isset($val['location']) && $val['location'] !=''){
		$location		= str_replace('&','&amp;',$val['location']);
		$location		= str_replace('&amp;amp;','&amp;',$location);
		$rss .= '<ev:location>'.$location."</ev:location>\n";
	}	
	$rss .= '</item>'."\n";
	return $rss;
}

function rss_noitems(){
	$rss = '<item>'."\n";
	$rss .= '<guid isPermaLink="false">'.$default_path.'&amp;uid='.$thisdate.'</guid>'."\n";
	$rss .= '<title>No events found</title>'."\n";
	$rss .= '<link>'.htmlspecialchars ("$default_path").'</link>'."\n";
	$rss .= '</item>'."\n";
	return $rss;	
}

function rss_close(){
	global $rss_link;
	return "\n".
#	"<atom:link href=\"$rss_link\" rel=\"self\" type=\"application/rss+xml\" />\n".
	"</channel>\n</rss>\n";
}
?>
