<?php
include("server/connection.php");

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("location:login.php?message=Please Login Now!");
    exit();
}

$users = [];
$limit = 4;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $limit;

if (isset($_POST['searchuser'])) {

    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

    if ($user_id) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $users = $stmt->get_result();
        if ($users->num_rows === 0) {
            header("location:users.php?error= User Not Found");
            exit();
        }
    } else {
        header("location:users.php?error=Invalid User ID");
    }
    $total_pages = 1;
} else {
    $stmt = $conn->prepare("SELECT * FROM users LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $users = $stmt->get_result();
    $stmt_total = $conn->prepare("SELECT COUNT(*) AS total FROM users");
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
    <title>Users</title>
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
            <h2 class="mt-5 text-center">Users</h2>
            <hr>
            <div class="mx-5 d-flex justify-content-end">
                <form action="users.php" method="post" class="d-flex">
                    <input type="number" class="form-control" id="product-name" name="user_id" placeholder="User ID"
                        required>
                    <input type="submit" value="Search" class="button" name="searchuser">
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
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>List Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) { ?>

                                <tr>
                                    <td><?php echo $user['user_id'] ?></td>
                                    <td><?php echo $user['user_name'] ?></td>
                                    <td><?php echo $user['user_email'] ?></td>
                                    <td>
                                        <a href="index.php?user_id=<?php echo $user['user_id'] ?>"
                                            class="btn btn-primary">List Orders</a>
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