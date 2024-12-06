<?php
    include "server.php";

    // start session
    session_start();
    // check inputs
    if(isset($_POST["login"])){
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
        $check_u_ex = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'") or die("Failed!!");
        if(mysqli_num_rows($check_u_ex) > 0){
           $row = mysqli_fetch_assoc($check_u_ex);
           $_SESSION['user_id'] = $row['id'];
           header("location: index.php");
        }else{
            $message[] = "Incorrect username or pass";   
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        if(isset($message)){
            foreach($message as $error){
                echo '<div class="message">'.$error.'</div>';
            }
        }
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h3>Register</h3>
            <input type="text" name="username" placeholder="enter username" required class="box">
            <input type="password" name="password" placeholder="enter password" required class="box">
            <input type="submit" name="login" class="btn" value="Login">
            <p>Don't have an account ? <a href="register.php">Register</a></p>
        </form>
    </div>
    
</body>
</html>