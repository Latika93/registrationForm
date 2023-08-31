<?php
require_once "function/function.php";

if(isset($_POST['register']) && $_POST['register']=='registerEmp')
{
    print_r($_POST);//die;
    $interest = '';
    extract($_POST);   
   
    $error = array();
    if(empty($error ))
    {
      addEmployee($conn);
      // print_r($add_emp); die();
    }
}

$allData = getAllData('tbl_emloyee');

if(isset($_POST['update']) && $_POST['update']=='updateEmp')
{
   extract($_POST);
   $interest = "";
   
   global $conn;
    if (isset($_POST['interests'])) {
        $interest = implode(",", $_POST['interests']); // implode/explode coding,cricket,
    }


    $sql = "UPDATE tbl_emloyee SET name = '$name', fathername = '$fathername', mob = '$mob', gender = '$gender', dob = '$dob', states = '$state', district = '$city', interests = '$interest', description = '$desc', doj = '$doj', designation = '$designation' WHERE id = '".$emp_id."' LIMIT 1";
    
    $result = mysqli_query($conn, $sql);
    if($result)
    {
     $resp['statuscode']='00';
     $resp['description']='Upadated successfully';
    }
    
    echo json_encode($resp);
}

// if(isset($_POST['update']) && $_POST['update']=='updateEmp')
// {
//     $interest = '';
//     extract($_POST);   
//     var_dump ($_POST);
   
//     $error = array();
//     if(empty($error ))
//     {
//       print_r(updateEmployee('tbl_emloyee', 'id', $empId));
//     }
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
//     $delete_id = $_POST['id'];
//     deleteById($delete_id, $conn);
// }

?>

