<?php

print "<form>\n<select name=\"action\" class=\"query_style\">\n";
$dir_handle = @opendir(BASE.'languages/');
$tmp_pref_language = urlencode(ucfirst($language));
while ($file = readdir($dir_handle)) {
	if (substr($file, -8) == ".inc.php") {
		$language_tmp = urlencode(ucfirst(substr($file, 0, -8)));
		if ($language_tmp == $tmp_pref_language) {
			print "<option value=\"$current_view.php?chlang=$language_tmp\" selected>in $language_tmp</option>\n";
		} else {
			print "<option value=\"$current_view.php?chlang=$language_tmp\">in $language_tmp</option>\n";
		}
	}
}

closedir($dir_handle);
print "</select>\n</form>\n";

?>     