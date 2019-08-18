<?php
	require "twitteroauth/autoload.php";
	use Abraham\TwitterOAuth\TwitterOAuth;
	$consumerkey = "Q0IxGZfMLYxMK6RPoDCgJ4ANZ";
	$consumersecret = "KSE9iQ8cum3AFkJu18tHwjxjfM9mHxVXhCs1wganW3qm6vdwIm";
	$access_token = "2565377312-KgoTeFQ4FHdmrQKa37sNkmQgtv4FPSbU2hKdgrg";
	$access_token_secret = "VQlvX5c9QtzNHdnZe7GttnfEACTOD93EBepo3kiAKoZG2";
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