<?php
$ifile = @fopen($filename, "r");
if ($ifile == FALSE) exit(error($lang['l_error_cantopen'], $filename));
$nextline = fgets($ifile);
if (trim($nextline) != 'BEGIN:VCALENDAR') exit(error($lang['l_error_invalidcal'], $filename));

// read file in line by line
// XXX end line is skipped because of the 1-line readahead
$is_daylight = false;
$is_std = false;

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
			$is_std = true;
			$is_daylight = false;
			break;
		case 'END:STANDARD':
			$offset_s = $offset_to;
			$is_std = false;
			break;
		case 'BEGIN:DAYLIGHT':
			unset ($offset_d);
			$is_daylight = true;
			$is_std = false;
			break;
		case 'END:DAYLIGHT':
			$offset_d = $offset_to;
			$is_daylight = false;
			break;
		case 'END:VTIMEZONE':
			$tz_array[$tz_id] = array(
				0	=> $offset_s, 
				1	=> $offset_d,
				'dt_start' => @$begin_daylight,
				'st_start' => @$begin_std,
				'st_name'	=> @$st_name,
				'dt_name'	=> @$dt_name
				
				); #echo "<pre>$tz_id"; print_r($tz_array[$tz_id]);echo"</pre>";
			break;
		default:
			unset ($field, $data, $prop_pos, $property);
			if (ereg ("([^:]+):(.*)", $line, $line)){
				$field = $line[1];
				$data = $line[2];				
				$property = strtoupper($field);
				$prop_pos = strpos($property,';');
				if ($prop_pos !== false) $property = substr($property,0,$prop_pos);
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
					case 'DTSTART':
						if($is_std || $is_daylight){
							$datetime = extractDateTime($data, $property, $field); 
							$start_unixtime = $datetime[0];
							$start_date = $datetime[1];
							$year = substr($start_date,0,4);
							if($is_std) $begin_std[$year] = $data;
							if($is_daylight) $begin_daylight[$year] = $data;
						}
						break;
					case 'TZNAME':
						if($is_std) $st_name = $data;
						if($is_daylight) $dt_name = $data;
						break;
				}
			}	
	}
}

?>