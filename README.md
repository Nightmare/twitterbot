twitterbot
==========

A simple twitter bot in PHP

Features
--------
* post a message
* auto-follow
* auto-unfollow
* search

Usage
-----

    $key = 'YourConsumerKey';
    $secret = 'YourConsumerSecret';
    $token = 'YourAccessToken';
    $token_secret = 'YourAccessTokenSecret';
    
    $bot = new TwitterBot($key, $secret, $token, $token_secret);
    $bot->post("Hello, world!");
    $bot->autoFollow();
    $bot->autoUnfollow();
    
    $query = array(
      "q" => "github",
      "count" => 10,
      "result_type" => "recent",
    );
    
    $results = $bot->search($query);
    foreach ($results->statuses as $result) {
      echo $result->text . "¥n":
    }
