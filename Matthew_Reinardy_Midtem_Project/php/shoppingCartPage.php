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

//Default cost detail variables
$costDetails = [
    'totalBeforeDiscount' => 0,
    'discountAmount' => 0,
    'totalAfterDiscount' => 0,
];

//Checking of the cart has been initialized, if it is get all of the total items for the cart
//And calculate the cost for them
if (isset($_SESSION['shopping_cart'])) {
    $totalItems = $_SESSION['shopping_cart']->getTotalItems();
    $costDetails = $_SESSION['shopping_cart']->calculateTotalCost();
}

//Thank you message, only displayed if the user has checked out
if (isset($_SESSION['thank_you_message'])) {
    $thankYouMessage = $_SESSION['thank_you_message'];
} else {
    $thankYouMessage = '';
}

// Cart clearing, sending the shopping cart class
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['check_out'])) {
    if (isset($_SESSION['shopping_cart'])) {
        $_SESSION['shopping_cart']->shutdown();
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Homepage</title>
    <!--Main stylesheet, another one for specific styling only for this page-->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/shoppingCart.css">
</head>

<body>
    <!--Header-->
    <header>
        <!--Company logo-->
        <div class="logo">
            <h1>TechTrek</h1>
            <img src="../images/company-logo.png" alt="TechTrek Logo">
        </div>
        <div class="cart-icon">
            <a href="shoppingCart.php">
                <img src="../images/cart-icon.png" alt="Shopping Cart" class="cart-image">
            </a>
        </div>
        <!--Navigation Menu-->
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
    <!--Shopping Cart Table-->
    <h1 id="cartHeader">Your Cart [<?= $totalItems; ?> item(s)]</h1>
    <table>
        <tr>
            <th>Product</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        <?php if (isset($_SESSION['shopping_cart'])) { ?>
            <?php foreach ($_SESSION['shopping_cart']->items as $item) { ?>
                <?php
                // Create a new Product object for each item
                $product = new Product($item['name'], "", $item['image'], $item['price']);
                ?>
                <tr>
                    <td><img src="<?= $product->getShoppingCartImage(); ?>" alt="<?= $product->getName(); ?>"></td>
                    <td><?= $item['name']; ?></td>
                    <td>$<?= number_format($item['price'], 2); ?></td>
                    <td><?= $item['quantity']; ?></td>
                    <!--Total for the specific item, not grand total-->
                    <td>$<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
    <div class="total-container">
        <p>Total Before Discount: $<?= number_format($costDetails['totalBeforeDiscount'], 2); ?></p>
        <p>Discount: -$<?= number_format($costDetails['discountAmount'], 2); ?></p>
        <p>Final Total Amount: $<?= number_format($costDetails['totalAfterDiscount'], 2); ?></p>
    </div>

    <form method="post" action="">
        <div class="button-container">
            <button type="submit" name="check_out">Check Out</button>
        </div>
    </form>

    <div class="thank-you-message">
        <p><?= $thankYouMessage ?></p>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <h1>TechTrek</h1>
                <img src="../images/company-logo.png" alt="TechTrek Logo">
            </div>
            <p>&copy; 2024 TechTrek. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>