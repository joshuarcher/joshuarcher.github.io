#!/usr/local/bin/php -d display_errors=STDOUT
<?php

echo '{
    "glossary": {
        "title": "example glossary",
		"GlossDiv": {
            "title": "S",
			"GlossList": {
                "GlossEntry": {
                    "ID": "SGML",
					"SortAs": "SGML",
					"GlossTerm": "Standard Generalized Markup Language",
					"Acronym": "SGML",
					"Abbrev": "ISO 8879:1986",
					"GlossDef": {
                        "para": "A meta-markup language, used to create markup languages such as DocBook.",
						"GlossSeeAlso": ["GML", "XML"]
                    },
					"GlossSee": "markup"
                }
            }
        }
    }
}';

// class Post {
//   public $title;
//   public $url;
//   public $text;
//   public $upvoteCount;
//   public $timestamp;
// }
//
// $postOne = Post();
// postOne->title = "This is a demo title";
// postOne->url = "http://google.com";
// postOne->text = "";
// postOne->upvoteCount = 27;
// postOne->timestamp = 1513381502687;
//
// $postTwo = Post();
// postTwo->title = "This is a demo title 2";
// postTwo->url = "http://google.com";
// postTwo->text = "";
// postTwo->upvoteCount = 27;
// postTwo->timestamp = 1513381502687;
//
// $postThree = Post();
// postThree->title = "This is a demo title 3";
// postThree->url = "http://google.com";
// postThree->text = "";
// postThree->upvoteCount = 27;
// postThree->timestamp = 1513381502687;
//
// $oneJson = json_encode($postOne);
// $twoJson = json_encode($postTwo);
// $threeJson = json_encode($postThree);
//
// $arr = $arrayName = array('posts' => array($oneJson, $twoJson, $threeJson));
//
// echo json_encode($arr);
?>
