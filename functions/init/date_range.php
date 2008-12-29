<?php
if (!isset($getdate)) {
	if (isset($_GET['getdate']) && ($_GET['getdate'] !== '')) {
		$getdate = $_GET['getdate'];
	} else {
		$getdate = date('Ymd', time() + $phpiCal_config->second_offset);
	}
}

preg_match ("/([0-9]{4})([0-9]{2})([0-9]{2})/", $getdate, $day_array2);
$this_day = $day_array2[3];
$this_month = $day_array2[2];
$this_year = $day_array2[1];

# set bounds on master_array
# mktime int mktime ( [int $hour [, int $minute [, int $second [, int $month [, int $day [, int $year [, int $is_dst]]]]]]] )
$start_month = $this_month - 1;
$start_year = $this_year;
$end_month = $this_month + 1;
$end_year = $this_year;
if ($this_month == 1){
	$start_month = 12;
	$start_year--;
}	
if ($this_month == 12){
	$end_month = 1;
	$end_year++;
}
switch ($current_view){
	case 'month':
	case 'week':
	case 'day':
		$mArray_begin = mktime (0,0,0,$start_month,1,($start_year));
		$mArray_end = mktime (0,0,0,$end_month,31,($end_year));
		break;
	case 'admin':
	case 'error':
	case 'preferences':
	case 'rss_index':
		$mArray_begin = time();
		$mArray_end = time();
		break;		
	case 'search':
		$mArray_begin = mktime (0,0,0,1,1,1970);
		$mArray_end = mktime (0,0,0,1,31,2030);
		break;		
	default:
		$mArray_begin = mktime (0,0,0,12,21,($this_year - 1));
		$mArray_end = mktime (0,0,0,1,31,($this_year + 1));
}
if ($phpiCal_config->save_parsed_cals == 'yes') {	
	$mArray_begin = mktime (0,0,0,12,21,($this_year - 1));
	$mArray_end = mktime (0,0,0,1,31,($this_year + 1));
}