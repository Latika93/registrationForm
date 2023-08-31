<?php 
require_once('../function/function.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$password')";
    
    $result = mysqli_query($conn, $sql);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register User</h2>
    <form action="" method="POST">
        <input type="text" name="username"> <br><br>
        <input type="text" name="password"> <br><br>
        <input type="submit" value="submit">
    </form>
    <P>Already a user ? <a href="login.php">Login</a></P>
    <?php 
        if(isset($result)) {
            echo "Registered Successfully.";
        }else{
            echo "Error.";
        } 
    ?>
</body>
</html>