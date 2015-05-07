<?php
session_start();



print($_SESSION["row_count_5"]["coords"]["lat"]);


echo"


<html>
<head>
  <title>TweetGeolocalizables</title>
</head>
<script src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>


<link rel='stylesheet' href='style.css'>


<script type='text/javascript' src='lib/jquery-1.11.2.js'></script>


<script>

";
if($_SESSION['row_count_5']!= null){

echo "
 var lat = ".$_SESSION['row_count_5']['coords']['lat'].";
    var lng = ".$_SESSION['row_count_5']['coords']['lng'].";
    var temp = ".$_SESSION['row_count_5']['temp'].";
    codeAdress(lat,lng,temp);

";

}
else
{
  echo " console.log('es null');";
}


echo "
 


function codeAdress(lat,lng,temp){
  
    console.log(lat);
     console.log(lng);
      console.log(temp);
   
}





</script>
</head>


</html>
"
?>