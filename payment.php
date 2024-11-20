<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!(isset($_SESSION['total']))) {
    header('location:index.php');
}

if(isset($_POST['order_pay_btn'])){
    $_POST['order_status'];
    $_SESSION['total'] = $_POST['total_order_price'];
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
            <h2 class="form-weight-bold">Payment</h2>
            <hr>
        </div>
        <div class="container mx-auto text-center">
            <?php if (isset($_GET['order_status'])) { ?>
                <div class="alert alert-success w-50 mx-auto">
                   <?php echo $_GET['order_status']; ?> 
                </div>
            <?php } ?>

            <p>Total Payment: $<?php if (isset($_SESSION['total'])) {
                echo $_SESSION['total'];
            } ?></p>
            <?php if (isset($_SESSION['total'])) { ?>
                <input type="submit" class="btn btn-primary" value="Pay Now">
            <?php } ?>
        </div>

    </section>


    <?php include("layout/footer.php") ?>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>