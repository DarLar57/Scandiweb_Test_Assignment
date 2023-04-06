<?php

include_once('./other/initializing.php'); 

$titlePage = 'Product List';
// Deleting items from db via Controller
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delIdCheckBox'])) {
  $controller->delete();
// getting all Products when loading homepage indirectly via Controller
  $productsInDB = $controller->select_all();
}
?>
<?php include('./common/head.php'); ?>
<body>
  <header>
    <nav>
      <h2>Product List</h2>
      <div id='nav-btns'>
        <a type="button" href="add-product.php"><button id="add-prod-btn" >ADD</button></a> 
        <button type="submit" id="delete-product-btn" form="item_list"  name="delete">MASS DELETE</button>
      </div>
    </nav>
  </header>
  <main>
  <!-- Getting all the items -->
    <form id="item_list" method="POST">
        <?php foreach($productsInDB as $item) {?>
          <div class="product">
            <input type="checkbox" name="delIdCheckBox[]" id="<?= $item['id'] ?>" value="<?= $item['id'] ?>" class="delete-checkbox">
            <div class="product-spec">
              <p><?= $item['sku']; ?></p>
              <p><?= $item['name']; ?></p>
              <p><?= $item['price'] . ' $'; ?></p>
              <p>
                  <?php 
                  echo $item['weight'] != 0 ? "Weight: " . $item['weight'] . " KG" : '';
                  echo $item['size'] != 0 ?  "Size: " . $item['size'] . " MB" : '';
                  echo $item['dimensions'] != ('0' || null) ? 
                  "Dimensions: " . $controller->modify_db_dimensions($item['dimensions']): '';
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