<?php 

require_once("../function/function.php");

$data = getAllData("tbl_emloyee");
print_r($data);


// require_once("../function/function.php");

// $url = "http://localhost/myProjects/registrationForm/function/function.php";

// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $resp = curl_exec($ch);
// // echo "Resp : ".$resp;
// echo "Resp : ".strlen($resp);;

// if (curl_errno($ch)) {
//     echo 'Curl error: ' . curl_error($ch);
// } else {
//     print_r($resp);
// }

// curl_close($ch);
// return $resp;
?>