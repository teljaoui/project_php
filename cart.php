<?php
session_start();

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['cart'])) {
        $product_array_ids = array_column($_SESSION['cart'], "product_id");
        if (!in_array($_POST['product_id'], $product_array_ids)) {
            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_image' => $_POST['product_image'],
                'product_price' => $_POST['product_price'],
                'product_quantity' => $_POST['product_quantity']
            );
            $_SESSION['cart'][$_POST['product_id']] = $product_array;
        } else {
            echo '<script>alert("Product was already added to cart")</script>';
        }
    } else {
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_image' => $_POST['product_image'],
            'product_price' => $_POST['product_price'],
            'product_quantity' => $_POST['product_quantity']
        );
        $_SESSION['cart'][$_POST['product_id']] = $product_array;
    }

} else if (isset($_POST['edit_quantity'])) {
    $_SESSION['cart'][$_POST['product_id']] = [
        'product_id' => $_SESSION['cart'][$_POST['product_id']]['product_id'],
        'product_name' => $_SESSION['cart'][$_POST['product_id']]['product_name'],
        'product_image' => $_SESSION['cart'][$_POST['product_id']]['product_image'],
        'product_price' => $_SESSION['cart'][$_POST['product_id']]['product_price'],
        'product_quantity' => $_POST['product_quantity']
    ];
    echo '<script>alert("Product Quantity Updare successfully")</script>';
} else if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
} else {
    header('location:index.php');
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <a href="#" class="logo"><img class="navbar-brand" src="assets/imgs/logo.png"></img><span
                    class="title-logo">Clothing</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop.html">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
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


    <!--Cart-->

    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr class="mx-0">
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <a href="<?php echo "single_product.php?product_id=" . $value['product_id'] ?>">
                                <img src="assets/imgs/<?php echo $value['product_image']; ?>" alt="" srcset="">
                            </a>
                            <div>
                                <p><?php echo $value['product_name']; ?></p>
                                <small><span>$</span><?php echo $value['product_price']; ?></small>
                                <br>
                                <form action="" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                    <input type="submit" name="remove_product" class="remove-btn" value="Remove" />
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'] ?>"
                                min="1">
                            <input type="submit" value="Edit" class="edit-btn" name="edit_quantity">
                        </form>
                    </td>
                    <td>
                        <span>$</span>
                        <span class="product-price">155</span>
                    </td>

                </tr>
            <?php } ?>
        </table>
        <div class="cart-total">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$155</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>$155</td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <button class="btn checkout-btn">Checkout</button>
        </div>

    </section>







    <footer class="mt-5 py-4">
        <div class="row container mx-auto pt-2">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img src="assets/imgs/logo.png" class="" width="50" alt="" srcset="">
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