<?
// function to determine the colspan for overlapping events
// takes 2 parameters: index of event (in regards of column output) and number of overlapping events
function eventWidth($ind, $overlaps) {
	switch ($overlaps) {
	// case 1 means 1 overlap -> two concurrent events etc.
		case 0:
			return 12;
			break;
		case 1:
			return 6;
			break;
		case 2:
			return 4;
			break;
		case 3:
			return 3;
			break;
		case 4:
			switch ($ind) {
				case 0:
					return 3;
					break;
				case 2:
					return 3;
					break;
				default:
					return 2;
			}
			break;
		case 5:
			return 2;
			break;
		case 6:
			switch ($ind) {
				case 0:
					return 1;
					break;
				case 3:
					return 1;
					break;
				default:
					return 2;
			}
			break;
		case 7:
			switch ($ind) {
				case 0:
					return 2;
					break;
				case 2:
					return 2;
					break;
				case 4:
					return 2;
					break;
				case 6:
					return 2;
					break;
				default:
					return 1;
			}
			break;
		case 8:
			switch ($ind) {
				case 0:
					return 2;
					break;
				case 3:
					return 2;
					break;
				case 6:
					return 2;
					break;
				default:
					return 1;
			}
			break;
		case 9:
			switch ($ind) {
				case 0:
					return 2;
					break;
				case 7:
					return 2;
					break;
				default:
					return 1;
			}
			break;
		case 10:
			switch ($ind) {
				case 5:
					return 2;
					break;
				default:
					return 1;
			}
			break;
		case 11:
			return 1;
			break;
	}
} 

// drei 20020921: function for checking and counting overlapping events
function checkOverlap() {
	global $master_array, $overlap_array, $start_date, $start_time, $end_time;

		$maxOverlaps = 0;
		if (sizeof($master_array[($start_date)]) > 0) {
			foreach ($master_array[($start_date)] as $keyTime => $eventTime) {
				foreach ($eventTime as $keyEvent => $event) {
					if (($event["event_start"] < $end_time) and ($event["event_end"] > $start_time)) {

						if ($event["event_start"] < $start_time) $overlap_start = $start_time;
						else $overlap_start = $event["event_start"];
						if ($event["event_end"] < $end_time) $overlap_end = $event["event_end"];
						else $overlap_end = $end_time;
						
						if (sizeof($overlap_array[($start_date)][($keyTime)][($keyEvent)]) > 0) {
							$newOverlapEntry = TRUE;
							foreach ($overlap_array[($start_date)][($keyTime)][($keyEvent)] as $keyOverlap => $overlapEntry) {
								if (($overlapEntry["start"] < $overlap_end) and ($overlapEntry["end"] > $overlap_start)) {
									$overlap_array[($start_date)][($keyTime)][($keyEvent)][($keyOverlap)]["count"]++;
									if ($overlapEntry["start"] < $overlap_start) {
										$overlap_array[($start_date)][($keyTime)][($keyEvent)][($keyOverlap)]["start"] = $overlap_start;
									}
									if ($overlapEntry["end"] > $overlap_end) {
										$overlap_array[($start_date)][($keyTime)][($keyEvent)][($keyOverlap)]["end"] = $overlap_end;
									}
									$newOverlapEntry = FALSE;
									break;
								}
							}
							if ($newOverlapEntry) {
								array_push($overlap_array[($start_date)][($keyTime)][($keyEvent)], array ("count" => 1,"start" => $overlap_start, "end" => $overlap_end));
							}
						} else {
							$overlap_array[($start_date)][($keyTime)][($keyEvent)][] = array ("count" => 1,"start" => $overlap_start, "end" => $overlap_end);
						}
						foreach ($overlap_array[($start_date)][($keyTime)][($keyEvent)] as $keyOverlap => $overlapEntry) {
							if ($overlapEntry["count"] > $maxOverlaps) $maxOverlaps = $overlapEntry["count"];
						}
						$master_array[($start_date)][($keyTime)][($keyEvent)]["event_overlap"] = $maxOverlaps;
					}
				}
			}
		}	

	return $maxOverlaps;
}
?>