
<?php
if ($allow_language == "yes") {
    // start of <select> tag
    if (isset($getdate)) {
        $query="&getdate=$getdate";
    } else {
        $query="";
    }
    print "<form>\n<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value+'$query');\">\n";
    
    // open file
    $dir_handle = @opendir("languages/");
    $tmp_pref_language = urlencode(ucfirst($language));
    
    // build the <option> tags
    while ($file = readdir($dir_handle)) {
        if (substr($file, -8) == '.inc.php') {
            
            // $cal_filename is the filename of the calendar without .inc.php
            // $cal is a urlencoded version of $cal_filename
            // $cal_displayname is $cal_filename with occurrences of "32" replaced with " "
            $language_tmp = urlencode(ucfirst(substr($file, 0, -8)));
                if ($language_tmp == $tmp_pref_language) {
                    print "<option value=\"$current_view.php?chlang=$language_tmp\" selected>in $language_tmp</option>\n";
                } else {
                    print "<option value=\"$current_view.php?chlang=$language_tmp\">in $language_tmp</option>\n";    
                }        
        }
    }            
    
    
    // close file
    closedir($dir_handle);
    
    // finish <select>
    print "</select>\n</form>";
    
}
?>     