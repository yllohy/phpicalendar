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
		$newMasterTime = $drawTimes["draw_start"];
		if (isset($master_array[($start_date)][($newMasterTime)])) $newMasterEventKey = sizeof($master_array[($start_date)][($newMasterTime)]);
		else $newMasterEventKey = 0;
		
		$maxOverlaps = 0;
		$newEventAdded = FALSE;
		if (isset($overlap_array[($start_date)])) {
			foreach ($overlap_array[($start_date)] as $loopBlockKey => $loopBlock) {
				// check for overlap with existing overlap block
				if (($loopBlock["blockStart"] < $drawTimes["draw_end"]) and ($loopBlock["blockEnd"] > $drawTimes["draw_start"])) {
					$newOverlapBlock = FALSE;
					// if necessary adjust start and end times of overlap block
					if ($loopBlock["blockStart"] > $drawTimes["draw_start"]) $overlap_array[($start_date)][($loopBlockKey)]["blockStart"] = $drawTimes["draw_start"];
					if ($loopBlock["blockEnd"] < $drawTimes["draw_end"]) $overlap_array[($start_date)][($loopBlockKey)]["blockEnd"] = $drawTimes["draw_end"];
					// add the new event to the array of events
					$overlap_array[($start_date)][($loopBlockKey)]["events"][] = array ("time" => $newMasterTime, "key" => $newMasterEventKey);
					// check if the adjusted overlap block must be merged with an existing overlap block
					reset($overlap_array[($start_date)]);
					do {
						$compBlockKey = key(current($overlap_array[($start_date)]));
						// only compare with other blocks
						if ($compBlockKey != $loopBlockKey) {
							// check if blocks overlap
							if (($overlap_array[($start_date)][($compBlockKey)]["blockStart"] < $overlap_array[($start_date)][($loopBlockKey)]["blockEnd"]) and ($overlap_array[($start_date)][($compBlockKey)]["blockEnd"] > $overlap_array[($start_date)][($loopBlockKey)]["blockStart"])) {
								// define start and end of merged overlap block
								if ($loopBlock["blockStart"] > $overlap_array[($start_date)][($compBlockKey)]["blockStart"]) $overlap_array[($start_date)][($loopBlockKey)]["blockStart"] = $overlap_array[($start_date)][($compBlockKey)]["blockStart"];
								if ($loopBlock["blockEnd"] < $overlap_array[($start_date)][($compBlockKey)]["blockEnd"]) $overlap_array[($start_date)][($loopBlockKey)]["blockEnd"] = $overlap_array[($start_date)][($compBlockKey)]["blockEnd"];
								$overlap_array[($start_date)][($loopBlockKey)]["events"] = array_merge($overlap_array[($start_date)][($loopBlockKey)]["events"],$overlap_array[($start_date)][($compBlockKey)]["events"]);
								$overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"] = array_merge($overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"],$overlap_array[($start_date)][($compBlockKey)]["overlapRanges"]);
								unset($overlap_array[($start_date)][($compBlockKey)]);
								reset($overlap_array[($start_date)]);
							}
						} 
					} while (next($overlap_array[($start_date)]));
					// insert new event to appropriate overlap range

					$newOverlapRange = TRUE;
					foreach ($overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"] as $keyOverlap => $overlapRange) {
						if (($overlapRange["start"] < $drawTimes["draw_end"]) and ($overlapRange["end"] > $drawTimes["draw_start"])) {
							$overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"][($keyOverlap)]["count"]++;
							if ($overlapRange["start"] < $drawTimes["draw_start"]) $overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"][($keyOverlap)]["start"] = $drawTimes["draw_start"];
							if ($overlapRange["end"] > $drawTimes["draw_end"]) $overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"][($keyOverlap)]["end"] = $drawTimes["draw_end"];
							$newOverlapRange = FALSE;
							break;
						}
					}
					if ($newOverlapRange) {
						foreach ($loopBlock["events"] as $blockEvents) {
							$eventDrawTimes = drawEventTimes($master_array[($start_date)][($blockEvents["time"])][($blockEvents["key"])]["event_start"], $master_array[($start_date)][($blockEvents["time"])][($blockEvents["key"])]["event_end"]);
							if (isset($eventDrawTimes["draw_start"], $eventDrawTimes["draw_end"], $drawTimes["draw_end"], $drawTimes["draw_start"]) && ($eventDrawTimes["draw_start"] < $drawTimes["draw_end"]) and ($eventDrawTimes["draw_end"] > $drawTimes["draw_start"])) {
								// define start time of overlap range and overlap block
								if ($eventDrawTimes["draw_start"] < $drawTimes["draw_start"]) $overlap_start = $drawTimes["draw_start"];
								else $overlap_start = $eventDrawTimes["draw_start"];
								// define end time of overlap range and overlap block
								if ($eventDrawTimes["draw_end"] > $drawTimes["draw_end"]) $overlap_end = $drawTimes["draw_end"];
								else $overlap_end = $eventDrawTimes["draw_end"];
								
								$newOverlapRange2 = TRUE;
								foreach ($overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"] as $keyOverlap => $overlapRange) {
									if (($overlapRange["start"] < $overlap_end) and ($overlapRange["end"] > $overlap_start)) {
										$overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"][($keyOverlap)]["count"]++;
										if ($overlapRange["start"] < $overlap_start) $overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"][($keyOverlap)]["start"] = $overlap_start;
										if ($overlapRange["end"] > $overlap_end) $overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"][($keyOverlap)]["end"] = $overlap_end;
										$newOverlapRange2 = FALSE;
										break;
									}
								}
								if ($newOverlapRange2) {
									array_push($overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"], array ("count" => 1,"start" => $overlap_start, "end" => $overlap_end));
								}
							}
						}
					}
					// determine the maximum overlaps for the current overlap block
					foreach ($overlap_array[($start_date)][($loopBlockKey)]["overlapRanges"] as $overlapRange) {
						if ($overlapRange["count"] > $maxOverlaps) $maxOverlaps = $overlapRange["count"];
					}
					$overlap_array[($start_date)][($loopBlockKey)]["maxOverlaps"] = $maxOverlaps;
					foreach ($overlap_array[($start_date)][($loopBlockKey)]["events"] as $updMasterEvent) {
						if (($updMasterEvent["time"] != $newMasterTime) or ($updMasterEvent["key"] != $newMasterEventKey)) {
							$master_array[($start_date)][($updMasterEvent["time"])][($updMasterEvent["key"])]["event_overlap"] = $maxOverlaps;
						}
					}
					$newEventAdded = TRUE;
					break;
				}
			}
		}
		if (!$newEventAdded) {
			if (isset($master_array[($start_date)])) {
				$newBlockKey = "";
				foreach ($master_array[($start_date)] as $keyTime => $eventTime) {
					foreach ($eventTime as $keyEvent => $event) {
						$entryDrawTimes =  drawEventTimes($event["event_start"], $event["event_end"]);
						if (isset($entryDrawTimes["draw_start"], $entryDrawTimes["draw_end"], $drawTimes["draw_end"], $drawTimes["draw_start"]) && ($entryDrawTimes["draw_start"] < $drawTimes["draw_end"]) and ($entryDrawTimes["draw_end"] > $drawTimes["draw_start"])) {
							// define start time of overlap range and overlap block
							if ($entryDrawTimes["draw_start"] < $drawTimes["draw_start"]) {
								$overlap_start = $drawTimes["draw_start"];
								$overlapBlock_start = $entryDrawTimes["draw_start"];
							} else {
								$overlap_start = $entryDrawTimes["draw_start"];
								$overlapBlock_start = $drawTimes["draw_start"];
							}
							// define end time of overlap range and overlap block
							if ($entryDrawTimes["draw_end"] > $drawTimes["draw_end"]) {
								$overlap_end = $drawTimes["draw_end"];
								$overlapBlock_end = $entryDrawTimes["draw_end"];
							} else {
								$overlap_end = $entryDrawTimes["draw_end"];
								$overlapBlock_end = $drawTimes["draw_end"];
							}
							if ($newBlockKey == "") {
								$overlap_array[($start_date)][] = array ("blockStart" => $overlapBlock_start, "blockEnd" => $overlapBlock_end, "maxOverlaps" => 1, "events" => array (array ("time" => $keyTime, "key" => $keyEvent), array ("time" => $newMasterTime, "key" => $newMasterEventKey)), "overlapRanges" => array (array ("count" => 1, "start" => $overlap_start, "end" => $overlap_end)));
								$maxOverlaps = 1;
								end($overlap_array[($start_date)]);
								$newBlockKey = key($overlap_array[($start_date)]);
							} else {
								if ($overlap_array[($start_date)][($newBlockKey)]["blockStart"] > $overlapBlock_start) $overlap_array[($start_date)][($newBlockKey)]["blockStart"] = $overlapBlock_start;
								if ($overlap_array[($start_date)][($newBlockKey)]["blockEnd"] < $overlapBlock_end) $overlap_array[($start_date)][($newBlockKey)]["blockEnd"] = $overlapBlock_end;
								$overlap_array[($start_date)][($newBlockKey)]["events"][] = array ("time" => $keyTime, "key" => $keyEvent);
								$overlap_array[($start_date)][($newBlockKey)]["overlapRanges"][] = array ("count" => 1, "start" => $overlap_start, "end" => $overlap_end);
							}
							// update master_array
							$master_array[($start_date)][($keyTime)][($keyEvent)]["event_overlap"] = $maxOverlaps;
						}
					}
				}
			}
		}

// for debugging the checkOverlap function
//print 'Date: ' . $start_date . ' / New Time: ' . $newMasterTime . ' / New Key: ' . $newMasterEventKey . '<br />';
//print '<pre>';
//print_r($overlap_array);
//print '</pre>';

	return $maxOverlaps;
}
?>