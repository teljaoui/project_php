<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("server/connection.php");

if (isset($_POST['logout'])) {
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);
    $_SESSION['logged_in'] = false;
    if ($_SESSION['redirect']) {
        $_SESSION['redirect'] = false;
    }
    header('location:login.php?message=You have logged out successfully!');
    exit();
} else if (!$_SESSION['logged_in']) {
    header('location:login.php');
    exit();
}

$orders = [];
$message = "";

if ($_SESSION['logged_in']) {
    $stmt = $conn->prepare("SELECT * FROM orders where user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);

    if (empty($orders)) {
        $message = "You don't have any order";
    }


}

if (isset($_POST['updatePassword'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if ($password !== $confirmPassword) {
        header('location: account.php?error=Passwords do not match');
        exit();
    } else if (strlen($password) < 6) {
        header('location: account.php?error=Password must be at least 6 characters');
        exit();
    } else {
        $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
        $stmt->bind_param("ss", md5($password), $_SESSION['user_email']);
        $stmt->execute();
        header("location: account.php?message=Password updated successfully!");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['user_name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
    #order-btn {
        text-decoration: none;
        color: #fb774b;
        transition: 0.5s ease;
        background-color: #fff;
        border: 0px;
    }

    #order-btn:hover {
        color: #222222;
    }

    .order-details {
        cursor: pointer;
        transition: 0.7s ease;
    }

    .order-details:hover {
        background-color: #222222;
        color: #fff;
    }

    @media only screen and (max-width:990px) {

        #login-form input,
        #register-form input,
        #account-form input {
            width: 90%;
        }

        #login-form,
        #register-form {
            width: 100%;
        }

        #login-form .alert,
        #register-form .alert {
            width: 100% !important;
        }
    }
</style>

<body>


    <?php include('layout/header.php'); ?>


    <!--Login-->


    <section class="my-5 py-5">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger mt-4 w-75 mx-auto mb-0">
                <?php echo $_GET['error']; ?>
            </div>
        <?php elseif (isset($_GET['message'])): ?>
            <div class="alert alert-success mt-4 w-75 mx-auto mb-0">
                <?php echo $_GET['message']; ?>
            </div>
        <?php endif; ?>
        <div class="row container mx-auto">
            <div class="text-center pt-5 col-lg-6 col-md-12 col-sm-12">
                <h3 class="font-weight-bold">Account info</h3>
                <hr>
                <div class="account-info">
                    <p>Name: <span><?php echo $_SESSION['user_name'] ?></span></p>
                    <p>Email: <span><?php echo $_SESSION['user_email'] ?></span></p>
                    <p><a href="#orders" id="order-btn">Your Orders</a></p>
                    <form action="account.php" method="post">
                        <input type="submit" id="order-btn" value="Logout" name="logout" />
                    </form>
                </div>
            </div>
            <div class="text-center pt-5 col-lg-6 col-md-12 col-sm-12">
                <form action="account.php" method="post" id="account-form">
                    <h3>Change Password</h3>
                    <hr>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" id="account-password"
                            placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control" id="account-password"
                            placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="updatePassword" class="btn text-white" id="change-pass-btn"
                            value="Update">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="cart" id="orders">
        <div class="container">
            <div class="text-center">
                <h3 class="font-weight-bold">Your Orders</h3>
                <hr>
            </div>
            <?php if (!empty($message)): ?>
                <div class="text-center">
                    <p><?php echo $message ?></p>
                    <a href="shop.php" class="button">Shop Now</a>
                </div>
            <?php elseif (!empty($orders)): ?>
                <table class="mt-5 pt-5">
                    <tr>
                        <th>order id</th>
                        <th>Order Cost</th>
                        <th>Order Statue</th>
                        <th>Order Date</th>
                        <th>Order Details</th>
                    </tr>
                    <?php foreach ($orders as $row): ?>
                        <tr>

                            <td><?php echo $row['order_id'] ?></tdù>
                            <td>$<?php echo $row['order_cost'] ?></td>
                            <td><?php echo $row['order_status'] ?></td>
                            <td><?php echo $row['order_date'] ?></td>
                            <td>
                                <form action="order_details.php" name="click" method="Post">
                                    <input type="hidden" name="order_status" value="<?php echo $row['order_status']; ?>">
                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                    <input type="submit" value="details" name="order_details" class="btn order-details w-50">
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </section>




    <?php include("layout/footer.php") ?>
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>