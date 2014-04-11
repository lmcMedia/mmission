<?php
require_once ('twitteroauth.php');

$tw_user = 'LM_Creative';
$tw_consumerkey = 'bM0yamQCnKVBQT8xpwTjQ';
$tw_consumersecret = 'MoXMnacYkmiG8z3smeEfxDeM7C3UJFoBQGh96CCnQ';
$tw_accesstoken = '159658571-zFollxQuy5u1KitWk6MdwiTG70OogH2uMMBlkx3M';
$tw_accesstokensecret = 'B1iBfiTHcV7G5ZilJDTKcvKwkv2YR7i0zR0Hhd1oCdSOz';
$notweets = 30;

function addLinks($data) {
	
	$data = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a target=\"_blank\" href=\"\\2\" >\\2</a>", $data);
	$data = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a target=\"_blank\" href=\"http://\\2\" >\\2</a>", $data);
	$data = preg_replace("/RT @(\w+):/", "@\\1", $data);
	$data = preg_replace("/@(\w+)/", "<a target=\"_blank\" href=\"http://www.twitter.com/\\1\" >@\\1</a>", $data);
	$data = preg_replace("/#(\w+)/", "<a target=\"_blank\" href=\"https://twitter.com/search?q=\\1\" >#\\1</a>", $data);
	
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
