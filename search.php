<?php
include('server/connection.php');

$products = [];
$message = "";

if (isset($_POST['search'])) {
    $searchvalue = '%' . $_POST['searchvalue'] . '%';
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ?");
    $stmt->bind_param('s', $searchvalue);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);

    if (empty($products)) {
        $message = "This product is currently out of stock, check out available products here.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php include("layout/header.php"); ?>
    
    <section class="search my-5 py-5">
        <div class="container">
            <h3 class="mt-5 text-center">Result of search</h3>
            <hr>
        </div>

        <?php if (!empty($message)): ?>
            <div class="text-center">
                <p><?php echo $message; ?></p>
                <a href="shop.php" class="button">Shop Now</a>
            </div>
        <?php elseif (!empty($products)): ?>
            <?php foreach ($products as $row): ?>
                <div class="liste">
                    <a href="<?php echo "single_product.php?product_id=" . $row['product_id'] ?>" class="productSearch">
                        <img src="assets/imgs/<?php echo $row['product_image'] ?>" class="img-fluid" alt="">
                        <div class="info">
                            <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
                            <p><?php echo substr($row['product_description'], 0, 150) . (strlen($row['product_description']) > 150 ? '...' : ''); ?></p>
                            <h4 class="p-price">$<?php echo $row['product_price'] ?></h4>
                            <div class="start">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </section>

    <?php include("layout/footer.php"); ?>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
