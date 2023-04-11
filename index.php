<?php

include_once('./initialize/initializing.php'); 

$titlePage = 'Product List';

// Deleting items from db indirectly via Controller
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delIdCheckBox'])) {
    $controller->orderDeleteProducts();
}

include('./common/head.php');
?>

<body>
  <header>
    <nav>
      <h2>Product List</h2>
      <div id='nav-btns'>
        <a type="button" href="add-product.php"><button id="add-prod-btn">ADD</button></a> 
        <button type="submit" id="delete-product-btn" form="item_list"  name="delete">
          MASS DELETE
        </button>
      </div>
    </nav>
  </header>
  <main>
    <!-- Getting all the items -->
    <form id="item_list" method="POST">
 
        <!-- getting all Products when loading homepage indirectly via
        Controller by use of DB class-->
        <?php foreach($controller->orderAllProducts() as $item) { $i = 0; ?>
      
            <div class="product">
            <input type="checkbox" name="delIdCheckBox[]" id="<?= $item[$i] ?>"
            value="<?= $item[$i] ?>" class="delete-checkbox">
              <div class="product-spec">
                <p><?= $item[++$i]; ?></p>
                <p><?= $item[++$i]; ?></p>
                <p><?= $item[++$i] . ' $'; ?></p>
                <p>
        <?php echo $item[++$i] != 0 ? "Weight: " . $item[$i] . " KG" : '';
            echo $item[++$i] != 0 ?  "Size: " . $item[$i] . " MB" : '';
            echo $item[++$i] != ('0' || null) ?
                "Dimensions: " . $controller->modify_db_dims($item[$i]): '';
        ?>
                </p>
              </div>
            </div>

        <?php }; ?>

  </form>
</main>

    <?php include('./common/footer.php'); ?>

</body>
</html>