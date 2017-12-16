#!/usr/local/bin/php -d display_errors=STDOUT
<?php

class Post {
  public $title;
  public $url;
  public $text;
  public $upvoteCount;
  public $timestamp;

  public function __construct($title, $url, $text, $upvoteCount, $timestamp) {
    $this->title = $title;
    $this->url = $url;
    $this->text = $text;
    $this->upvoteCount = $upvoteCount;
    $this->timestamp = $timestamp;
  }
}

$postOne = new Post("This is a demo title 1", "http://google.com", "", 20, 1513381502687);
// postOne->title = "This is a demo title";
// postOne->url = "http://google.com";
// postOne->text = "";
// postOne->upvoteCount = 27;
// postOne->timestamp = 1513381502687;

$postTwo = new Post("This is a demo title 2", "http://google.com", "", 27, 1513381502687);
// postTwo->title = "This is a demo title 2";
// postTwo->url = "http://google.com";
// postTwo->text = "";
// postTwo->upvoteCount = 27;
// postTwo->timestamp = 1513381502687;

$postThree = new Post("This is a demo title 3", "http://google.com", "", 99, 1513381502687);
// postThree->title = "This is a demo title 3";
// postThree->url = "http://google.com";
// postThree->text = "";
// postThree->upvoteCount = 27;
// postThree->timestamp = 1513381502687;

$oneJson = json_encode($postOne);
$twoJson = json_encode($postTwo);
$threeJson = json_encode($postThree);

$arr = $arrayName = array('posts' => array($oneJson, $twoJson, $threeJson));

echo json_encode($arr);
?>
