<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$total = 0;

if (isset($_SESSION['cart'])) {
    $total = count($_SESSION['cart']);
}

$currentPage = basename($_SERVER['PHP_SELF']);


?>

<style>
    .header-cart {
        text-decoration: none;
        text-align: start;
        font-size: 7px;
        padding: 3px 4px;
        background-color: coral;
        color: #fff;
        font-weight: 800;
        border-radius: 50%;
        position: absolute;
        margin-left: -9px;
        margin-top: -7px;
    }

    .navbar-light .navbar-nav .active {
        color: coral !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
        <a href="index.php" class="logo">
            <img class="navbar-brand" src="assets/imgs/logo.png">
            <span class="title-logo">Clothing</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  <?= $currentPage == 'index.php' ? 'active' : '' ?>" id="home-link"
                        href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?= $currentPage == 'shop.php' ? 'active' : '' ?>" id="shop-link"
                        href="shop.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?= $currentPage == 'contact.php' ? 'active' : '' ?>" id="contact-link"
                        href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-magnifying-glass" id="search-icon"></i>
                    <a href="cart.php" class="text-dark  <?= $currentPage == 'cart.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="header-cart"><?php echo $total; ?></span>
                    </a>
                    <a href="login.php"
                        class="text-dark <?= $currentPage == 'login.php' ? 'active' : (($currentPage == 'register.php' ? 'active' : ($currentPage == 'account.php' ? 'active' : '')))?>">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<form action="search.php" id="search-form" method="Post">
    <input type="search" placeholder="search here..." name="searchvalue" id="search-box">
    <button type="submit" name="search" class="fas fa-search"></button>
    <i class="fas fa-times" id="close"></i>
</form>