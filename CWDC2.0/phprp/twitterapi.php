<?php
	require "twitteroauth/autoload.php";
	use Abraham\TwitterOAuth\TwitterOAuth;
	$consumerkey = "CONSUMER_KEY";
	$consumersecret = "CONSUMER_SECRET";
	$access_token = "ACCESS_TOKEN";
	$access_token_secret = "ACCESS_TOKEN_SECRET";
	$connection = new TwitterOAuth($consumerkey, $consumersecret, $access_token, $access_token_secret);
	$content = $connection->get("account/verify_credentials");
	$statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);
	//$statues = $connection->post("statuses/update", ["status" => "A tweet from twitter api."]);
	foreach($statuses as $tweet){
		if($tweet->favorite_count > 2){
			$status = $connection->get("statuses/oembed", ["id" => $tweet->id]);
			echo $status->html;
		}
	}
?>
