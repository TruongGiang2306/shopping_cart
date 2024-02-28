<?php

include './components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if (isset($_POST['add_product'])) {
    $id = create_unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = create_unique_id().'.'.$ext;
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files/'.$rename;
    $image_size = $_FILES['image']['size'];

    if ($image_size > 2000000) {
        $warning_msg[] = 'Image size is too large';
    } else {
        $insert_product = $conn->prepare("INSERT INTO `products`(id, name, price, image) VALUES (?,?,?,?)");
        $insert_product->execute([$id, $name, $price, $rename]);
        $success_msg[] = 'Product uploaded successfully!';
        move_uploaded_file($image_tmp_name, $image_folder);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    <!-- header section starts -->
    <?php include './components/heading.php'; ?>
    <!-- header section end -->

    <!-- add product section starts -->
<section class="add-product">
    <form action="" method="POST" enctype="multipart/form-data">
        <h3>product details</h3>

        <p>product name <span>*</span></p>
        <input type="text" name="name" required maxlength="50" placeholder="enter product name" class="box">

        <p>product price <span>*</span></p>
        <input type="number" name="price" required maxlength="10" min="0" max="9999999999" placeholder="enter product price" class="box">

        <p>product image <span>*</span></p>
        <input type="file" name="image" required accept="image/*" class="box">

        <input type="submit" value="add product" name="add_product" class="btn">
    </form>
</section>
    <!-- add product section end -->






    <!-- sweet alert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js file link -->
    <script src="./js/script.js"></script>

    <?php include './components/alert.php'; ?>

</body>
</html>