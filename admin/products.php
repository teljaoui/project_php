<?php

include("server/connection.php");

session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {

} else {
    header("location:login.php?message=Please Login Now!");
}


$products = [];
$limit = 4;

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $limit;

if (isset($_POST['deleteproduct'])) {
    $product_id = $_POST['product_id'];
    if ($product_id) {
        $stmt = $conn->prepare("DELETE FROM products where product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        header("Location: products.php?message=Product Delete successfully");
    } else {
        header("location : products.php?error=Product Not Found");
    }

}
if (isset($_POST['searchid'])) {
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

    if ($product_id) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $products = $stmt->get_result();

        if ($products->num_rows === 0) {
            header("location: products.php?error=Product not found");
            exit();
        }
    } else {
        header("location: products.php?error=Invalid Product ID");
        exit();
    }

    $total_pages = 1;

} else {
    $stmt = $conn->prepare("SELECT * FROM products LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $products = $stmt->get_result();

    $stmt_total = $conn->prepare("SELECT COUNT(*) AS total FROM products");
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
    <title>Products</title>
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
            <h2 class="mt-5 text-center">Products</h2>
            <hr>
            <div class="mx-5 d-flex justify-content-end">
                <form action="products.php" method="post" class="d-flex">
                    <input type="number" class="form-control" id="product-name" name="product_id"
                        placeholder="Product ID" required>
                    <input type="submit" value="Search" class="button" name="searchid">
                </form>
            </div>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger mt-4 w-75 mx-auto mb-0">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php elseif (isset($_GET['message'])): ?>
                <div class="alert alert-success mt-4 w-75 mx-auto mb-0">
                    <?php echo $_GET['message']; ?>
                </div>
            <?php endif; ?>
            <div class="content-item my-3">
                <div class="table-responsive dataview">
                    <table class="table datatable ">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Category</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td><?php echo $product['product_id']; ?></td>
                                    <td>
                                        <img src="../assets/imgs/<?php echo $product['product_image']; ?>" width="60"
                                            height="60" alt="">
                                    </td>
                                    <td><?php echo substr($product['product_name'], 0, 20) . (strlen($product['product_name']) > 20 ? '...' : ''); ?>
                                    </td>
                                    <td>$ <?php echo $product['product_price']; ?></td>
                                    <td><?php echo $product['product_category']; ?></td>
                                    <td>
                                        <a href="updateproduct?product_id=<?php echo $product['product_id']?>" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="products.php" method="post">
                                            <input type="hidden" name="product_id"
                                                value="<?php echo $product['product_id']; ?>">
                                            <button type="submit" name="deleteproduct"
                                                class="btn btn-danger text-lowercase delete">Delete</button>
                                        </form>
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





    <script>
        document.querySelectorAll(".delete").forEach(function (button) {
            button.addEventListener("click", function (event) {
                if (!confirm("Are you sure you want to delete?")) {
                    event.preventDefault();
                }
            });
        });

    </script>
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>