<?php
// function to determine maximum necessary columns per day
// actually an algorithm to get the smallest multiple for two numbers
function kgv($a, $b) {
	$x = $a;
	$y = $b;
	while ($x != $y) {
		if ($x < $y) $x += $a;
		else $y += $b;
	}
	return $x;
}


// drei 20020921: function for checking and counting overlapping events
function checkOverlap() {
	global $master_array, $overlap_array, $start_date, $start_time, $end_time;

		$drawTimes = drawEventTimes($start_time, $end_time);
		$maxOverlaps = 0;
		if (isset($master_array[($start_date)]) && sizeof($master_array[($start_date)]) > 0) {
			foreach ($master_array[($start_date)] as $keyTime => $eventTime) {
				foreach ($eventTime as $keyEvent => $event) {
					if (isset($event["event_start"], $drawTimes["draw_end"], $event["event_end"], $drawTimes["draw_start"]) && ($event["event_start"] < $drawTimes["draw_end"]) and ($event["event_end"] > $drawTimes["draw_start"])) {

						if ($event["event_start"] < $drawTimes["draw_start"]) $overlap_start = $drawTimes["draw_start"];
						else $overlap_start = $event["event_start"];
						if ($event["event_end"] < $drawTimes["draw_end"]) $overlap_end = $event["event_end"];
						else $overlap_end = $drawTimes["draw_end"];
						
						if (isset($overlap_array[($start_date)][($keyTime)][($keyEvent)]) && sizeof($overlap_array[($start_date)][($keyTime)][($keyEvent)]) > 0) {
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