<?php
include 'connection.php';


$messages = '';

if (isset($_POST['submit-btn'])) {
    $name = mysqli_real_escape_string($conn, ($_POST['name']));
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, ($_POST['password']));

    $select_usert = mysqli_query($conn, "SELECT * FROM `user`  WHERE email = '$email'") or die('query failed');
    
    if (mysqli_num_rows($select_usert) > 0) {
        $message[] = 'user already exists';
    } else {
        mysqli_query($conn, "INSERT INTO `user` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')") or die('query failed');
        header('location:login.php');
        exit();
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style1.css">   
    <script src="https://kit.fontawesome.com/68f1c79717.js" crossorigin="anonymous"></script>
    <title>Register page</title>
</head>
<body> 
    <section class="form-container">
    <?php 
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo "<div class='message'>$msg<i class='fa-solid fa-xmark' onclick='this.parentElement.remove()' style='color: #ffffff;'></i></div>";
            }
        }
       
    ?>  
        <form method="post">
            <h1>register now</h1>
            <input type="text" name="name" placeholder="Enter your Name" required>
            <input type="email" name="email" placeholder="Enter you Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" name="submit-btn" value="register now" class="btn">
            <p>already have a account? <a href="login.php">Login now</a></p> 
</form>
</section>
</body>
</html>