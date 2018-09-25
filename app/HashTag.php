<?php

namespace App;
use Twitter;

class HashTag {

	public static function search($hash, $count = 100)
	{
		$tweets = Twitter::getSearch([
    		'q' => '#' . $hash,
    		'count' => 100,
    		'format' => 'array'
		]);
       
       return $tweets;
	}

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