<?php
include('server/connection.php');

$products = null;
$limit = 1;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $limit;

$category = null;
if (isset($_GET['category'])) {
    $category = htmlspecialchars($_GET['category']);
}
if (isset($_POST['search_category'])) {
    $category = $_POST['category'];
}

if ($category) {
    $stmt = $conn->prepare('SELECT * FROM products WHERE product_category = ? LIMIT ? OFFSET ?');
    $stmt->bind_param("sii", $category, $limit, $offset);
} else {
    $stmt = $conn->prepare("SELECT * FROM products LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
}

if (!$stmt->execute()) {
    die("Erreur lors de l'exécution de la requête : " . $stmt->error);
}
$products = $stmt->get_result();

if ($category) {
    $stmt_total = $conn->prepare("SELECT COUNT(*) AS total FROM products WHERE product_category = ?");
    $stmt_total->bind_param("s", $category);
} else {
    $stmt_total = $conn->prepare("SELECT COUNT(*) AS total FROM products");
}

if (!$stmt_total->execute()) {
    die("Erreur lors de l'exécution de la requête totale : " . $stmt_total->error);
}

$result_total = $stmt_total->get_result();
$total_row = $result_total->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit);

if ($page > $total_pages)
    $page = $total_pages;

$stmt->close();
$stmt_total->close();
?>


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


    <section id="featured" class="my-5  pb-5">
        <div class="container  mt-5 py-3">
            <h3 class="mt-5">Our Featured</h3>
            <hr class="mx-0">
            <p>Here you can check out our products</p>
        </div>
        <div class="filter container">
            <div class="col-12 mb-5">
                <div class="item filter-colapse" onclick="showaside()">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M10.83 5a3.001 3.001 0 0 0-5.66 0H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17ZM4 11h9.17a3.001 3.001 0 0 1 5.66 0H20a1 1 0 1 1 0 2h-1.17a3.001 3.001 0 0 1-5.66 0H4a1 1 0 1 1 0-2Zm1.17 6H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17a3.001 3.001 0 0 0-5.66 0Z" />
                    </svg>
                    <span>Categories</span>
                </div>
            </div>
        </div>
        <div class="show-bar">
            <div class="container aside-bar">
                <i class="fa-solid fa-x" onclick="closebar()"></i>
                <div class="sidebar-nav">
                    <h5 class="mt-3">Search Products</h5>
                    <hr class="mx-0 mb-3">
                    <form action="shop.php" method="post">
                        <div class="container-fluid">
                            <h5 class="pt-4">Category</h5>
                            <div class="form-check py-1">
                                <input type="radio" class="form-check-input" name="category" value="Men" id="form-men"
                                    <?php echo ($category == "Men") ? "checked" : ""; ?> />
                                <label for="form-men" class="form-check-label">Men</label>
                            </div>
                            <div class="form-check py-1">
                                <input type="radio" class="form-check-input" name="category" value="Women"
                                    id="form-women" <?php echo ($category == "Women") ? "checked" : ""; ?> />
                                <label for="form-women" class="form-check-label">Women</label>
                            </div>
                            <div class="form-check py-1">
                                <input type="radio" class="form-check-input" name="category" value="Accessory"
                                    id="form-accessories" <?php echo ($category == "Accessory") ? "checked" : ""; ?> />
                                <label for="form-accessories" class="form-check-label">Accessories</label>
                            </div>
                        </div>
                        <div class="form-group my-2">
                            <input type="submit" value="Search" name="search_category" class="btn btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="mx-auto container">
            <div class="d-flex flex-wrap text-center row mx-auto">
                <?php while ($row = $products->fetch_assoc()) { ?>
                    <a href="<?php echo 'single_product.php?product_id=' . $row['product_id'] ?>"
                        class="product text-center text-dark col-lg-3 col-md-4 col-sm-12">
                        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'] ?>">
                        <div class="start">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <h5 class="p-name">
                            <?php echo substr($row['product_name'], 0, 20) . (strlen($row['product_name']) > 20 ? '...' : ''); ?>
                        </h5>
                        <h4 class="p-price">$<?php echo $row['product_price'] ?></h4>
                        <button class="shop-buy-btn">Buy Now</button>
                    </a>
                <?php } ?>
            </div>
            <div class="col-12 d-flex justify-content-center text-center mt-5">
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
                            <a class="page-link"
                                href="?page=<?php echo $page - 1; ?><?php echo $category ? '&category=' . urlencode($category) : ''; ?>">Previous</a>
                        </li>

                        <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                            <li class="page-item">
                                <a class="page-link <?php echo ($i == $page) ? 'activenav' : ''; ?>"
                                    href="?page=<?php echo $i; ?><?php echo $category ? '&category=' . urlencode($category) : ''; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?php if ($page >= $total_pages)
                            echo 'disabled'; ?>">
                            <a class="page-link"
                                href="?page=<?php echo $page + 1; ?><?php echo $category ? '&category=' . urlencode($category) : ''; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
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