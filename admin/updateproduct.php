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
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    if (!$product) {
        header("location:products.php?error=Product Not Found!");
        exit();
    }
}

if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_category = $_POST['product_category'];


    $image = $product['product_image'];
    $image2 = $product['product_image2'];
    $image3 = $product['product_image3'];
    $image4 = $product['product_image4'];

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $file_extension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid("product_", true) . '.' . $file_extension;
        $file_path = $upload_dir . $unique_name;
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $file_path)) {
            $image = $unique_name;
        } else {
            $image = $product['product_image'];
        }
    }

    if (isset($_FILES['product_image2']) && $_FILES['product_image2']['error'] === UPLOAD_ERR_OK) {
        $file_extension = pathinfo($_FILES['product_image2']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid("product_", true) . '.' . $file_extension;
        $file_path = $upload_dir . $unique_name;
        if (move_uploaded_file($_FILES['product_image2']['tmp_name'], $file_path)) {
            $image2 = $unique_name;
        } else {
            $image2 = $product['product_image2'];
        }
    }

    if (isset($_FILES['product_image3']) && $_FILES['product_image3']['error'] === UPLOAD_ERR_OK) {
        $file_extension = pathinfo($_FILES['product_image3']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid("product_", true) . '.' . $file_extension;
        $file_path = $upload_dir . $unique_name;
        if (move_uploaded_file($_FILES['product_image3']['tmp_name'], $file_path)) {
            $image3 = $unique_name;
        } else {
            $image3 = $product['product_image3'];
        }
    }

    if (isset($_FILES['product_image4']) && $_FILES['product_image4']['error'] === UPLOAD_ERR_OK) {
        $file_extension = pathinfo($_FILES['product_image4']['name'], PATHINFO_EXTENSION);
        $unique_name = uniqid("product_", true) . '.' . $file_extension;
        $file_path = $upload_dir . $unique_name;
        if (move_uploaded_file($_FILES['product_image4']['tmp_name'], $file_path)) {
            $image4 = $unique_name;
        } else {
            $image4 = $product['product_image4'];
        }
    }


    $stmt = $conn->prepare(
        "UPDATE products SET 
             product_name = ?, 
             product_price = ?, 
             product_description = ?, 
             product_category = ?, 
             product_image = ?, 
             product_image2 = ?, 
             product_image3 = ?, 
             product_image4 = ? 
         WHERE product_id = ?"
    );

    $stmt->bind_param(
        "sdsssssssi",
        $product_name,
        $product_price,
        $product_description,
        $product_category,
        $image,
        $image2,
        $image3,
        $image4,
        $product_id
    );
    

    if ($stmt->execute()) {
        header("location:updateproduct.php?product_id=$product_id&message=Product Updated Successfully");
    } else {
        header("location:updateproduct.php?product_id=$product_id&error=Error Updating Product: " . $stmt->error);
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
                <form action="updateproduct.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="product-name">Product Name</label>
                            <input type="text" class="form-control" id="product-name" name="product_name"
                                placeholder="Product Name" value="<?php echo $product['product_name'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="from-group col-6">
                            <label for="product-price">Product Price</label>
                            <input type="number" class="form-control" id="product-price" name="product_price"
                                placeholder="Product Price" value="<?php echo $product['product_price'] ?>" required>
                        </div>
                        <div class="from-group col-6">
                            <label for="product-category">Product Category</label>
                            <select name="product_category" id="" class="form-select" required>
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
                            <textarea name="product_description" id="" cols="30" rows="5" class="form-control"
                                required><?php echo $product['product_description'] ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product_image" class="form-control" id="product-image">
                            <img src="../assets/imgs/<?php echo $product['product_image'] ?>" width="100" height="100"
                                alt="" srcset="">
                        </div>
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product_image2" class="form-control" id="product-image">
                            <img src="../assets/imgs/<?php echo $product['product_image2'] ?>" width="100" height="100"
                                alt="" srcset="">
                        </div>
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product_image3" class="form-control" id="product-image">
                            <img src="../assets/imgs/<?php echo $product['product_image3'] ?>" width="100" height="100"
                                alt="" srcset="">
                        </div>
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product_image4" class="form-control" id="product-image">
                            <img src="../assets/imgs/<?php echo $product['product_image4'] ?>" width="100" height="100"
                                alt="" srcset="">
                        </div>
                    </div>
                    <div class="form-group text-end pt-3">
                        <button type="submit" class="btn btn-success" name="update">Update</button>
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