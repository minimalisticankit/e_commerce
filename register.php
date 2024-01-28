<?php
include 'connection.php';

$message = "";

if (isset($_POST['submit-btn'])) {
    $filter_name = filter_var($_POST['name']);
    $name = mysqli_real_escape_string($conn, $filter_name);

    $filter_email = filter_var($_POST['email']);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password']);
    $password = mysqli_real_escape_string($conn, $filter_password);

    $filter_cpassword = filter_var($_POST['cpassword']);
    $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

    $select_usert = mysqli_query($conn, "SELECT * FROM `user`  WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_usert) > 0) {
        $message = 'user already exist';
    } else {
        if ($password != $cpassword) {
            $message = 'wrong password';
        } else {
            mysqli_query($conn, "INSERT INTO `user` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')") or die('query failed');
            $message = 'registered sucessfully';
            header('location:login.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel=' stylesheet'>
    <link rel="stylesheet" type="text/css" href="style1.css">   
    <script src="https://kit.fontawesome.com/68f1c79717.js" crossorigin="anonymous"></script>
    <title>Register page</title>
</head>
<body>



    
    <section class="form-container">
    <?php 
        if (isset($message)) {  
            // foreach( $message as $msg ) {
            ?>
            <div class='message'>
                <span><?=$message?></span>
                <script>alert(<?=$message?>)</script>
            <i class="fa-solid fa-xmark" onclick="this.parentElement.remove()" style="color: #ffffff;"></i>
            </div>   
            <?php 
          }
        // }
    ?>  
        <form method="post">
            <h1>register now</h1>
            <input type="text" name="name" placeholder="Enter your Name" required>
            <input type="email" name="email" placeholder="Enter you Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="password" name="cpassword" placeholder="Confirm Password" reqired>
            <input type="submit" name="submit-btn" value="register now" class="btn">
            <p>already have a account? <a href="login.php">Login now</a></p> 
</form>
</section>
</body>
</html>