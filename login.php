<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("server/connection.php");

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header("Location: account.php?message=Welcome back, " . urlencode($_SESSION['user_name']) . "!");
    exit();
} elseif (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = md5($password);

    $stmt = $conn->prepare("SELECT user_name, user_email FROM users WHERE user_email = ? AND user_password = ?");
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        header("location:login.php?error=The email or password you entered is incorrect.");
        exit();
    } else {
        $stmt->bind_result($user_name, $user_email);
        $stmt->fetch();

        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['logged_in'] = true;

        header("location:account.php?message=Welcome back, $user_name!");
        exit();
    }

    $stmt->close();
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
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


    <!--Navbar-->
    <?php include('layout/header.php'); ?>

    <!--Login-->


    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr>
        </div>
        <div class="container mx-auto">
            <form action="login.php" id="login-form" method="post">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger text-center w-50 mx-auto">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php elseif (isset($_GET['message'])): ?>
                    <div class="alert alert-success text-center w-50 mx-auto">
                        <?php echo $_GET['message']; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password" name="password"
                        placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login" value="Login">
                </div>
                <div class="form-group">
                    <a href="register.php" id="register-url">If you don't have an account? Register Now</a>
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