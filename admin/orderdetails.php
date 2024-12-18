<?php
include("server/connection.php");

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("location:login.php?message=Please Login Now!");
    exit();
}


$order_info = [];
$order_item = [];

if (isset($_GET['order_id'])) {
    $order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
    $stmt = $conn->prepare("SELECT * FROM order_item Where order_id = ? ");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order_item = $stmt->get_result();

    $stmt1 = $conn->prepare("SELECT * FROM users u inner join orders o on u.user_id = o.user_id where o.order_id =?;");
    $stmt1->bind_param("i", $order_id);
    $stmt1->execute();
    $order_info = $stmt1->get_result()->fetch_assoc();

    if ($order_item->num_rows == 0 || !$order_info) {
        header("location:index.php?error=Order Item Not Found!");
    }
}

if (isset($_POST['confirmed'])) {
    $order_id = $_POST['order_id'];
    $stmt = $conn->prepare("UPDATE  orders set order_status = 'confirmed' where order_id = ? ;");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    if ($stmt->execute()) {
        header("location:orderdetails.php?order_id=$order_id&message=Statue Order updated successfully!");
    }


} else if (isset($_POST['shipped'])) {
    $order_id = $_POST['order_id'];
    $stmt = $conn->prepare("UPDATE  orders set order_status = 'shipped' where order_id = ? ;");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    if ($stmt->execute()) {
        header("location:orderdetails.php?order_id=$order_id&message=Statue Order updated successfully!");
    }


} else if (isset($_POST['delivered'])) {
    $order_id = $_POST['order_id'];
    $stmt = $conn->prepare("UPDATE  orders set order_status = 'delivered' where order_id = ? ;");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    if ($stmt->execute()) {
        header("location:orderdetails.php?order_id=$order_id&message=Statue Order updated successfully!");
    }

} else if (isset($_POST['delete'])) {
    $order_id = $_POST['order_id'];
    $stmt = $conn->prepare("DELETE from orders  where order_id = ? ;");
    $stmt1 = $conn->prepare("DELETE from order_item  where order_id = ? ;");
    $stmt->bind_param("i", $order_id);
    $stmt1->bind_param("i", $order_id);
    $stmt->execute();
    $stmt1->execute();
    if ($stmt->execute()) {
        header("location:index.php?message= Order Delete successfully!");
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>


<body>

    <section class="d-flex">
        <div class="acidebar">
            <?php include("acidebar.php") ?>

        </div>
        <div class="container content">
            <h2 class="mt-5 text-center">Order details</h2>
            <hr>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger text-center w-50 mx-auto">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php elseif (isset($_GET['message'])): ?>
                <div class="alert alert-success text-center w-50 mx-auto">
                    <?php echo $_GET['message']; ?>
                </div>
            <?php endif; ?>
            <div class="content-item my-5">
                <div class="userinfo">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="my-1">User Information</h4>
                            <hr class="mx-0">
                        </div>
                        <div>
                            <h4 class="status"><?php echo $order_info['order_status']; ?></h4>
                        </div>
                    </div>

                    <div class="usercontent">
                        <div>
                            <ul>
                                <li>
                                    <span>User Id: </span>
                                    <p><?php echo $order_info['user_id']; ?></p>
                                </li>
                                <li>
                                    <span>Name: </span>
                                    <p><?php echo $order_info['user_name']; ?></p>
                                </li>
                                <li>
                                    <span>Email: </span>
                                    <p><?php echo $order_info['user_email']; ?></p>
                                </li>
                                <li>
                                    <span>Adress: </span>
                                    <p><?php echo $order_info['user_adress']; ?></p>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <span>Phone: </span>
                                    <p><?php echo $order_info['user_phone']; ?></p>
                                </li>
                                <li>
                                    <span>City: </span>
                                    <p><?php echo $order_info['user_city']; ?></p>
                                </li>

                                <li>
                                    <span>Total: </span>
                                    <p class="text-success fw-bold">$<?php echo $order_info['order_cost'] ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-responsive dataview">
                    <table class="table datatable ">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_item as $item) { ?>
                                <tr>
                                    <td><?php echo $item['product_id'] ?></td>
                                    <td>
                                        <img src="../assets/imgs/<?php echo $item['product_image'] ?>" width="60"
                                            height="60" alt="">
                                    </td>
                                    <td><?php echo substr($item['product_name'], 0, 20) . (strlen($item['product_name']) > 20 ? '...' : ''); ?>
                                    </td>
                                    <td>$<?php echo $item['product_price'] ?></td>
                                    <td><?php echo $item['product_quantity'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-15 ">
                        <form action="orderdetails.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $order_info['order_id'] ?>">
                            <button name="confirmed" class="button confirmed">confirmed</button>
                        </form>
                        <form action="orderdetails.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $order_info['order_id'] ?>">
                            <button name="shipped" class="button shipped">shipped</button>
                        </form>
                        <form action="orderdetails.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $order_info['order_id'] ?>">
                            <button name="delivered" class="button delivered">delivered</button>
                        </form>
                        <form action="orderdetails.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $order_info['order_id'] ?>">
                            <button name="delete" class="button delete">delete</button>
                        </form>
                    </div>
                    <div>
                        <a href="received.php?order_id=<?php echo $_GET['order_id']; ?>" class="text-decoration-none">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Edit Received</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.querySelectorAll(".delete").forEach(function (button) {
            button.addEventListener("click", function (event) {
                if (!confirm("Are you sure you want to delete?")) {
                    event.preventDefault();
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const statueCm = document.querySelectorAll(".status");

            statueCm.forEach(function (statueCm) {
                const status = statueCm.textContent.trim();
                if (status === "shipped") {
                    statueCm.style.backgroundColor = "#ff9f43";
                } else if (status === "confirmed") {
                    statueCm.style.backgroundColor = "#1b2850"
                } else if (status === "delivered") {
                    statueCm.style.backgroundColor = "green"
                } else {
                    statueCm.style.backgroundColor = ""
                }
            })
        })

    </script>

    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>