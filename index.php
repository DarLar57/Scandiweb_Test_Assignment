<?php

include_once('./app/initializing.php'); 

$titlePage = 'Product List';

include('./app/head-footer/head.php');

?>
<body>
    <header>
        <nav>
            <h2>Product List</h2>
            <div id='nav-btns'>
                <a type="button" href="add-product.php"><button id="add-prod-btn">ADD</button></a> 
                <button type="submit" id="delete-product-btn" form="item_list" name="delete">MASS DELETE</button>
            </div>
        </nav>
    </header>
    <main>
    <form id="item_list" method="POST">
 
        <!-- Getting arr of Prod. via Controller requesting relevant Class from db -->
        <?php foreach($controller->getAllProducts() as $item) { $i = 0; ?>
      
            <div class="product">
                <input type="checkbox" name="delIdCheckBox[]" id="<?= $item[$i] ?>
                "value="<?= $item[$i] ?>" class="delete-checkbox">
                <div class="product-spec">
                    <p><?= $item[++$i]; ?></p>
                    <p><?= $item[++$i]; ?></p>
                    <p><?= $item[++$i] . ' $'; ?></p>

        <?php echo $item[++$i] != 0 ? "Weight: " . $item[$i] . " KG" : '';
            echo $item[++$i] != 0 ?  "Size: " . $item[$i] . " MB" : '';
            echo $item[++$i] != ('0' || null) ? "Dimensions: " . $controller->modifyDims($item[$i]): ''; ?>
                
              </div>
            </div>
        <?php }; ?>
    </form>
</main>

<?php include('./app/head-footer/footer.php'); ?>

</body>
</html>