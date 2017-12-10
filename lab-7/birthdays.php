#!/usr/local/bin/php
<?php

$output = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
echo $output;

// echo "Hello World";
function writeContainer()
{
  date_default_timezone_set('America/Los_Angeles');
  $birthdayTimestamp = strtotime("11/22/1994");
  $now = time();

  echo "<table>\n";
  echo "<tr>\n
          <th>Date</th><th>Day</th>\n
        </tr>\n";
  for ( $datePointer = $birthdayTimestamp;
        $datePointer <= $now;
        $datePointer = strtotime("+1 year", $datePointer)
      ) {
        $date = date("m/d/Y", $datePointer);
        $day = date("l", $datePointer);
        echo "<tr>\n";
        echo "<td>{$date}</td>";
        echo "<td>{$day}</td>";
        echo "</tr>\n";
    }
    echo "</table>\n";

}

function writeCSS()
{
    echo "
    table {
      border: 1px solid black;
      border-collapse: collapse;
      margin-left: auto;
      margin-right: auto
    }
    td {
      border: 1px solid black;
      padding: 1px;
    }
    ";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <title>My First PHP Embedded Page</title>
  <style type="text/css"><?php writeCSS(); ?></style>

</head>

<body>
  <div id="container">
    <?php writeContainer(); ?>
  </div>

  <p>
    <a href="http://validator.w3.org/check?uri=referer">
      <img
      src="http://www.w3.org/Icons/valid-xhtml10"
      alt="Valid XHTML 1.0 Strict"
      height="31"
      width="88"
      />
    </a>
  </p>
</body>

</html>
