<?php

require('./app/initializing.php'); 

$titlePage = 'Product Add';

include ('./app/head-footer/head.php'); 

?>

<body>
    <header>
        <nav>
            <h2>Product Add</h2>  
            <div id="form-buttons">
                <button type="submit" id="submit" name="submit" form="product_form">
                Save
                </button>
                <a href="./index.php">
                <button type="button" id="cancel">Cancel</button>
                </a>
            </div>
        </nav>
    </header>
<main>
    <form id="product_form" method='POST' action="">
        <label for="sku">SKU</label>
        <input type="text" name="sku" id="sku" maxlength="10" placeholder="ABC012345" value="<?= $_POST ['sku'] ?? ''; ?>">
        <br><br>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" maxlength="40" placeholder="Name of product" value="<?= $_POST['name'] ?? ''; ?>">
        <br><br>
        <label for="price">Price ($)</label>
        <input type="text" name="price" id="price" placeholder="0.00" value="<?= $_POST['price'] ?? ''; ?>">
        <br><br>
        <label for="productType">Type Switcher</label>
        <select name="typeSwitcher" id="productType">

        <!-- Getting arr of Prod. types via Controller using getter method in extended Prod. Class -->
        <?php foreach($controller->getProductTypes() as $type) {?>
    
            <option value=<?= '"' . $type . '"'; ?> id=<?= '"' . strtolower($type) . '"'; ?>
            <?= $controller->selected($type); ?>><?= $type; ?>
          </option>
    
        <?php }; ?>
    
        </select>
        <div id="size-cont">
            <p>Please provide size in MB.</p>
            <label for="size">Size (MB)</label>
            <input type="text" name="size" id="size" placeholder="0" maxlength="10" value="<?= $_POST ['size'] ?? ''; ?>">
        </div>
        <div id="weight-cont">
            <p>Please provide weight in kg.</p>
            <label for="weight">Weight (kg)</label>
            <input type="text" name="weight" id="weight" placeholder="0.00" maxlength="4" value="<?= $_POST['weight'] ?? ''; ?>">
        </div>
        <div id="dims-cont">
            <p>Please provide dimensions in H*W*L format (Height / Width / Length).</p>
            <label for="height">Height (cm)</label>
            <input type="text" name="height" id="height" placeholder="0" maxlength="4" value="<?= $_POST ['height'] ?? ''; ?>">
            <label for="width">Width (cm)</label>
            <input type="text" name="width" id="width" placeholder="0" maxlength="4" value="<?= $_POST ['width'] ?? ''; ?>">
            <label for="length">Length (cm)</label>
            <input type="text" name="length" id="length" placeholder="0" maxlength="4" value="<?= $_POST ['length'] ?? ''; ?>">
        </div>
    </form>
    <?= $errs; ?>

</main>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js">
    </script>
    <script src='./app/frontend-js-css/js/script.js'>
    </script>
</body>
</html>