<?PHP

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
 print_r(getWeatherByCoordinates(80.41,60.4));



?>