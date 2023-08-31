<?php 
require_once('../includes/config.php');

extract($_POST);

if(isset($_POST['interests']) &&
isset($_POST['name']) && 
isset($_POST['fathername']) &&
isset($_POST['mob']) &&
isset($_POST['dob']) &&
isset($_POST['doj']) &&
isset($_POST['gender']) &&
isset($_POST['state']) &&
isset($_POST['desc']) &&
isset($_POST['designation']) &&
isset($_POST['district']) 
){
    $sql = "INSERT INTO userinfo (name, fathername, mob, gender, dob, states, district, interests, description, doj, designation) values ('$name', '$fathername', '$mob', '$gender', '$dob', '$state', '$district', '$interest', '$desc', '$doj' , '$designation')";
    mysqli_query($conn, $sql);
}



?>