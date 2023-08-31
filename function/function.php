<?php
require_once('../includes/config.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$empID = '';
function addEmployee($conn)
{
    global $conn;
    $interest = '';
    if (isset($_POST['interests'])) {
        $interest = implode(",", $_POST['interests']); // implode/explode coding,cricket,
    }

    $name = $_POST["name"];
    $fathername = $_POST["fathername"];
    $mob = $_POST["mob"];
    $dob = $_POST["dob"];
    $doj = $_POST["doj"];
    $gender = $_POST["gender"];
    $state = $_POST["state"];
    $desc = $_POST["desc"];
    $designation = $_POST["designation"];
    $district = $_POST["city"];

    $sql = "INSERT INTO tbl_emloyee (name, fathername, mob, gender, dob, states, district, interests, description, doj, designation) values ('$name', '$fathername', '$mob', '$gender', '$dob', '$state', '$district', '$interest', '$desc', '$doj' , '$designation')";
    mysqli_query($conn, $sql);
}

function getNameById($table, $selectField,$key, $keyVal)
{
    global $conn;
    $data = '';
    $sql = "SELECT $selectField FROM $table WHERE $key = '".$keyVal."' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $data = $row[ $selectField];
    }
    return $data;
}

function getAllData($table)
{
    global $conn;
    $data = '';
    $sql = "SELECT * FROM " . $table . " WHERE is_deleted='N' AND status='ACTIVE'";
    $query = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($query);
    if ($rows > 0) {
        $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);


    return $data;
}

function getDataById($table, $key, $keyVal)
{
    global $conn;
    $data = '';
    $sql = "SELECT * FROM " . $table . " WHERE  $key= '" . $keyVal . "' LIMIT 1";
    //echo $sql; die();
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        $data = mysqli_fetch_assoc($result);
    }        
    return $data;

}

function deleteById($table, $key, $keyVal){
    global $conn;
    $resp = array();
        $sql = "DELETE FROM $table WHERE $key = '".$keyVal."'";
        $result = mysqli_query($conn, $sql);
       if($result)
       {
        $resp['statuscode']='00';
        $resp['description']='Deleted successfully';
       }
        return $resp;
}



function callAPI($method, $url, $data){
    $curl = curl_init();
    switch ($method){
       case "POST":
          curl_setopt($curl, CURLOPT_POST, true);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
       case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
          break;
       default:
          if ($data)
             $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
       'APIKEY: 111111111111111111111',
       'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    // if(!$result){die("Connection Failure");}
    if($e = curl_error($curl)){
        echo $e;
    }
    curl_close($curl);
    return $result;
}
?>