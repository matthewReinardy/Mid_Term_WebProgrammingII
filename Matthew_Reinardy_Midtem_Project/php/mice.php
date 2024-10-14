<?php
// Include class definitions before starting the session
include 'ShoppingCart.php';
include 'imageResizer.php';
include 'Product.php';
include 'ProductInventory.php';

session_start();

if (!isset($_SESSION['session_start_time'])) {
    $_SESSION['session_start_time'] = time();
}

// Initialize the shopping cart
if (!isset($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'] = new ShoppingCart(); // Store the shopping cart object
}

// Handle form submission for adding items to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_name'])) {

    // Finding out which keyboard was selected
    $productName = $_POST['product_name'];

    // Setting the quantity of the product, if we already have some we add to it
    if (isset($_POST['product_quantity'])) {
        $productQuantity = (int)$_POST['product_quantity'];
    } else {
        $productQuantity = 0;
    }

    // Find the product by name
    $inventory = new ProductInventory();
    $product = $inventory->findProductByName($productName);

    // Add product to the cart
    if ($product) {
        $_SESSION['shopping_cart']->addItem($product, $productQuantity);
    }
}

// Create an instance of ProductInventory
$inventory = new ProductInventory();

//Obtain the mice from the Product Inventory class
$mice = $inventory->getProductsByCategory(8, 4);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Mice</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/productPages.css">
</head>

<body>
    <!--Header-->
    <header>
        <div class="logo">
            <h1>TechTrek</h1>
            <img src="../images/company-logo.png" alt="TechTrek Logo">
        </div>
        <div class="cart-icon">
            <a href="shoppingCart.php">
                <img src="../images/cart-icon.png" alt="Shopping Cart" class="cart-image">
            </a>
        </div>
        <div class="nav-menu">
            <ul>
                <li><a href="homePage.php">Home</a></li>
                <li><a href="monitors.php">Monitors</a></li>
                <li><a href="keyboards.php">Keyboards</a></li>
                <li><a href="mice.php">Mice</a></li>
                <li><a href="shoppingCartPage.php">Your Cart</a></li>
            </ul>
        </div>
    </header>

    <!-- Mouse Products -->
    <div class="product-list">
        <?php foreach ($mice as $product) { ?>
            <div class="product">
                <img src="<?= $product->getResizedImage(); ?>" alt="<?= $product->getName(); ?>">
                <h2><?= $product->getName(); ?></h2>
                <p><?= $product->getDescription(); ?></p>
                <p class="price"><?= '$' . $product->getPrice(); ?></p>
                <form method="POST" action="mice.php">
                    <input type="hidden" name="product_name" value="<?= $product->getName(); ?>">
                    <label for="product_quantity">Quantity:</label>
                    <input type="number" name="product_quantity" id="product_quantity" value="1" min="1" max="10">
                    <button type="submit" class="add-to-cart">Add to Cart</button>
                </form>
            </div>
        <?php } ?>
    </div>

</body>

<!--Footer-->
<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <h1>TechTrek</h1>
            <img src="../images/company-logo.png" alt="TechTrek Logo">
        </div>
        <p>&copy; 2024 TechTrek. All Rights Reserved.</p>
    </div>
</footer>

</html>