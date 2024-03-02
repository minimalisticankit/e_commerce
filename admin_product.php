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
//adding products to db
if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_price  = mysqli_real_escape_string($conn, $_POST['price']);
    $product_details = mysqli_real_escape_string($conn, $_POST['detail']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'img/' .$image;

    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$product_name' ") or die('query failed');
    if (mysqli_num_rows($select_product_name)>0){
        $message[] = 'product name already exist';
    }else{
        $insert_product = mysqli_query($conn, "INSERT INTO `products`(`name`, `price`, `product_details`, `image`) 
            VALUES('$product_name', '$product_price', '$product_details','$image')") or die('query failed');
        if ($insert_product) {
            if ($image_size >2000000000){
                $message[] = 'image size is too large';
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'product added sucessfully';
            }
        }
    }
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
    <div class="line3" ></div>
    <div class="line4"></div>
    <section class="show-products">
        <div class="box-container-product">
            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die(`query failed`);
                if(mysqli_num_rows( $select_products )>0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
                
            ?>
            <div class="box">
                <img src="image/<?php echo $fetch_products['image']; ?>">
                <p>price : $<?php echo $fetch_products['price']; ?></p>
                <h4><?php echo $fetch_products['name'];?></h4>
                <details><?php echo $fetch_products['product_detail'];?></details>
                <a href="admin_product.php?edit=<?php echo $fetch_products['id']?>" class="edit">edit</a>
                <a href="admin_product.php?delete=<?php echo $fetch_products['id']?>" class="delete" onclick="return confirm('want to delete this products');">delete</a>
            </div>
            <?php
                    }
                }else{
                        echo '
                        <div class="empty">
                            <p>no products added yet!</P>
                        </div>';

                }
            ?>
            <div class="empty">
                <p>no products added yet!</p>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>
