#!/usr/local/bin/php -d display_errors=STDOUT
<?php
date_default_timezone_set('America/Los_Angeles');
$database = "dbjosharcher.db";


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

// Create the table
$sql= "CREATE TABLE IF NOT EXISTS $table (
$field1 int(12),
$field2 varchar(20),
$field3 varchar(300),
$field4 varchar(300)
)";
$result = $db->query($sql);

if (!isset($_POST["person"]) || !isset($_POST["date"]) || !isset($_POST["time"]) || !isset($_POST["event_title"]) || !isset($_POST["event_message"])) {
  echo "<h1>Something is wrong with your form data</h1>";
  exit;
}

$person = $_POST["person"];
$date = $_POST["date"];
$time  = $_POST["time"];
$event_title = $_POST["event_title"];
$event_message = $_POST["event_message"];

if (strlen($person) < 1 || strlen($date) < 1 || strlen($time) < 1 || strlen($event_title) < 1 || strlen($event_message) < 1) {
  echo "<h1>Something is wrong with your form data</h1>";
  exit;
}

// convert date+time to a timestamp...
$actual_timestamp = + strtotime($date) + (strtotime($time) - strtotime("yesterday midnight"));

$sql = "INSERT INTO $table ($field1, $field2, $field3, $field4) VALUES ($actual_timestamp,'$person','$event_title','$event_message')";

echo "Inserting a new record to the bruins table the command I am using is:</br>";
echo "$sql";
$result = $db->query($sql);

echo "$result";


 ?>
