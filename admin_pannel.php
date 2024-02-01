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
    <title>Admin Panel</title>
</head>
<body>
    <?php include 'admin_header.php';?>
</body>
</html>
