<?php
    include 'connection.php';
    session_start();

    if (isset($_POST['submit-btn'])){
        
        $filter_email = filter_var($_POST['email']);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password']);
        $password = mysqli_real_escape_string($conn, $filter_password);

        $select_usert = mysqli_query($conn, "SELECT * FROM `user`  WHERE email = '$email' AND password = '$password' ");

        if (mysqli_num_rows($select_usert)>0) {
            $row = mysqli_fetch_array($select_usert);
            if ($row['user_type']== 'admin'){
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_pannel.php');
            }else if($row['user_type']=='user'){
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location:index.php');
            }else{
                $message[] = 'incorrect email or password';
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
    <title>Register page</title>
</head>
<body>
    <?php 
        if (isset($message)) {
            echo "<div class='error'>$message</div>";
          }
    ?>
    <section class="form-container">
        <form method="post">
            <h1>login now</h1>
            <div class="input-field">
                <label>your email</label><br>
                <input type="email" name="email" placeholder="Enter you Email" required>
            </div>
            <div class="input-field">
                <label>your password</label><br>
                <input type="password" name="password" placeholder="Enter Password" required>
            </div>           
            <input type="submit" name="submit-btn" value="login now" class="btn">
            <p>do not have a account? <a href="register.php">Register now</a></p> 
</form>
</section>
</body>
</html>