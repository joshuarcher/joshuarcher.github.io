#!/usr/local/bin/php
<?php
$hours_to_show = 12;
date_default_timezone_set('America/Los_Angeles');

function get_hour_string($timestamp) {

  $current_time_hours = localtime($timestamp, true)["tm_hour"];

  $time_string = "";

  $time_remainder = $current_time_hours % 12;

  if ($time_remainder > 0) { // after noon
    $time_string = "$time_remainder:00pm";
  } else if ($time_remainder == 0) {
    $time_string = "12:00am";
  } else {
    $time_string = "$current_time_hours:00am";
  }

  return $time_string;
}

function createExactTimestamp($timestamp) {
  $current_time_hours = localtime($timestamp, true)["tm_hour"];
  $current_time_minutes = localtime($timestamp, true)["tm_min"];

  $time_string = "";

  $time_remainder = $current_time_hours % 12;

  if ($time_remainder > 0) { // after noon
    $time_string = "$time_remainder:$current_time_minutes pm";
  } else {
    $time_string = "$current_time_hours:$current_time_minutes am";
  }

  return $time_string;
}

function createCurrentDateString() {
  $localTime = createExactTimestamp(time());
  $date = date("D, F jS, Y, ");
  return $date . '' . $localTime;
}

function writeHeaderRow() {
  echo "<tr>";
  echo "<th class='hr_td'> &nbsp; </th>";
  echo "<th class='table_header'>Joe</th>";
  echo "<th class='table_header'>Joanna</th>";
  echo "<th class='table_header'>Lil Cub</th>";
  echo "</tr>";
}

function writeCalendarRow($time, $isOdd) {
  $rowClass = $isOdd ? "odd_row" : "even_row";

  echo "<tr class=\"$rowClass\">";
  echo "<th class='hr_td'>$time</th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "</tr>";

}

function writeContainer() {

  $currentDateString = createCurrentDateString();
  echo "<h1>Bruin Family Schedule For $currentDateString</h1>";
  echo "<table id=\"event_table\">";

  writeHeaderRow();

  for ($i = 0; $i < $GLOBALS['hours_to_show']; $i++) {
    $timeToDisplay = time() + 60*60*$i;
    $timeString = get_hour_string($timeToDisplay);
    $isEven = ($i % 2) > 0;

    writeCalendarRow($timeString, $isEven);

  }

  // $currentTimePlusOneHour = time() + 60*60;
  // echo get_hour_string($currentTimePlusOneHour);

  echo "</table>";

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <title>My First PHP Embedded Page</title>
  <link rel="stylesheet" type="text/css" href="calendar.css" />
</head>

<body>
  <div class="container">
    <?php writeContainer(); ?>
  </div>
</body>

</html>
