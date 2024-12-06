<?php
    include "server.php";

    // check inputs
    if(isset($_POST["register"])){
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST["confirm_password"]));

        $check_u_ex = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'") or die("Failed!!");
        if(mysqli_num_rows($check_u_ex) > 0){
            $message[] = "change user name";
        }else{
            // Corrected the SQL syntax below
            mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')") or die("Failed!!");
            $message[] = "Registered Successfully";   
            header("location: login.php");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            <input type="email" name="email" placeholder="enter email" required class="box">
            <input type="password" name="password" placeholder="enter password" required class="box">
            <input type="password" name="confirm_password" placeholder="confirm password" required class="box">
            <input type="submit" name="register" class="btn" value="Register">
            <p>Already have an account ? <a href="login.php"> Login</a></p>
        </form>
    </div>
    
</body>
</html>