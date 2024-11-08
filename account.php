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


<!--Login-->


<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <h3 class="font-weight-bold">Account info</h3>
            <hr>
            <div class="account-info">
                <p>Name <span>John</span></p>
                <p>Email <span>John@email.com</span></p>
                <p><a href="" id="order-btn">Your Orders</a></p>
                <p><a href="" id="order-btn">Logout</a></p>
            </div>
        </div>
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <form action="" method="post" id="account-form">
                <h3>Change Password</h3>
                <hr>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" id="account-password"
                        placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="confirm-password" class="form-control" id="account-password"
                        placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="confirm-password" class="btn" id="change-pass-btn" value="Update">
                </div>
            </form>
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