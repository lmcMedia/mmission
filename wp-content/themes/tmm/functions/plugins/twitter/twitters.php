<?php
require_once ('twitteroauth.php');

$tw_user = 'MidniteMission';
$tw_consumerkey = 'prjUeqvZBanhjy52WyBrckMCu';
$tw_consumersecret = 'y5Oy3MRWdEXJmNIrWGhOTlLW7pbMb5KWvPlWln2xVrQehaVZ4q';
$tw_accesstoken = '264490826-hbQZDObFuK8bgLTeCBQiqsL6t6VSjDN4mhmhMkVR';
$tw_accesstokensecret = 'a3zjFGfAfEAeTxW4x8ZcyUbBgsLDrDkotLzZ4SvkOVFbG';
$notweets = 20;

function addLinks($data) {
	$data = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1\\2", $data);
	$data = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1\\2", $data);
	
	$data = preg_replace("/RT @(\w+):/", "@\\1", $data);
	$data = preg_replace("/@(\w+)/", "@\\1", $data);
	$data = preg_replace("/#(\w+)/", "#\\1", $data);
	
	return $data;
}

function relative_time($time_value) {
	$values = explode(" ", $time_value);
	
	$shortdate = $values[1] . " " . $values[2];
	$post =  strtotime($values[2] . " ". $values[1] ." ". $values[5] . " " . $values[3]);
	$now = strtotime("now");
	$delta = $now - $post;

	if ($delta < 60) {
		return 'few seconds ago';
	} else if($delta < 120) {
		return '1minute';
	} else if($delta < (60*60)) {
		return floor($delta / 60) . 'm';
	} else if($delta < (120*60)) {
		return '1h';
	} else if($delta < (24*60*60)) {
		return floor($delta / 3600) . 'h';
	} else if($delta < (48*60*60)) {
		return $shortdate;
	} else {
		return $shortdate;
	}
}

$connection = new TwitterOAuth($tw_consumerkey, $tw_consumersecret, $tw_accesstoken, $tw_accesstokensecret);
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$tw_user."&count=".$notweets);

$count = 0;
$tweetsArr = array();

foreach($tweets as $key => $tweet)
{
	$count ++;
	$profileimage = $tweet->user->profile_image_url_https;
	$text = $tweet->text;
	$tweetid = $tweet->id_str;

	$item = array();
	
	$item['text'] = addLinks($text);
	if($tweet->retweeted == 1) {
		$item['id'] = $tweet->retweeted_status->id_str;
		$item['name'] = $tweet->retweeted_status->user->name;
		$item['username'] = $tweet->retweeted_status->user->screen_name;
		$item['profile_image_url'] = $tweet->retweeted_status->user->profile_image_url;
		$item['created_at'] = relative_time($tweet->retweeted_status->created_at);
		$item['url'] = "https://twitter.com/".$tweet->retweeted_status->user->name."/status/".$tweet->retweeted_status->id_str."";
	} else {
		$item['id'] = $tweet->id_str;
		$item['name'] = $tweet->user->name;
		$item['username'] = $tweet->user->screen_name;
		$item['profile_image_url'] = $tweet->user->profile_image_url;
		$item['created_at'] = relative_time($tweet->created_at);
		$item['url'] = "https://twitter.com/".$tweet->user->name."/status/".$tweet->id_str."";
	}	
	
	$tweetsArr[] = $item;
}
