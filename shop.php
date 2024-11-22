<?php
include('server/connection.php');

$products = null;
$limit = 4;
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
            <div class="col-12 mb-5 d-flex justify-content-between">
                <div class="item filter-colapse" onclick="showaside()">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M10.83 5a3.001 3.001 0 0 0-5.66 0H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17ZM4 11h9.17a3.001 3.001 0 0 1 5.66 0H20a1 1 0 1 1 0 2h-1.17a3.001 3.001 0 0 1-5.66 0H4a1 1 0 1 1 0-2Zm1.17 6H4a1 1 0 1 0 0 2h1.17a3.001 3.001 0 0 0 5.66 0H20a1 1 0 1 0 0-2h-9.17a3.001 3.001 0 0 0-5.66 0Z" />
                    </svg>
                    <span>Categories</span>
                </div>
                <div class="item filter-colapse">
                    <form action="shop.php" method="post">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M3.69869 6.31701C2.56717 5.02384 3.48553 3 5.20384 3H18.7547c1.7316 0 2.6449 2.05088 1.4866 3.33793L17.47 9.34198s-.4632-.20588-.6184-.24042c-.1551-.03453-.488-.10604-.9206-.10604-.9034 0-2.138.66073-2.5716 1.73108-1.3256.8485-1.6921 1.8133-1.7929 2.0078-.1009.1944-.2618.5312-.3399 1.2148-.0781.6836 0 1.6055.5235 2.4688-.0721.0626-.2383.289-.3321.4375-.0937.1484-.5898.875-.3515 2.1445-.1993 0-.6387-.158-.92-.4393l-.70708-.7071c-.28131-.2814-.43934-.6629-.43934-1.0607v-4.4172L3.69869 6.31701Z" />
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M16.0604 11c.5523 0 1 .4477 1 1v.1013c.6366.1591 1.2184.4937 1.668.9715.3784.4022.3592 1.0351-.0431 1.4135-.4022.3785-1.0351.3592-1.4135-.043-.1902-.2021-.4506-.3504-.7488-.4139-.0363-.0077-.0722-.0174-.1074-.0292-.0543-.018-.1098-.0317-.1658-.041-.0614.0117-.1247.0179-.1894.0179-.063 0-.1245-.0058-.1843-.017-.0784.0136-.1554.0355-.2292.0658-.1976.0812-.3513.2132-.4504.3673.0006.002.0013.0042.002.0064.0138.0431.0516.1195.1396.2154.1806.1971.4983.3934.8907.4835.746.1712 1.4369.5572 1.9192 1.0838.476.5197.8461 1.3054.5891 2.1704-.0136.0459-.0305.0907-.0506.1342-.3123.6768-.8768 1.2008-1.5636 1.483-.0208.0085-.0416.0168-.0625.0248V20c0 .5523-.4477 1-1 1-.5271 0-.9589-.4077-.9973-.9249-.0154-.0046-.0308-.0093-.0462-.0141-.6707-.1541-1.2837-.502-1.7506-1.0062-.3752-.4053-.3509-1.038.0544-1.4132.4052-.3752 1.0379-.3508 1.4131.0544.1903.2055.4527.3566.754.4209.0359.0077.0713.0173.1061.0289.0754.025.1531.0416.2315.0499.0753-.0181.154-.0277.235-.0277.0421 0 .0836.0026.1244.0076.0608-.0134.1204-.032.1781-.0557.1979-.0813.3518-.2135.451-.368l-.001-.0032c-.0136-.0424-.0513-.1189-.1398-.2156-.1817-.1984-.5007-.3955-.8919-.4854-.7448-.171-1.4351-.5549-1.9176-1.0814-.4776-.5211-.8432-1.304-.5924-2.167.0138-.0477.0312-.0943.052-.1394.312-.6773.8766-1.2017 1.5637-1.4839.0573-.0236.1151-.0453.1735-.0653V12c0-.5523.4477-1 1-1Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Price high to low</span>
                    </form>
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