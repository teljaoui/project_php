<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("server/connection.php");


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header("Location: account.php?message=Welcome back, " . urlencode($_SESSION['user_name']) . "!");
    exit();
} else if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password != $confirmPassword) {
        header('location: register.php?error=Password does not match');
        exit();
    } else if (strlen($password) < 6) {
        header('location: register.php?error=Password must be at least 6 characters');
        exit();
    } else {
        $stmt1 = $conn->prepare("SELECT * FROM users where user_email=?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->store_result();
        if ($stmt1->num_rows != 0) {
            header("location:register.php?error=User with this email already exists");
            exit();
        } else {
            $stmt = $conn->prepare("INSERT INTO users (user_name , user_email , user_password) value (?,?,?)");
            $stmt->bind_param('sss', $name, $email, md5($password));
            $stmt->execute();
            header('location:login.php?message=Registration successful! Please log in.');
            exit();
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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



    <?php include('layout/header.php'); ?>


    <!--Login-->


    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr>
        </div>
        <div class="container mx-auto">
            <form action="register.php" id="register-form" method="post">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger text-center w-50 mx-auto">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="register-name">Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="register-email">Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Email"
                        required>
                </div>
                <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" class="form-control" id="register-password" name="password"
                        placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="register-confirm-password"">Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword"
                        placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn text-white" id="register-btn" name="register" value="Register">
                </div>
                <div class="form-group">
                    <a href="login.php" id="register-url">If you have an account? login Now</a>
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