<?php
/**
 * Sanitizes variables and arrays in a recursive manner
 *
 * This method was created as a result of strip_tags() happening on an array
 * would destroy the contents of the array. Thus, in order to avoid this from
 * happening we need checks to see if something is an array and to process
 * it as such.
 *
 * The only sanitizing this method provides is stripping non-allowed tags.
 *
 * @author Christopher Weldon <cweldon@tamu.edu>
 * @param mixed $value Value to be sanitized
 * @return mixed
 */
function recursiveSanitize($value) {
    if (is_array($value)) {
        $valmod = array();
        foreach ($value as $key => $subval) {
            if (is_array($subval)) {
                $subval = recursiveSanitize($subval);
            } else {
                $subval = strip_tags($subval);
            }
            $valmod[$key] = $subval;
        }
        $value = $valmod;
    } else {
        $value = strip_tags($value);
    }
    
    return $value;
}

if (!isset($_SERVER) && isset($HTTP_SERVER_VARS)) {
	$_SERVER = &$HTTP_SERVER_VARS;
}

foreach ($_REQUEST as $key=>$val){
	switch ($key){
		case 'event_data':
			# modify this to allow or disallow different HTML tags in event popups
			$allowed = "<p><br><b><i><em><a><img><div><span><ul><ol><li><h1><h2><h3><h4><h5><h6><hr><em><strong><small><table><tr><td><th>";
			$val = strip_tags($val,$allowed);
			break;
		default:	
			# cpath
			$val = recursiveSanitize($val);
	}

	$_REQUEST[$key] = $val;
}
foreach ($_POST as $key=>$val){
	switch ($key){
		case 'action':
			$actions = array('login','logout','addupdate','delete');
			if (!in_array($val,$actions)) $val = '';
			break;
		case 'date':
		case 'time':
			if (!is_numeric($val)) $val = '';
			break;
		default:	
			$val = recursiveSanitize($val);
	}
	$_POST[$key] = $val;

}
foreach ($_GET as $key=>$val){
	switch ($key){
		case 'cal':
			if (!is_array($val)){
				$val = strip_tags($val);
				$_GET['cal'] = strip_tags($val);
			}else{
				unset ($_GET['cal']);
				foreach($val as $cal){
					$_GET['cal'][]= strip_tags($cal);
				}
			}
			break;
		case 'getdate':
			if (!is_numeric($val)) $val = ''; 
			break;
		default:	
			$val = recursiveSanitize($val);
	}
	if ($key != 'cal') $_GET[$key] = $val;

}
foreach ($_COOKIE as $key=>$val){
	switch ($key){
		case 'time':
			if (!is_numeric($val)) $val = '';
			break;
		default:	
		$val = recursiveSanitize($val);
	}
	$_COOKIE[$key] = $val;
}
?>