<?php

include("server/connection.php");

$orders = [];
$limit = 5;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $limit;

if (isset($_POST['searchorder'])) {

    $order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);

    if ($order_id) {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $orders = $stmt->get_result();
        if ($orders->num_rows === 0) {
            header("location:index.php?error= order_id Not Found");
            exit();
        }
    } else {
        header("location:index.php?error=Invalid order_id ID");
    }
    $total_pages = 1;
} else if (isset($_GET['user_id']) && filter_var($_GET['user_id'], FILTER_VALIDATE_INT)) {

    $user_id = $_GET['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $orders = $stmt->get_result();

    $total_pages = 1;
    if ($orders->num_rows === 0) {
        header("location:index.php?error= Orders of user Not Found");
        exit();

    }
} else {
    $stmt = $conn->prepare("SELECT * FROM orders LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $orders = $stmt->get_result();
    $stmt_total = $conn->prepare("SELECT COUNT(*) AS total FROM orders");
    $stmt_total->execute();
    $result_total = $stmt_total->get_result();
    $total_row = $result_total->fetch_assoc();
    $total_products = $total_row['total'];

    $total_pages = ceil($total_products / $limit);

    $stmt_total->close();
}

$stmt->close();



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
            <h2 class="mt-5 text-center">Orders</h2>
            <hr>
            <div class="mx-5 d-flex justify-content-end">
                <form action="index.php" method="post" class="d-flex">
                    <input type="number" class="form-control" id="product-name" name="order_id" placeholder="Order ID"
                        required>
                    <input type="submit" value="Search" class="button" name="searchorder">
                </form>
            </div>
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
                <div class="table-responsive dataview">
                    <table class="table datatable ">
                        <thead>
                            <tr>
                                <th>order Id</th>
                                <th>Order Status</th>
                                <th>User ID</th>
                                <th>Order Date</th>
                                <th>User Phone</th>
                                <th>User City</th>
                                <th>Details</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order) { ?>
                                <tr>
                                    <td><?php echo $order['order_id']; ?></td>
                                    <td><?php echo $order['order_status'] ?></td>
                                    <td><?php echo $order['user_id'] ?></td>
                                    <td><?php echo $order['order_date'] ?></td>
                                    <td><?php echo $order['user_phone'] ?></td>
                                    <td><?php echo $order['user_city'] ?></td>
                                    <td>
                                        <a href="" class="btn btn-primary">DETAILS</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 d-flex justify-content-center text-center pt-4">
                    <nav aria-label="Page navigation example" class="paginate">
                        <?php
                        $pages_per_group = 4;
                        $current_group = ceil($page / $pages_per_group);
                        $start_page = ($current_group - 1) * $pages_per_group + 1;
                        $end_page = min($start_page + $pages_per_group - 1, $total_pages);
                        $show_next_page = $end_page < $total_pages;
                        if ($show_next_page) {
                            $end_page += 1;
                        }
                        ?>
                        <ul class="pagination">
                            <li class="page-item <?php if ($page <= 1)
                                echo 'disabled'; ?>">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                            </li>

                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <li class="page-item">
                                    <a class="page-link  <?php echo ($i == $page) ? 'activenav' : ''; ?>"
                                        href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?php if ($page >= $total_pages)
                                echo 'disabled'; ?>">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>





    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>