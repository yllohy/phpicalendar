<?php
$ifile = @fopen($filename, "r");
if ($ifile == FALSE) exit(error($lang['l_error_cantopen'], $filename));
$nextline = fgets($ifile, 1024);
if (trim($nextline) != 'BEGIN:VCALENDAR') exit(error($lang['l_error_invalidcal'], $filename));

// read file in line by line
// XXX end line is skipped because of the 1-line readahead
while (!feof($ifile)) {
	$line = $nextline;
	$nextline = fgets($ifile, 1024);
	$nextline = ereg_replace("[\r\n]", "", $nextline);
	#handle continuation lines that start with either a space or a tab (MS Outlook)
	while (isset($nextline{0}) && ($nextline{0} == " " || $nextline{0} == "\t")) { 
		$line = $line . substr($nextline, 1);
		$nextline = fgets($ifile, 1024);
		$nextline = ereg_replace("[\r\n]", "", $nextline);
	}
	$line = trim($line);
	
	switch ($line) {
		case 'BEGIN:VTIMEZONE':
			unset($tz_name, $offset_from, $offset_to, $tz_id);
			break;
		case 'BEGIN:STANDARD':
			unset ($offset_s);
			break;
		case 'END:STANDARD':
			$offset_s = $offset_to;
			break;
		case 'BEGIN:DAYLIGHT':
			unset ($offset_d);
			break;
		case 'END:DAYLIGHT':
			$offset_d = $offset_to;
			break;
		case 'END:VTIMEZONE':
			$tz_array[$tz_id] = array($offset_s, $offset_d); #echo "<pre>$tz_id"; print_r($tz_array[$tz_id]);echo"</pre>";
			break;
		default:
			unset ( $data, $prop_pos, $property);
			if (ereg ("([^:]+):(.*)", $line, $line)){
				$property = $line[1];
				$data = $line[2];
				$prop_pos = strpos($property,';');
				if ($prop_pos !== false) $property = substr($property,0,$prop_pos);
				$property = strtoupper($property);
			
				switch ($property) {		
					case 'TZID':
						$tz_id = $data;
						break;
					case 'TZOFFSETFROM':
						$offset_from = $data;
						break;
					case 'TZOFFSETTO':
						$offset_to = $data;
						break;
				}
			}	
	}
}

?>