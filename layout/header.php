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
                    <a class="nav-link active" id="home-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="shop-link" href="shop.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="blog-link" href="blog.php">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-link" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-magnifying-glass" id="search-icon"></i>
                    <a href="cart.php" class="text-dark"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="login.php" class="text-dark"><i class="fa-solid fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<form action="" id="search-form">
    <input type="search" placeholder="search here..." name="" id="search-box">
    <label for="search-box" class="fas fa-search"></label>
    <i class="fas fa-times" id="close"></i>
</form>