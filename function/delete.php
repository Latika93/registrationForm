<?php
  require_once('includes/config.php');

  $id = $_GET['id'];
  $sql = "delete from userinfo where id=" . $id;
  mysqli_query($conn, $sql);
?>
