<?php

/********************************************************************************
Changed to use rss_common for date handling and loop

*********************************************************************************/
   
define('BASE', '../');
$rss_version = '<rss version="0.91">'."\n";

require(BASE.'rss/rss_common.php');

function rss_top(){
	global $cal_displayname, $theview, $phpiCal_config, $cpath, $lang, $rss_link, $rss_language;
	$rss = 	"<?xml version=\"1.0\" encoding=\"UTF-8\"?>"."\n";
	$rss .= '<!DOCTYPE rss PUBLIC "-//Netscape Communications//DTD RSS 0.91//EN" "http://my.netscape.com/publish/formats/rss-0.91.dtd">'."\n";
	$rss .= '<rss version="0.91">'."\n";
	$rss .= '<channel>'."\n";
	$rss .= '<title>'.$cal_displayname;
	if ($theview !=""){$rss .= ' - '.$theview;} 
	$rss .= "</title>\n";
	
	$rss .= '<link>'.htmlspecialchars("$phpiCal_config->default_path").'</link>'."\n";
	if (isset($cpath) && $cpath !='') $rss_link.="?cpath=$cpath";
	$rss .= "<link>$rss_link</link>\n";
	
	$rss .= '<description>'.$cal_displayname.' '.$lang['l_calendar'].' - '.$theview.'</description>'."\n";
	$rss .= '<language>'.$rss_language.'</language>'."\n";
	$rss .= '<copyright>Copyright '.date("Y").', '.htmlspecialchars ("$default_path").'</copyright>'."\n";
	return $rss;
}

function rss_li($rss_link, $uid){
	$return = "";
}

function enclose_items($rss_items){
	return $rss_items;
}

function rss_item(){
	global $uid,$event_start,$rss_title,$rss_link, $dayofweek, $event_text, $rss_description, $val;
	$rss = '<item>'."\n";
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
	if (isset($val['location']) && $val['location'] !=''){
	$location		= str_replace('&','&amp;',$val['location']);
	$location		= str_replace('&amp;amp;','&amp;',$location);
		$rss .= '<location>'.$location."</location>\n";
	}	
	$rss .= '</item>'."\n";
	return $rss;
}
function rss_noitems(){
	global $default_path;
	$rss .= '<item>'."\n";
	$rss .= '<title>No events found</title>'."\n";
	$rss .= '<link>'.htmlspecialchars ("$default_path").'</link>'."\n";
	$rss .= '</item>'."\n";
	return $rss;
}

function rss_close(){
	return "</channel>\n</rss>\n";
}
?>
