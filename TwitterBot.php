<?php

require_once __DIR__ . '/twitteroauth/twitteroauth.php';

class TwitterBot
{
    protected $oauth;

    public function __construct($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret)
    {
        $this->oauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
    }

    public function post($message)
    {
        $this->oauth->OAuthRequest('https://twitter.com/statuses/update.xml', 'POST', array('status' => $message));
    }

    public function autoFollow()
    {
        $followers = $this->oauth->get('followers/ids', array('cursor' => -1));
        $friends = $this->oauth->get('friends/ids', array('cursor' => -1));

        foreach ($followers->ids as $i => $id) {
            if (empty($friends->ids) or !in_array($id, $friends->ids)) {
                $this->oauth->post('friendships/create', array('user_id' => $id));
            }
        }
    }
}

