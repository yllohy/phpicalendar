<?

$path = "/Users/clittle/Sites/php_ical/templates";
$dir_handle = @opendir($path) or die("Unable to open $path");
while ($file = readdir($dir_handle)) {
	$date = date("Ymd", filemtime($file));
	if (strstr ($file, ".ics")) {
	$listofiles[$date] = $file;
	}
}

closedir($dir_handle);
print_r($listofiles);

?>