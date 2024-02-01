<?php
include 'connection.php';
session_start();

$error_message = '';

if (isset($_POST['submit-btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $select_usert = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$password'");

    if (mysqli_num_rows($select_usert) > 0) {
        $row = mysqli_fetch_assoc($select_usert);
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location: admin_pannel.php');
            exit();
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location: index.php');
            exit();
        } else {
            $error_message = 'Incorrect email or password';
        }
    } else {
        $error_message = 'Incorrect email or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/68f1c79717.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style1.css">   
    <title>Login Page</title>
</head>
<body>
    
    <section class="form-container">
    <?php 
        if (!empty($error_message)) {
            echo "<div class='error'>$error_message<i class='fa-solid fa-xmark' onclick='this.parentElement.remove()' style='color: #ffffff;'></i></div>";
        }
    ?>
        <form method="post">
            <h1>Login Now</h1>
            <div class="input-field">
                <label>Your email</label><br>
                <input type="email" name="email" placeholder="Enter your Email" required>
            </div>
            <div class="input-field">
                <label>Your password</label><br>
                <input type="password" name="password" placeholder="Enter Password" required>
            </div>           
            <input type="submit" name="submit-btn" value="Login Now" class="btn">
            <p>Don't have an account? <a href="register.php">Register now</a></p> 
        </form>
    </section>
</body>
</html>
