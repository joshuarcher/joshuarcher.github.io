#!/usr/local/bin/php
<?php

$output = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
echo $output;

// echo "Hello World";
function writeContainer()
{
  echo "hello world";
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
