<?php

include './components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    <!-- header section starts -->
    <?php include './components/heading.php'; ?>
    <!-- header section end -->

    <!-- orders section starts -->

    <section class="orders">

    <h1 class="head">My Orders</h1>

    <div class="box-container">

        <?php
        $select_orders = $conn->prepare("SELECT *FROM `orders` WHERE user_id = ? ORDER BY date DESC");
        $select_orders->execute([$user_id]);
        if ($select_orders->rowCount() >0) {
            while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <div class="box">
                    <p class="date"><i class="fa-regular fa-calendar"></i> <?= $fetch_order['date'];?></p>
                </div>
        <?php        
            }
        }else {
            echo '<p class="empty">orders not found!</p>';
        }
        ?>

    </div>

    </section>

    <!-- orders section end -->





    <!-- sweet alert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js file link -->
    <script src="./js/script.js"></script>

    <?php include './components/alert.php'; ?>

</body>
</html>