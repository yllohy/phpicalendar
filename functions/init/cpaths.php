<?php
# adjust paths in case they are incorrect
if ($phpiCal_config->default_path == '') {
	$p = str_replace("/rss","","http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']) );
	$phpiCal_config->setProperty('default_path', $p);
}

#cpath modifies the calendar path based on the url or cookie values.  This allows you to run multiple calendar subsets from a single phpicalendar installation. Operations on cpath are largely hidden from the end user.
if ($phpiCal_config->calendar_path == '') {
	$phpiCal_config->setProperty('calendar_path', BASE.'calendars');
}
$calendar_path = $phpiCal_config->calendar_path;
$cpath = ''; #initialize cpath to prevent later undef warnings.
if(isset($_REQUEST['cpath'])&& $_REQUEST['cpath'] !=''){
	$cpath 	= str_replace('..','',$_REQUEST['cpath']);				
	$calendar_path 	.= "/$cpath";				
#	$tmp_dir 	.= "/$cpath";				
}elseif(isset($phpiCal_config->default_cpath_check) && $phpiCal_config->default_cpath_check !='' ){
	$cpath 	= str_replace('..','',$default_cpath_check);				
	$calendar_path 	.= "/$cpath";				
#	$tmp_dir 	.= "/$cpath";
}
#these need cpath to be set
#set up specific template folder for a particular cpath
if (isset($user_template["$cpath"])){ 
  $template = $user_template["$cpath"]; 
}
#set up specific webcals for a particular cpath
if (isset($more_webcals[$cpath]) && is_array($more_webcals[$cpath])){
	foreach ($more_webcals[$cpath] as $wcal)$list_webcals[] = $wcal;
}
$phpiCal_config->setProperty('calendar_path',$calendar_path);