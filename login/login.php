<?php 
require_once('../function/function.php');

session_start(); 

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];


        if(!empty($_POST["remember"])) {
            //COOKIES for username
            setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
            //COOKIES for password
            setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
            } else {
            if(isset($_COOKIE["user_login"])) {
                setcookie ("user_login","");
                if(isset($_COOKIE["userpassword"])) {
                    setcookie ("userpassword","");
                            }
            }
        }
        header("Location: welcome.php"); // Redirect to dashboard after successful login
        exit();
    } else {
        $login_error = "Invalid username or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login page</h2>
    <form action="" method="POST">
        <input type="text" name="username" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>"> <br><br>
        <input type="text" name="password" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>"> <br><br>

        <div class="field-group">
            <div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> />
            <label for="remember-me">Remember me</label>
        </div>

        <input type="submit" value="submit">
    </form>
    <?php if (isset($login_error)) { echo '<p style="color: red;">' . $login_error . '</p>'; } ?>
    <P>Have not registered ? <a href="register.php">Register</a></P>

</body>
</html>