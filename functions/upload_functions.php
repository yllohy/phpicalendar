<?php
// Is the file uploaded truly a file via HTTP POST - used to thwart a user from trying to trick the script from working on other files
//
// arg0: string filename
// returns boolean is the uploaded a file
function is_uploaded_file_v4 ($filename) {
    if (!$tmp_file = get_cfg_var('upload_tmp_dir')) {
        $tmp_file = dirname(tempnam('', ''));
    }
    $tmp_file .= '/' . basename($filename);
    // For Windows compat
    $filename = str_replace ("\\", "/", $filename);
    $tmp_file = str_replace ("\\", "/", $tmp_file);
    // User might have trailing slash in php.ini... 
    return (ereg_replace('/+', '/', $tmp_file) == $filename);
}

// return the appropriate error message if the file upload had an error
//
// arg0: array file array from $HTTP_POST_FILES
// returns string error message
function get_upload_error ($uploaded_file) {
	global $php_error_lang;
	global $upload_error_lang;
	global $upload_error_gen_lang;
	
	if (isset($uploaded_file['error'])) {
		// This is only available in PHP >= 4.2.0
		$error = $php_error_lang . " ";
		switch($uploaded_file['error']) {
			case 0: //no error; possible file attack!
			case 1: //uploaded file exceeds the upload_max_filesize directive in php.ini
			case 2: //uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form
			case 3: //uploaded file was only partially uploaded
			case 4: //no file was uploaded
				$error = $error . $uploaded_file['error'] . ": " . $upload_error_lang[$uploaded_file['error']];
				break;
			default: //a default error, just in case!  :)
				$error = $error . $uploaded_file['error'] . ": " . $upload_error_gen_lang;
				break;
		}
	}
	else {
		$error = $upload_error_gen_lang;
	}
	
	return $error;
}

// Check to see that the file has an .ics extension
//
// arg0: string filename
// returns booloean does the filename end in .ics
function is_uploaded_ics ($filename) {
	// Check the file extension for .ics. Can also check the the mime type, but it's not reliable so why bother...
	if(preg_match("/.ics$/i", $filename)) {
		return TRUE;
	}
	else {
		return FALSE;
	}
}

// Get all calendar filenames (not including path)
//
// argo: string path to calendar files
// returns array filenames (not including path)
function get_calendar_files($calendar_path) {
	global $error_path_lang;
	
	$dir_handle = @opendir($calendar_path) or die(error(sprintf($error_path_lang, $calendar_path)));
	$filelist = array();
	while ($file = readdir($dir_handle)) {
		if (substr($file, -4) == ".ics") {
			array_push($filelist, $file);
		}
	}
	closedir($dir_handle);
	natcasesort($filelist);
	return $filelist;
}

?>