<?php

include('server/connection.php');
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product_result = $stmt->get_result();

    if ($product_result->num_rows > 0) {
        $product = $product_result->fetch_assoc();
        $category = $product['product_category'];

        $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? ORDER BY RAND() LIMIT 4");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $featured = $stmt->get_result();
    } else {
        echo "Product not defind";
        exit;
    }
} else {
    header('location:index.php');
    exit;
}
?>

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['product_name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>


    <!--Navbar-->
    <?php include('layout/header.php'); ?>


    <!--Single product-->
    <section class="single-product container my-5 pt-5">
        <div class="row  mt-5">
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img src="assets/imgs/<?php echo $product['product_image']; ?>" alt="" class="img-fluid w-100 pb-1"
                    id="mainImg">
                <div class="small-img-group mt-2">
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $product['product_image']; ?>" width="100%" class="small-img"
                            alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $product['product_image2']; ?>" width="100%" class="small-img"
                            alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $product['product_image3']; ?>" width="100%" class="small-img"
                            alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $product['product_image4']; ?>" width="100%" class="small-img"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 mx-4">
                <h6><?php echo $product['product_category'] ?></h6>
                <h4 class="py-4"><?php echo $product['product_name']; ?></h4>
                <h3>$<?php echo $product['product_price']; ?></h3>
                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
                    <input type="hidden" name="product_image" value="<?php echo $product['product_image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>">
                    <input type="number" name="product_quantity"
                        value="<?php echo isset($_SESSION['cart'][$product['product_id']]['product_quantity']) ? $_SESSION['cart'][$product['product_id']]['product_quantity'] : 1; ?>"
                        min="1">
                    <button type="submit" name="add_to_cart" class="buy-btn"><?php echo isset($_SESSION['cart'][$product['product_id']]) ? "Edit cart" : "Add To cart" ?></button>
                </form>
                <h5 class="mt-5 mb-5">Product details</h5>
                <span><?php echo $product['product_description']; ?></span>
            </div>
        </div>
    </section>

    <!--fautured-->
    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Related Products</h3>
            <hr>
        </div>
        <div class="row mx-auto container-fluid">
            <?php while ($row = $featured->fetch_assoc()) { ?>
                <a href="<?php echo 'single_product.php?product_id=' . $row['product_id'] ?>"
                    class="product text-center col-lg-3 col-md-4 col-sm-12  text-dark text-decoration-none">
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
    </section>




    <?php include("layout/footer.php") ?>


    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>