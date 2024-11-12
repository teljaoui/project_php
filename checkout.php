<?php

session_start();

if (!empty($_SESSION['cart'])) {
    if (!$_SESSION['logged_in']) {
        header(header: 'location:login.php?message=Please Login Now');
    }
} else {
    echo '<script>alert("Cart is empty"); window.location.href="shop.php";</script>';
    exit();
}


?>



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
    <?php include('layout/header.php'); ?>


    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">che ckout</h2>
            <hr>
        </div>
        <div class="container mx-auto">
            <form action="server/place_order.php" id="checkout-form" method="post">
                <div class="form-group checkout-small-element">
                    <label for="checkout-name">Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" value="<?php echo $_SESSION['user_name'] ?>" readonly  required>
                </div>
                <div class="form-group checkout-small-element">
                    <label for="checkout-email">Email</label>
                    <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email"
                    value="<?php echo $_SESSION['user_email'] ?>" readonly  required>
                </div>
                <div class="form-group checkout-small-element">
                    <label for="checkout-phone">Phone</label>
                    <input type="text" class="form-control" id="checkout-phone" name="phone" placeholder="Phone"
                        required>
                </div>
                <div class="form-group checkout-small-element">
                    <label for="checkout-city">City</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
                </div>
                <div class="form-group checkout-large-element">
                    <label for="checkout-adress">Adress</label>
                    <input type="text" class="form-control" id="checkout-adress" name="adress" placeholder="Adress"
                        required>
                </div>

                <div class="form-group checkout-btn-element">
                    <p>Total amount: $ <?php echo $_SESSION['total'] ?></p>
                    <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
                </div>
            </form>
        </div>

    </section>


    <?php include("layout/footer.php") ?>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>