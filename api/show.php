<?php 
$url = "http://localhost/myProjects/registrationForm/api/fetch_data.php";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);
echo "Resp : ".$resp;

curl_close($ch);
?>