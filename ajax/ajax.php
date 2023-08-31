<?php 
require_once('includes/config.php');

if(isset($_POST['action']) && $_POST['action']=='getCity')
{
    extract($_POST);
    echo "<pre>";
    print_r($_POST);
    $sql = "SELECT cityID,cityName FROM `cities` WHERE stateID ='".$state_id."' ORDER BY cityName ASC";
    $query =mysqli_query($conn,$sql);
    $rows = mysqli_fetch_all($query);
    $row_count = mysqli_num_rows($query);
    
    if($row_count>0)
    {
        foreach($rows as $row)
        { ?>
          <option value="<?=$row[0]?>"><?=$row[1]?></option>
     <?php
       }
    }
}

if(isset($_POST['name']) && isset($_POST['fathername']) && isset($_POST['gender'])){
    $name = $_POST['name'];
    $fathername = $_POST['fathername'];
    $gender = $_POST['gender'];

    $query = "INSERT INTO `tbl_emloyee`(`name`, `fathername`, `gender`) VALUES ('$name','$fathername', '$gender')";
    $sql = mysqli_query($db, $query);

    if($sql){
        echo "Record Success";
    }else{
        echo "Nope record not added";
    }
}

if(isset($_POST['action']) && $_POST['action']=='deleteEmp')
{
   extract($_POST);
       $sql = "DELETE FROM tbl_emloyee WHERE id = '".$emp_id."'";
      $result = mysqli_query($conn, $sql);
       if($result)
       {
        $resp['statuscode']='00';
        $resp['description']='Deleted successfully';
       }
        echo json_encode($resp);
}

if(isset($_POST["Import"]))
{   
    echo "Checkpoint 1";
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
     
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

        fgetcsv($csvFile);
     
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
        {
            $id = $getData[0];
            $name = $getData[1];
            $fathername = $getData[2];   
            $gender = $getData[3];  
            $dob = $getData[4]; 
            $state = $getData[5];
            $city = $getData[6];
            $interest = $getData[7];   
            $desc = $getData[8];  
            $doj = $getData[9]; 
            $designation = $getData[10];


            $query = "SELECT id FROM tbl_emloyee WHERE id = '" . $id . "'";

            $check = mysqli_query($conn, $query);
            echo "Checkpoint 2";
            if ($check->num_rows > 0)
            {
              $sql = "UPDATE tbl_emloyee SET name = '$name', fathername = '$fathername', mob = '$mob', gender = '$gender', dob = '$dob', states = '$state', district = '$city', interests = '$interest', description = '$desc', doj = '$doj', designation = '$designation' WHERE id = '".$id."' LIMIT 1";
                mysqli_query($conn, $sql);    
            }
            else
            {
                mysqli_query($conn, "INSERT INTO `tbl_users`(`firstName`, `lastName`, `email`) VALUES ('$firstName','$lastName','$email')" );
            }
        }

        fclose($csvFile);

        header("location: registrationForm.php");         
    }
    else
    {
        echo "Please select valid file";
    }
}

?>