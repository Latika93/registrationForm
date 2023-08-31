<?php 
require_once('../includes/config.php');

if(isset($_POST['deletesend'])){
    $id = $_POST['deletesend'];

    $sql = "DELETE FROM userinfo WHERE id= " . $id;
    $result = mysqli_query($conn, $sql);

    echo $result;
}

?>