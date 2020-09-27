<?php

$format = "Y-m-d H:i";
$timeFormat = "H:i";
$fromTime = DateTime::createFromFormat($format, '2020-02-02 6:00');
$toTime = DateTime::createFromFormat($format, '2020-02-02 08:30');
$interval = 30; // minutes

$rangeArr = array("rate1" => 0, "rate2" => 0, "rate3" => 0);

while($fromTime < $toTime){
	$dayOfWeek = $fromTime->format('N');
	$isSunday = $dayOfWeek == 7;
	$isSaturday = $dayOfWeek == 6;
	$isWorkingDay = $dayOfWeek >=1 && $dayOfWeek < 6;

	if($isSaturday){
		$rate3StartTime = DateTime::createFromFormat($timeFormat, '0:00')->format('H:i');
		$rate3EndTime = DateTime::createFromFormat($timeFormat, '6:59')->format("H:i");
		
		$rate2StartTime = DateTime::createFromFormat($timeFormat, '7:00')->format("H:i");
		$rate2EndTime = DateTime::createFromFormat($timeFormat, '23:59')->format("H:i");

		$tempFromTime = $fromTime->format("H:i");

		if($tempFromTime >= $rate2StartTime && $tempFromTime <= $rate2EndTime){
			$rangeArr["rate2"] += $interval;
		}
		if($tempFromTime >= $rate3StartTime && $tempFromTime <= $rate3EndTime){
			$rangeArr["rate3"] += $interval;
		}
	}
	if($isSunday){
		$rate3StartTime = DateTime::createFromFormat($timeFormat, '0:00')->format("H:i");
		$rate3EndTime = DateTime::createFromFormat($timeFormat, '23:59')->format("H:i");

		$tempFromTime = $fromTime->format("H:i");
		if($tempFromTime >= $rate3StartTime && $tempFromTime <= $rate3EndTime){
			$rangeArr["rate3"] += $interval;
		}
	}
	if($isWorkingDay){
		$rate3StartTime = DateTime::createFromFormat($timeFormat, '0:00')->format('H:i');
		$rate3EndTime = DateTime::createFromFormat($timeFormat, '06:59')->format("H:i");

		$rate1StartTime = DateTime::createFromFormat($timeFormat, '7:00')->format('H:i');
		$rate1EndTime = DateTime::createFromFormat($timeFormat, '21:59')->format("H:i");
		
		$rate2StartTime = DateTime::createFromFormat($timeFormat, '20:00')->format("H:i");
		$rate2EndTime = DateTime::createFromFormat($timeFormat, '23:59')->format("H:i");

		$tempFromTime = $fromTime->format("H:i");

		if($tempFromTime >= $rate1StartTime && $tempFromTime <= $rate1EndTime){
			$rangeArr["rate1"] += $interval;
		}
		if($tempFromTime >= $rate2StartTime && $tempFromTime <= $rate2EndTime){
			$rangeArr["rate2"] += $interval;
		}
		if($tempFromTime >= $rate3StartTime && $tempFromTime <= $rate3EndTime){
			$rangeArr["rate3"] += $interval;
		}
	}

	$fromTime->modify('+'.$interval. 'minutes');
}

foreach ($rangeArr as $key => $value) {
	$rangeArr[$key] = $value / 60; 
}


print_r($rangeArr);


