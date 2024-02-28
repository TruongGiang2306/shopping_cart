<header class="heading">

  <section class="flex">
    <a href="/shopping_cart/view_products.php" class="logo">Logo</a>

    <nav class="navbar">
      <a href="/shopping_cart/add_product.php">add product</a>
      <a href="/shopping_cart/view_products.php">view products</a>
      <a href="/shopping_cart/orders.php">my orders</a>
      <?php 
        $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $count_cart_items->execute([$user_id]);
        $total_cart_items = $count_cart_items->rowCount();
      ?>
      <a href="/shopping_cart/shopping_cart.php">cart <span><?= $total_cart_items; ?></span></a>
    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>

  </section>

</header>