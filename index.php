<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <a href="#" class="logo">
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
                        <a class="nav-link active" id="home-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="shop-link" href="shop.html">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="blog-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <i class="fa-solid fa-magnifying-glass" id="search-icon"></i>
                        <a href="" class="text-dark"><i class="fa-solid fa-cart-shopping"></i></a>
                        <a href="" class="text-dark"><i class="fa-solid fa-user"></i></a>
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

    <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span>Best Prices</span> For This Season</h1>
            <p>Eshop offers the best products for the most affordable prices</p>
            <button>Shop Now</button>
        </div>
    </section>

    <section id="brand" class="container">
        <div class="row">
            <img src="assets/imgs/brand1.jpg" class="col-4 col-sm-4 col-md-2">
            <img src="assets/imgs/brand2.jpg" class="col-4 col-sm-4 col-md-2">
            <img src="assets/imgs/brand3.jpg" class="col-4 col-sm-4 col-md-2">
            <img src="assets/imgs/brand4.png" class="col-4 col-sm-4 col-md-2">
            <img src="assets/imgs/brand5.jpg" class="col-4 col-sm-4 col-md-2">
            <img src="assets/imgs/brand6.png" class="col-4 col-sm-4 col-md-2">
        </div>
    </section>


    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/1.jpg" alt="" srcset="">
                <div class="details">
                    <h2>Women's clothing</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/3.jpg" alt="" srcset="">
                <div class="details">
                    <h2>Men clothing</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/4.jpg" alt="" srcset="">
                <div class="details">
                    <h2>Accessory</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>
        </div>
    </section>

    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Featured</h3>
            <hr>
            <p>Here you can check out new featured products</p>
        </div>
        <div class="row mx-auto container-fluid">
            <?php include('server/get_featured_product.php'); ?>
            <?php while($row= $featured_products->fetch_assoc()){ ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'] ?>">
                <div class="start">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
                <h4 class="p-price"><?php echo $row['product_price'] ?></h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <?php }?>
            
        </div>
    </section>

    <section class="my-5 py-5" id="banner">
        <div class="container">
            <h4>MID SEASEON'S SALE</h4>
            <h1>Autumn Collection <br> UP to 30% OFF</h1>
            <button class="text-uppercase">shop now</button>
        </div>
    </section>


    <!--clothes-->

    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Dresses & Coats</h3>
            <hr>
            <p>Here you can check out our amazing clothes</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/featured.jpg">
                <div class="start">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/featured.jpg">
                <div class="start">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/featured.jpg">
                <div class="start">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/featured.jpg">
                <div class="start">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>

                </div>
                <h5 class="p-name">Sports Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>



    <footer class="mt-5 py-4">
        <div class="row container mx-auto pt-2">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img src="assets/imgs/logo.png" class="" width="50" alt="" srcset="" >
                <p class="pt-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit, sequi?</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-3">Featured</h5>
                <ul class="text-uppercase">
                    <li><a href="#">Men</a></li>
                    <li><a href="#">women</a></li>
                    <li><a href="#">Accessory</a></li>
                </ul>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-3">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>1234 test , city</p>
                </div>
                <div>
                    <h6 class="text-uppercase">phone</h6>
                    <p>1234567894</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>info@email.com</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Trademarks
                </h5>
                <div class="row">
                    <img src="assets/imgs/brand1.jpg" alt="" srcset="" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/brand2.jpg" alt="" srcset="" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/brand3.jpg" alt="" srcset="" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/brand4.png" alt="" srcset="" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/brand5.jpg" alt="" srcset="" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/brand6.png" alt="" srcset="" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/brand7.jpg" alt="" srcset="" class="img-fluid w-25 h-100 m-2">
                    <img src="assets/imgs/brand9.jpg" alt="" srcset="" class="img-fluid w-25 h-100 m-2">
                    
                </div>
            </div>
        </div>

        <div class="copyright py-3">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img src="assets/imgs/payment.png" alt="" srcset="" width="50">
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                    <p>ecomerce @ 2025 All Right Reserved</p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12">
                    <a href=""><i class="fab fa-facebook"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>



    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>