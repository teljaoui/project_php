<?php

include('server/connection.php');

$stmt = $conn->prepare("SELECT * FROM products ");

$stmt->execute();

$products = $stmt->get_result();



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
<style>
    .product {
        cursor: pointer;
        margin-bottom: 2rem;
        text-decoration: none !important;
    }
</style>

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
                            <div class="form-check py-1">
                                <input type="radio" class="form-check-input" name="category" id="form-men">
                                <label for="" class="form-check-label">Men</label>
                            </div>
                            <div class="form-check py-1">
                                <input type="radio" class="form-check-input" name="category" id="form-women">
                                <label for="" class="form-check-label">Women</label>
                            </div>
                            <div class="form-check py-1">
                                <input type="radio" class="form-check-input" name="category" id="form-accessories">
                                <label for="" class="form-check-label">Accessories</label>
                            </div>
                        </div>
                        <div class="form-group my-3 mx-3">
                            <input type="submit" value="Search" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="mx-auto container">
            <div class="d-flex flex-wrap text-center row ">
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
                        <button class="buy-btn">Buy Now</button>
                    </a>
                <?php } ?>
            </div>
            <div class="col-12 d-flex justify-content-center text-center">
                <nav aria-label="Page navigation example" class="paginate">
                    <ul class="pagination mt-5">
                        <li class="page-item    "><a href="#" class="page-link">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
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