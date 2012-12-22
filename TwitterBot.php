<?php

require_once('twitteroauth/twitteroauth.php');

class TwitterBot
{
	protected $oauth;

	public function __construct($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret)
	{
		$this->oauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
	}

	public function post($message)
	{
		$this->oauth->post('statuses/update', array('status' => $message));
	}

	/**
	 * Follow all users who are following you or follow new determined users
	 *
	 * $users_id: Array of users id to follow
	 *
	 */
	public function autoFollow($users_id = array())
	{
		$new_following = 0;
		if (empty($users_id)) {
			$followers = $this->oauth->get('followers/ids', array('cursor' => -1));
			$friends = $this->oauth->get('friends/ids', array('cursor' => -1));

			foreach ($followers->ids as $i => $id) {
				if (empty($friends->ids) or !in_array($id, $friends->ids)) {
					$this->oauth->post('friendships/create', array('user_id' => $id));
					$new_following++;
				}
			}
		} else {
			$friends = $this->oauth->get('friends/ids', array('cursor' => -1));
			foreach ($users_id as $user_id) {
				if (!in_array($user_id, $friends->ids)) {
					sleep(10);
					$this->oauth->post('friendships/create', array('user_id' => $user_id));
					$new_following++;
				}
			}
		}

		return $new_following;
	}

	/**
	 * Unfollow all users who are not following you.
	 */
	public function autoUnfollow()
	{
		$followers = $this->oauth->get('followers/ids', array('cursor' => -1));
		$friends = $this->oauth->get('friends/ids', array('cursor' => -1));

		foreach ($friends->ids as $i => $id) {
			if (empty($followers->ids) or !in_array($id, $followers->ids)) {
				$this->oauth->post('friendships/destroy', array('user_id' => $id));
			}
		}
	}

	public function search(array $query)
	{
		return $this->oauth->get('search/tweets', $query);
	}

	/**
	 * Get followers list
	 *
	 */
	public function getFollowers()
	{
		return $followers = $this->oauth->get('followers/ids', array('cursor' => -1));
	}

	/**
	 * Get friends list (users you follow)
	 *
	 */
	public function getFriends()
	{
		return $friends = $this->oauth->get('friends/ids', array('cursor' => -1));
	}
}
