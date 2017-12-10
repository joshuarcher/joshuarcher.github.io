#!/usr/local/bin/php -d display_errors=STDOUT
<?php
  // begin this XHTML page
  print('<?xml version="1.0" encoding="utf-8"?>');
  print("\n");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<title>PHP Example: Accessing a SQLite 3 Database using PHP</title>
</head>
<body>
<p>
<?php


$database = "students.db";


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
$table = "bruins";
$field1 = "name";
$field2 = "sid";
$field3 = "gpa";


// Create the table
$sql= "CREATE TABLE IF NOT EXISTS $table (
$field1 varchar(100),
$field2 int(9),
$field3 decimal(3,1)
)";
$result = $db->query($sql);

print "<h3>Creating the table</h3>";
print "<p>$sql</p>";

// Write code here to extract the name, SID and GPA from the $_GET data.

// $name = complete this
// $SID  = complete this
// $GPA  = complete this


//  Insert a new record to your database with name = $name, sid = $SID and gpa = $GPA
//  Create the $sql string that will accomplish this.
//  $sql = your string


print "Inserting a new record to the bruins table the command I am using is:</br>";
print "$sql";
$result = $db->query($sql);


// Be sure you understand this code:
// print an XHTML table to display the current table
$sql = "SELECT * FROM $table";
$result = $db->query($sql);

print "<table border='border'>\n";
print "  <tr>\n";
print "     <th>" . $field1 . "</th>\n";
print "     <th>" . $field2 . "</th>\n";
print "     <th>" . $field3 . "</th>\n";
print "  </tr>\n";

// obtain the results from the SELECT query as an array holding a record
// one iteration per record for this select query
while($record = $result->fetchArray())
{
  print "  <tr>\n";

  // Fill in details here

  // Look at the slides to see how to extract the info from $record
  // Each iteration of the loop should write a table row

  print "  </tr>\n";
}

print "</table>\n";
?>
</body>
</html>
