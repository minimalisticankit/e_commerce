<?php
    include 'connection.php';
    $admin_id = $_SESSION['admin_name'];

    if (!isset($admin_id)){
        header('location:login.php');
    }

    if (!isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }
?>