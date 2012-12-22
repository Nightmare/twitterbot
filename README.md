twitterbot (fork)
==========

A simple twitter bot in PHP

New Features
------------
* auto-follow given users ids
* get friends list
* get follower list


Features
--------
* post a message
* auto-follow
* auto-unfollow
* search


Usage
-----
    require_once('TwitterBot.php');

    $key          = 'YourConsumerKey';
    $secret       = 'YourConsumerSecret';
    $token        = 'YourAccessToken';
    $token_secret = 'YourAccessTokenSecret';

    $bot = new TwitterBot($key, $secret, $token, $token_secret);
    $bot->post("Hello, world!");
    $bot->autoFollow();
    $bot->autoUnfollow();

    $query = array(
      "q"           => "twitterbot",
      "count"       => 10,
      "result_type" => "recent",
    );

    * if you want follow users from search results
    $results = $bot->search($query);
    foreach ($results->statuses as $result) {
      echo $result->text . "\n";
    }

    * if you want follow users from search results
    foreach ($results->statuses as $result) {
      $users_id[] = $result->user->id;
    }

    $users_id = array_unique($users_id);

    $new_followings = $bot->autoFollow($users_id);

    "Got ". $new_followings ." new following(s)";