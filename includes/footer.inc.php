<?php 

echo "<center class=\"V9\"><br>$powered_by_lang <a class=\"psf\" href=\"http://phpicalendar.sourceforge.net/nuke/\">PHP iCalendar 0.9.4</a>";
if ($enable_rss == 'yes') {
	echo "<br>\n";
	if ((isset($current_view)) && ($current_view == 'rssindex')) {
		echo '<a style="color:gray" href="http://feeds.archive.org/validator/check?url='.$footer_check.'"><img src="'.BASE.'images/valid-rss.png" alt="[Valid RSS]" title="Validate my RSS feed" width="88" height="31" border="1" vspace="3" />';
	} else {
		echo $this_site_is_lang.' <a class="psf" href="'.BASE.'rss/index.php?cal='.$cal.'&amp;getdate='.$getdate.'">RSS-Enabled</a>';
	}
}
echo '</center>';

?>

</body>
</html>
