twitterbot
==========

A simple twitter bot in PHP

Features
--------
* post a message
* auto-follow
* auto-unfollow

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
