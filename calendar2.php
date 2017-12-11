#!/usr/local/bin/php
<?php
// I really dislike this solution because it makes a sql query way too many times..
// an alternative solution is commented out. it only makes the sql query once.
$hours_to_show = 12;
$database = "dbjosharcher.db";
date_default_timezone_set('America/Los_Angeles');

$calendar_start_time = time();

if (isset($_GET["time_stamp"]) && $_GET["time_stamp"] > 0) {
  $calendar_start_time = $_GET["time_stamp"];
}

function get_events($person, $timestamp) {
  global $database, $calendar_start_time, $hours_to_show;

  try
  {
       $db = new SQLite3($database);
  }
  catch (Exception $exception)
  {
      echo '<p>There was an error connecting to the database!</p>';
      if ($db)
      {
          echo $exception->getMessage();
      }
  }

  $table = "event_table";
  $field1 = "time";
  $field2 = "person";
  $field3 = "event_title";
  $field4 = "event_message";

  $start_timestamp = $timestamp - ($timestamp % 3600);
  $end_timestamp = $start_timestamp + 3600;

  $sql = "SELECT * FROM $table WHERE $field2='$person' AND $field1 >= $start_timestamp AND $field1 < $end_timestamp";
  $result = $db->query($sql);

  $result_array = array();

  while($record = $result->fetchArray()) {
    $titlee = $record[$field3];
    $messagee = $record[$field4];
    array_push($result_array, "<p>");
    array_push($result_array, "$titlee: $messagee");
    array_push($result_array, "</p>");
  }
  $result_string = implode("\n", $result_array);

  return $result_string;
}

function get_event() {
  global $database, $calendar_start_time, $hours_to_show;

  try
  {
       $db = new SQLite3($database);
  }
  catch (Exception $exception)
  {
      echo '<p>There was an error connecting to the database!</p>';
      if ($db)
      {
          echo $exception->getMessage();
      }
  }

  $table = "event_table";
  $field1 = "time";
  $field2 = "person";
  $field3 = "event_title";
  $field4 = "event_message";

  $end_time = $calendar_start_time + 60*60*$hours_to_show;

  // run query on db between calendar start time and hours_to_show
  $sql = "SELECT * FROM $table WHERE $field1 >= $calendar_start_time AND $field1 < $end_time";
  $result = $db->query($sql);

  return $result;
}

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

function writeCalendarRow($time, $isOdd, $sql_result, $start_timestamp, $end_timestamp) {
  $rowClass = $isOdd ? "odd_row" : "even_row";

  $sql_time = "time";
  $sql_person = "person";
  $sql_title = "event_title";
  $sql_message = "event_message";

  $joe_array = array();
  $joanna_array = array();
  $cub_array = array();

  while($record = $sql_result->fetchArray()) {
    if ($record[$sql_time] >= $start_timestamp && $record[$sql_time] < $end_timestamp) {
      $toDisplay = array(
        $sql_title => $record[$sql_title],
        $sql_message => $record[$sql_message]
      );
      if ($record[$sql_person] === "Joe") {
        array_push($joe_array, $toDisplay);
      } elseif ($record[$sql_person] === "Joanna") {
        array_push($joanna_array, $toDisplay);
      } elseif ($record[$sql_person] === "Cub") {
        array_push($cub_array, $toDisplay);
      }
    }
  }


  echo "<tr class=\"$rowClass\">";
  echo "<td class='hr_td'>$time</td>";
  echo "<td>";
  echo get_events("Joe", $start_timestamp);
  // foreach ($joe_array as $value) {
  //   $title_display = $value[$sql_title];
  //   $message_display = $value[$sql_message];
  //   echo "<p>$title_display: $message_display</p>";
  // }
  echo "</td>";
  echo "<td>";
  echo get_events("Joanna", $start_timestamp);
  // foreach ($joanna_array as $value) {
  //   $title_display = $value[$sql_title];
  //   $message_display = $value[$sql_message];
  //   echo "<p>$title_display: $message_display</p>";
  // }
  echo "</td>";
  echo "<td>";
  echo get_events("Cub", $start_timestamp);
  // foreach ($cub_array as $value) {
  //   $title_display = $value[$sql_title];
  //   $message_display = $value[$sql_message];
  //   echo "<p>$title_display: $message_display</p>";
  // }
  echo "</td>";
  echo "</tr>";
}
// get_events($person, $timestamp)

function writeContainer() {

  $sql_result = get_event();

  $currentDateString = createCurrentDateString();
  echo "<h1>Bruin Family Schedule For $currentDateString</h1>";
  echo "<table id=\"event_table\">";

  writeHeaderRow();

  for ($i = 0; $i < $GLOBALS['hours_to_show']; $i++) {
    $timeToDisplay = $GLOBALS['calendar_start_time'] + 60*60*$i;
    $timeString = get_hour_string($timeToDisplay);
    $isEven = ($i % 2) > 0;

    $start_timestamp = $timeToDisplay - ($timeToDisplay % 3600);
    $end_timestamp = $start_timestamp + 3599;

    writeCalendarRow($timeString, $isEven, $sql_result, $start_timestamp, $end_timestamp);

  }

  echo "</table>";
}

function writeButtons() {

  global $calendar_start_time, $hours_to_show;
  $past = $calendar_start_time - 60*60*$hours_to_show;
  $future = $calendar_start_time + 60*60*$hours_to_show;

  echo "<form id=\"prev\" method=\"get\" action=\"calendar2.php\">
	<p>
	<input type=\"hidden\" name=\"time_stamp\" value='$past' />
	<input type=\"submit\" value=\"Previous twelve hours\"/>
	</p>
  </form>";

  echo "<form id=\"next\" method=\"get\" action=\"calendar2.php\">
	<p>
	<input type=\"hidden\" name=\"time_stamp\" value='$future' />
	<input type=\"submit\" value=\"Next twelve hours\"/>
	</p>
  </form>";

  echo "<form id=\"today\" method=\"get\" action=\"calendar2.php\">
	<p>
	<input type=\"submit\" value=\"Today\"/>
	</p>
  </form>";

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
    <?php
    writeContainer();
    writeButtons();
    ?>
  </div>
</body>

</html>
