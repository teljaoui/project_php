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


    <?php include('layout/header.php'); ?>

    <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span>Best Prices</span> For This Season</h1>
            <p>Eshop offers the best products for the most affordable prices</p>
            <a href="shop.php" class="button">Shop Now</a>
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
                    <a href="shop.php" class="button">Shop Now</a>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/3.jpg" alt="" srcset="">
                <div class="details">
                    <h2>Men clothing</h2>
                    <a href="shop.php" class="button">Shop Now</a>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/imgs/4.jpg" alt="" srcset="">
                <div class="details">
                    <h2>Accessory</h2>
                    <a href="shop.php" class="button">Shop Now</a>
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
            <?php while ($row = $featured_products->fetch_assoc()) { ?>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <a href="<?php echo "single_product.php?product_id=" . $row['product_id'] ?>"
                        class="text-decoration-none text-dark">
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
                    </a>
                </div>
            <?php } ?>

        </div>
    </section>

    <section class="my-5 py-5" id="banner">
        <div class="container">
            <h4>MID SEASEON'S SALE</h4>
            <h1>Autumn Collection <br> UP to 30% OFF</h1>
            <a href="shop.php" class="button">Shop Now</a>
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


    <?php include("layout/footer.php") ?>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>