
<?php
session_start();
require_once('TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "372580763-CcTnC4gB7ZzXfd0spYyXTcnykv5oOD7S1tVvjyIi",
    'oauth_access_token_secret' => "2ZVnXE155Cl9aLtCIyVdiBYv627h5o6M8zK0oPm0Gn0nm",
    'consumer_key' => "p3UxZBnZlcdUrHsp1jQOCXxsi",
    'consumer_secret' => "Z9O0EVloCB1LN7k2D0IyWP5qCSAUpGvTn8G8vvVkvtpKvH8C5u"
);


//$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$url="https://api.twitter.com/1.1/search/tweets.json";
$requestMethod = "GET";
$getfield = '?q='.$_POST["busqueda"].'&count=100';
//$getfield = '?screen_name=iagdotme&count=20';
$twitter = new TwitterAPIExchange($settings);



$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
//if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
$count =0;

foreach($string["statuses"] as $items)
    {
       if($items['user']['location']!="")
       {
	     //	echo $items['text']."<br />";
        echo $items['user']['location']."<br /><hr />";
        //echo $items['text'];

        

      

        $_SESSION["row_count_".$count] = $items['user']['location'];
        $count++;
       }
        
    }

    header ("Location: index.php"); 
/*
echo "<pre>";
print_r($string);
echo "</pre>";*/
?>

