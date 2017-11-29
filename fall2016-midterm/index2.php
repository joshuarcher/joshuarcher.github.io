#!/usr/local/bin/php
<?php

$dateOne = $_GET["date1"];
$dateTwo = $_GET["date2"];

function writeContainer() {
  print("<p>date one: $dateOne</p>");
  print("<p>date two: $dateTwo</p>");


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
  <div id="container">
    <?php writeContainer(); ?>
  </div>
</body>

</html>
