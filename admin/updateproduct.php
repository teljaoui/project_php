<?php

include("server/connection.php");

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("location:login.php?message=Please Login Now!");
    exit();
}

$product = [];
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * From products where product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    if (!$product) {
        header("location:products.php?error=Product Not Found!");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
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
            <h2 class="mt-5 text-center">Update Product</h2>
            <hr>
            <div class="content-item my-5">
                <form action="" method="post">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="product-name">Product Name</label>
                            <input type="text" class="form-control" id="product-name" name="name"
                                placeholder="Product Name" value="<?php echo $product['product_name'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="from-group col-6">
                            <label for="product-price">Product Price</label>
                            <input type="number" class="form-control" id="product-price" name="name"
                                placeholder="Product Price" value="<?php echo $product['product_price'] ?>" required>
                        </div>
                        <div class="from-group col-6">
                            <label for="product-category">Product Category</label>
                            <select name="product-category" id="" class="form-select" required="">
                                <option value="" disabled>Select Categorie</option>
                                <option value="Men" <?php echo ($product['product_category'] == 'Men') ? 'selected' : ''; ?>>Men</option>
                                <option value="Women" <?php echo ($product['product_category'] == 'Women') ? 'selected' : ''; ?>>Women</option>
                                <option value="Accessory" <?php echo ($product['product_category'] == 'Accessory') ? 'selected' : ''; ?>>Accessory</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="from-group col-12">
                            <label for="product-description">Product Description</label>
                            <textarea name="description" id="" cols="30" rows="5" class="form-control"
                                required=""><?php echo $product['product_description'] ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product-image" class="form-control" id="product-image">
                            <img src="../assets/imgs/<?php echo $product['product_image'] ?>" width="100" height="100"
                                alt="" srcset="">
                        </div>
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product-image" class="form-control" id="product-image">
                            <img src="../assets/imgs/<?php echo $product['product_image2'] ?>" width="100" height="100"
                                alt="" srcset="">
                        </div>
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product-image" class="form-control" id="product-image">
                            <img src="../assets/imgs/<?php echo $product['product_image3'] ?>" width="100" height="100"
                                alt="" srcset="">
                        </div>
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product-image" class="form-control" id="product-image">
                            <img src="../assets/imgs/<?php echo $product['product_image4'] ?>" width="100" height="100"
                                alt="" srcset="">
                        </div>
                    </div>
                    <div class="form-group text-end pt-3">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>





    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>