<?php

header( 'Location: http://pic.ucla.edu/~josharcher/final_project/site_index.html' );

$database = "posts.db";

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

// define tablename and field names for a SQLite3 query to create a table in a database
$table = "posts";
$field1 = "title";
$field2 = "url";
$field3 = "text";
$field4 = "upvoteCount";
$field5 = "timestamp";


// Create the table
$sql= "CREATE TABLE IF NOT EXISTS $table (
$field1 varchar(100),
$field2 varchar(100),
$field3 varchar(1000),
$field4 int(40),
$field5 int(40)
)";
$result = $db->query($sql);

$title = $_POST["title"];
$url = $_POST["url"];
$text = $_POST["text"];
$upvoteCount = 0;
$date = new DateTime();
$timestamp = $date->getTimestamp();

$sql = "INSERT INTO $table ($field1, $field2, $field3, $field4, $field5) VALUES ('$title','$url','$text',$upvoteCount,$timestamp)";
$result = $db->query($sql);

?>
