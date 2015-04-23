<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href="css/twitterapi.css" rel="stylesheet">

<!-- Stylesheets for Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Carme' rel='stylesheet' type='text/css'>
<!-- Stylesheets for Google Fonts -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="js/tweetLinkIt.js"></script>

<script>


    function pageComplete(){
        $('.twitter_status').tweetLinkify();
    }
	
	
</script>
</head>
<body>

<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "17488836-XJl0HIJFqsa3MLlo8Yaw6ZEpNgYOSXEQ8Lq445r96",
    'oauth_access_token_secret' => "kTR8Uh6nqGrTj0ykgjDacQvnvDLjlzv3qXcj2utmmpAo8",
    'consumer_key' => "KYmHreNAjXn9R0qEN8RPtArdF",
    'consumer_secret' => "7wdhgkvVNiladR4MQcIpvRk2AAmt8fq3Y7Pg8bJyHSbBn1Kt7r"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'GET';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock', 
    'skip_status' => '1'
);

/** Perform a POST request and echo the response 
$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();
 **/
/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23orphanblack';
$gettype = 'recent';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
/**echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(); **/
			 
$tweetData = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(), $assoc=TRUE);
			 
// echo $tweetData;
?>

<?php


foreach($tweetData['statuses'] as $items)
{
	//$userArray = $items['user'];
	//$userMedia = $items['media'];
	
	$entities = $items['entities'];
$media = $entities['media'];
$userArray = $items['user'];
$tweetMedia = $media[0];
	
	echo "<div class='row col-xs-12'><div class='row col-xs-12'>

			<div class='row col-xs-2'>
				<div class='row col-xs-12 profile_photos'>
	<a href='https://twitter.com/" . $userArray['screen_name'] . "' target='_blank'><img src='" . $userArray['profile_image_url'] . "'></a>
	</div></div>"; 
	
	
	echo "<div class='row twitternames col-xs-10'>
	<div class='row col-xs-12 twitternames'><span id='twitter_screen_name'><a href='https://twitter.com/" . $userArray['screen_name'] . "' target='_blank'>
	@" . $userArray['screen_name'] . "</a></span></div><div class='row col-xs-12'><span id='twitter_real_name'>";
	echo $userArray['name'] . "</span></br>
	</div>

	</div></div>
	<div class='row col-xs-12 twitter_status'>" . $items['text'] . "</br></div>";
	// echo "<div class='row col-xs-12 .img-responsive'><a href='https://twitter.com/" . $userArray['screen_name'] . "/status/" . $items['id'] . "' target='_blank'><img src='" . $tweetMedia['media_url'] . "'></a></div></br></div>";
	
	
	// NEED TO DO SOMETHING HERE TO CHECK IF MEDIA_URL IS NOT NULL!!!!!!!!!!!!!!!!!!!!!!
	//echo "<div class='row col-xs-12 img-responsive twitpics'><img src='" . $tweetMedia['media_url'] . "'></div></br>
	
	
	//echo $items['created_at'] . "</br>"
	echo "<div class='row col-xs-12 img-responsive twitpics'><a href='https://twitter.com/" . $userArray['screen_name'] . "/status/" . $items['id'] . "' target='_blank'><img src='" . $tweetMedia['media_url'] . "'></a></div></br>
	
	</div>";
	
	
}
	
	 echo "<script>pageComplete()</script>"
?>



</body>
</html>
