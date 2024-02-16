<?php
session_start(); // Start the session
include 'connection.php';

$admin_id = $_SESSION['admin_name'];

if (!isset($admin_id)){
    header('location: login.php');
    exit(); // Add exit after header to stop script execution
}

if (isset($_POST['logout'])){
    session_destroy();
    header('location: login.php');
    exit(); // Add exit after header to stop script execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title>Admin Panel</title>
</head>
<body>
    <?php include 'admin_header.php';?>
    <?php 
        if (!empty($message)) {
            foreach ($message as $msg) {
                echo "<div class='message'>$msg<i class='fa-solid fa-xmark' onclick='this.parentElement.remove()' style='color: #ffffff;'></i></div>";
            }
        }   
    ?>
    <div class="line2"></div> 
    <section class="add-products form-container-product">
        <form method ="POST" action="" enctype="multipart/form-data">
        <div class="input-field-product">
            <label>product name</label>
            <input type="text" name="name" required>
        </div>
        <div class="input-field-product">
            <lable>Product price</lable>
            <input type="text" name="price" required>
        </div>
        <div class="input-field-product">
            <lable>Product detail</lable>
            <input type="detail" name="detail" required>
        </div>
        <div class="input-field-product">
            <lable>Product image</lable>
            <input type="file" name="image" accept="image/jpg, imahe/jpeg, image/png, image/webp" required>
        </div>
        <input type="submit" name="add_product" value="add product" class="btn">
    </section>
    <script src="script.js"></script>
</body>
</html>
