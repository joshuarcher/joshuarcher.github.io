#!/usr/local/bin/php -d display_errors=STDOUT
<?php

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

$timestamp = $_POST["timestamp"];

$sql = "UPDATE $table SET $field4 = $field4 + 1 WHERE $field5 = $timestamp";
$result = $db->query($sql);

?>
