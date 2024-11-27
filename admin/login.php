<?php
include('server/connection.php');
session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header("Location: index.php?message=Welcome back, admin! Login successful.");
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    if ($email == "admin") {
        $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            header("Location: login.php?error=The email or password you entered is incorrect.");
            exit();
        } else {
            $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
            $stmt->fetch();

            if ($password === $user_password) {
                $_SESSION['admin'] = true;
                header("Location: index.php?message=Welcome back, admin! Login successful.");
                exit();
            } else {
                header("Location: login.php?error=The email or password you entered is incorrect.");
                exit();
            }
        }
    } else {
        header("Location: login.php?error=Access restricted to admin only.");
        exit();
    }
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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>



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
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password" name="password"
                        placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login" value="Login">
                </div>
            </form>
        </div>
    </section>




    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>