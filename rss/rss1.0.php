<?php

/********************************************************************************
changed to use rss_common
J. Hu 12/10/2008
*********************************************************************************/

   
define('BASE', '../');
require(BASE.'rss/rss_common.php');
function rss_top(){
	global $cal_displayname, $theview, $phpiCal_config, $cpath, $lang, $rss_link, $rss_language;
	$rss = 	"<?xml version=\"1.0\" encoding=\"UTF-8\"?>"."\n";
	
	/* Use 1.0 and strip encoding, use rss_language */
	$rss .= 	'<rdf:RDF 
		xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" 
		xmlns:ev="http://purl.org/rss/1.0/modules/event/"
		xmlns:dc="http://purl.org/dc/elements/1.1/"
		xmlns="http://purl.org/rss/1.0/">'."\n";
	
	$rss .= '<channel rdf:about="'.$phpiCal_config->default_path.'/rss/rss.php/';
	if (isset($cpath) && $cpath !='') $rss_link.="?cpath=$cpath";
	$rss .='">'."\n";
	
	$rss .= '<title>'.$cal_displayname;
	if ($theview !=""){$rss .= ' - '.$theview;} 
	$rss .= "</title>\n";
	
	$rss .= '<link>'.htmlspecialchars("$phpiCal_config->default_path").'</link>'."\n";
	$rss .= '<description>'.$cal_displayname.' '.$lang['l_calendar'].' - '.$theview.'</description>'."\n";
	#$rss .= '<language>'.$rss_language.'</language>'."\n";
	return $rss;
}
function rss_li($rss_link, $uid){
	return '<rdf:li rdf:resource="'.$rss_link.'&amp;uid='.$uid.'/" />'."\n";
}

function enclose_items($rss_items){
	return 	"<items>\n<rdf:Seq>\n".$rss_items."</rdf:Seq>\n</items>\n</channel>\n";
}

function rss_item(){
	global $uid,$event_start,$rss_title,$rss_link, $dayofweek, $event_text, $rss_description, $val;
	$rss_item = '<item rdf:about="'.$rss_link.'&amp;uid='.urlencode($uid).'/">'."\n";

	/* Create guid, and use uid to make link unique */
#	$rss .= '<guid isPermaLink="false">'.$rss_link.$uid.'</guid>'."\n";
	/* End guid modification */
	$rss_item .= '<title>'.$rss_title.'</title>'."\n";
	$rss .= '<ev:startdate>'.date("Y-m-d\TH:i:s", @$val["start_unixtime"]).'</ev:startdate>'."\n";
	$rss .= '<ev:enddate>'.date("Y-m-d\TH:i:s", @$val["end_unixtime"]).'</ev:enddate>'."\n";

	$rss_item .= '<link>'.$rss_link.'</link>'."\n";
	$rss_item .= '<description>'.$rss_description.'</description>'."\n";
	if (isset($val['location']) && $val['location'] !=''){
		$location		= str_replace('&','&amp;',$val['location']);
		$location		= str_replace('&amp;amp;','&amp;',$location);
		$rss_item .= '<ev:location>'.$location."</ev:location>\n";
	}	
	$rss_item .= '</item>'."\n";
	return $rss_item;
}

function rss_noitems(){
	$rss_item = '<item rdf:about="'.$default_path."\">\n";
	$rss_item .= '<title>No events found</title>'."\n";
	$rss_item .= '<link>'.htmlspecialchars ("$default_path").'</link>'."\n";
	$rss_item .= '</item>'."\n";
	return $rss_item;
}

function rss_close(){
	return "</rdf:RDF>\n";
}
?>
