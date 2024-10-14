<!--I made a GitHub project repo to break down this large project into
smaller manageable bits and pieces, something we are leaning about in our 
Cross Platform Mobile Application class. If you are interested to check it , I will put
the link below:

https://github.com/users/matthewReinardy/projects/6

-->
<?php
session_start();

//Used for the discount, im going to put this on every page but the homepage should be the first one loaded, but
//There is a chance another one is loaded first.
if (!isset($_SESSION['session_start_time'])) {
    $_SESSION['session_start_time'] = time();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Homepage</title>
    <!--Main stylesheet, another one for specific styling only for this page-->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/homePage.css">

</head>

<body>
    <!--Header-->
    <header>
        <!--Company logo-->
        <div class="logo">
            <h1>TechTrek</h1>
            <img src="../images/company-logo.png" alt="TechTrek Logo">
        </div>
        <!--Link to the shopping cart page-->
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

    <!--Main content for homepage-->
    <div class="company-description">
        <h2>Welcome to TechTrek!</h2>
        <p>Your one-stop shop for the latest and greatest tech products. At TechTrek, we pride ourselves on offering high-quality monitors, keyboards, and mice to enhance your computing experience.</p>
        <img src="../images/Unknown.jpeg" alt="Description of the image">
        <p>Explore our range of products:</p>
        <ul>
            <li><a href="monitors.php">View Monitors</a></li>
            <li><a href="keyboards.php">View Keyboards</a></li>
            <li><a href="mice.php">View Mice</a></li>
        </ul>
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