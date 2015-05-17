
<?php
session_start();

function getInnerSubstring($string,$delim){
    // "foo a foo" becomes: array(""," a ","")
    $string = explode($delim, $string, 3); // also, we only need 2 items at most
    // we check whether the 2nd is set and return it, otherwise we return an empty string
    return isset($string[1]) ? $string[1] : '';
  }


  function getWeatherByCoordinates($lat,$lng)
  {

    $url = "http://www.myweather2.com/developer/forecast.ashx?uac=zThV.WApjN&query=".$lat.",".$lng;


    $ch = curl_init( $url );
    
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch, CURLOPT_HEADER, true );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );



    list( $header, $contents ) = preg_split( '/([\r\n][\r\n])\\1/', curl_exec( $ch ), 2 );

    $status = curl_getinfo( $ch );

    curl_close( $ch );


  // Split header text into an array.
    $header_text = preg_split( '/[\r\n]+/', $header );



  // $data will be serialized into JSON data.
    $data = array();



  // Set the JSON data object contents, decoding it from JSON if possible.
    $decoded_json = json_decode( $contents );
    $data['contents'] = $decoded_json ? $decoded_json : $contents;

  // Generate appropriate content-type header.
    $is_xhr = false;
    header( 'Content-type: application/' . ( $is_xhr ? 'json' : 'x-javascript' ) );


  // Generate JSON/JSONP string
    $json = json_encode( $data );
    substr(substr($data["contents"],0,290),63);


    $weatherString = getInnerSubstring($data["contents"],"curren_weather");
    $tempString = substr(substr(getInnerSubstring($weatherString,"temp"),1),0,-2);
    $skyStatus = substr(substr(getInnerSubstring($weatherString,"text"),1),0,-10);

    $weatherConditions=[

    "temp" =>$tempString,
    "skyStatus" =>$skyStatus,

    ];


    return $weatherConditions;

  }
  class geocoder{
    static private $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=";

    static public function getLocation($address){
      $url = self::$url.urlencode($address);

      $resp_json = self::curl_file_get_contents($url);
      $resp = json_decode($resp_json, true);

      if($resp['status']=='OK'){
        return $resp['results'][0]['geometry']['location'];
      }else{
        return false;
      }
    }


    static private function curl_file_get_contents($URL){
      $c = curl_init();
      curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($c, CURLOPT_URL, $URL);
      $contents = curl_exec($c);
      curl_close($c);

      if ($contents) return $contents;
      else return FALSE;
    }
  }

  function searchData($twitterQuery){
   require_once('TwitterAPIExchange.php');

   $settings = array(
    'oauth_access_token' => "372580763-CcTnC4gB7ZzXfd0spYyXTcnykv5oOD7S1tVvjyIi",
    'oauth_access_token_secret' => "2ZVnXE155Cl9aLtCIyVdiBYv627h5o6M8zK0oPm0Gn0nm",
    'consumer_key' => "p3UxZBnZlcdUrHsp1jQOCXxsi",
    'consumer_secret' => "Z9O0EVloCB1LN7k2D0IyWP5qCSAUpGvTn8G8vvVkvtpKvH8C5u"
    );

   $url="https://api.twitter.com/1.1/search/tweets.json";
   $requestMethod = "GET";

  $getfield = '?q='. $twitterQuery .'&count=50';


   $twitter = new TwitterAPIExchange($settings);



   $string = json_decode($twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest(),$assoc = TRUE);


   $count =0;
   foreach($string["statuses"] as $items)
   {
     if($items['user']['location']!="")
     {

      $loc = geocoder::getLocation(urlencode($items['user']['location']));

      if($loc["lat"]!=""&&$loc["lng"]!="")
      {

       $weatherConditions = getWeatherByCoordinates($loc["lat"],$loc["lng"]);
       $_SESSION["row_count_".$count] = array(
        "coords" => $loc,
        "temp" => $weatherConditions["temp"],
        "skyStatus" => $weatherConditions["skyStatus"],
        "location" => $items['user']['location'],
        "Tweet" => $items['text'],
        "user" => $items['user']['name'],
        "profileImage" =>$items['user']['profile_image_url'],
        "createdAt" => $items['user']['created_at'],
        "screenName" => $items['user']['screen_name']

        );
     }
     else
     {
      $_SESSION["row_count_".$count] = null;
    }


    $count++;
  }
  $_SESSION["total"]=$count;
  $_SESSION["topic"]=$twitterQuery;

}
/*
for($i =0;$i< $_SESSION["total"];$i++)
{
  print_r($_SESSION["row_count_".$i]);
}*/
//print_r($items);
  header ("Location: index.php");  

}
searchData($_REQUEST["busqueda"]);
//searchData("playstation4");
 
?>

