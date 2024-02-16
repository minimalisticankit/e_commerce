<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/68f1c79717.js" ></script>
    <title>Document</title>
</head>

<body>
    <header class="header">
        <div class="flex">
            <a href="admin_pannel.php" class="logo"><img src="img/img3.png"></a>
            <nav class="navbar">
                <a href="admin_pannel.php">home</a>
                <a href="admin_product.php">product</a>
                <a href="admin_order.php">order</a>
                <a href="admin_user.php">users</a>
                <a href="admin_message.php">message</a>
            </nav>
            <div class="icons">
                <i class="fa-solid fa-user-secret" id="user-btn"></i>
                <i class="fa-solid fa-bars" id="menu-btn"></i>
            </div>
            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <form method="POST">
                    <button type="submit" name="logout" class="logout-btn">log out</button>
                </form>
            </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>admin dashboard</h1>
            <p>Welcome to admin panel! Here you can manage your store.</p>
        </div>
    </div>
    <div class="line"></div>  
</body>

</html>
