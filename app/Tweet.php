<?php

namespace App;
use Twitter;

class Tweet {
	/**
	 * search using Twitter API
	 * @param  String  $hash  user search param
	 * @param  integer $count number of rows comming from Twitter API 
	 * @return Array          Tweets $tweets result comming from Twitter API search
	 */
	public static function search($hash, $count = 100)
	{
		$tweets = Twitter::getSearch([
    		'q' => '#' . $hash,
    		'count' => 100,
    		'format' => 'array'
		]);
       
       return $tweets;
	}
	/**
	 * getText retuns tweets text-msg
	 * @param  Tweets $tweets result comming from Twitter API search
	 * @param  String $hash   user search param
	 * @return Array          ['HashTag' => '#'.$hash, 'messages' => []];
	 */
	public static function getText($tweets,$hash)
	{
		$tweetsMessages = ['HashTag' => '#'.$hash, 'messages' => []];
		foreach ($tweets as $tweet) {
			foreach ($tweet as $status) {
				if (isset($status['text'])) {
					$tweetsMessages['messages'][] = $status['text'];
				}
				
			}
		}
		return $tweetsMessages;
	}
}