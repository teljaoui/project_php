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
            <form action="" id="checkout-form" method="post">
                <div class="form-group checkout-small-element">
                    <label for="register-name">Name</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label for="register-email">Email</label>
                    <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email"
                        required>
                </div>
                <div class="form-group checkout-small-element">
                    <label for="register-email">Phone</label>
                    <input type="text" class="form-control" id="phone-email" name="phone" placeholder="Phone" required>
                </div>
                <div class="form-group checkout-small-element">
                    <label for="register-email">City</label>
                    <input type="text" class="form-control" id="city-email" name="email" placeholder="City" required>
                </div>
                <div class="form-group checkout-large-element">
                    <label for="register-email">Adress</label>
                    <input type="text" class="form-control" id="adress-email" name="adress" placeholder="Adress"
                        required>
                </div>

                <div class="form-group checkout-btn-element">
                    <input type="submit" class="btn" id="checkout-btn" value="Checkout">
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