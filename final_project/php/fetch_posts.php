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
/////////////////
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

/////////////////
$table = "posts";
$field1 = "title";
$field2 = "url";
$field3 = "text";
$field4 = "upvoteCount";
$field5 = "timestamp";

$sql = "SELECT * FROM $table";
$result = $db->query($sql);

$posts_array = array();

while($record = $result->fetchArray())
{
  $post = new Post($record[$field1],$record[$field2],$record[$field3],$record[$field4],$record[$field5]);
  $postJson = json_encode($post);

  array_push($posts_array, $postJson);
}


// $postOne = new Post("This is a demo title 1", "http://google.com", "", 20, 1513381502687);
// // postOne->title = "This is a demo title";
// // postOne->url = "http://google.com";
// // postOne->text = "";
// // postOne->upvoteCount = 27;
// // postOne->timestamp = 1513381502687;
//
// $postTwo = new Post("This is a demo title 2", "http://google.com", "", 27, 1513381502687);
// // postTwo->title = "This is a demo title 2";
// // postTwo->url = "http://google.com";
// // postTwo->text = "";
// // postTwo->upvoteCount = 27;
// // postTwo->timestamp = 1513381502687;
//
// $postThree = new Post("This is a demo title 3", "http://google.com", "", 99, 1513381502687);
// // postThree->title = "This is a demo title 3";
// // postThree->url = "http://google.com";
// // postThree->text = "";
// // postThree->upvoteCount = 27;
// // postThree->timestamp = 1513381502687;
//
// $oneJson = json_encode($postOne);
// $twoJson = json_encode($postTwo);
// $threeJson = json_encode($postThree);

// $arr = $arrayName = array('posts' => array($oneJson, $twoJson, $threeJson));
$arr = $arrayName = array('posts' => $posts_array);

echo json_encode($arr);
?>
