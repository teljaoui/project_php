<?php

session_start();

include("server/connection.php");

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("location:login.php?message=Please Login Now!");
    exit();
}

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_category = $_POST['product_category'];

    $upload_dir = "../assets/imgs/"; 
    $product_images = []; 

    for ($i = 1; $i <= 4; $i++) {
        $product_image_key = 'product_image' . ($i == 1 ? '' : $i); 
        if (isset($_FILES[$product_image_key]) && $_FILES[$product_image_key]['error'] === UPLOAD_ERR_OK) {
            $file_extension = pathinfo($_FILES[$product_image_key]['name'], PATHINFO_EXTENSION);
            $unique_name = uniqid('product_', true) . '.' . $file_extension; 
            $file_path = $upload_dir . $unique_name; 

            if (move_uploaded_file($_FILES[$product_image_key]['tmp_name'], $file_path)) {
                $product_images[] = $unique_name; 
            } else {
                header("location:addproduct.php?error=Failed to upload $product_image_key.");
                exit();
            }
        } else {
            $product_images[] = null; 
        }
    }

    $stmt = $conn->prepare("INSERT INTO products 
    (product_name ,
     product_price,
      product_description ,
      product_category , 
       product_image ,
       product_image2, 
       product_image3, 
       product_image4) 
    value (?,?,?,?,?,?,?,?)");

    $stmt->bind_param(
        "sdssssss",
        $product_name,
        $product_price,
        $product_description,
        $product_category,
        $product_images[0],
        $product_images[1],
        $product_images[2],
        $product_images[3]
    );

    if ($stmt->execute()) {
        header("location:addproduct.php?message=Product added successfully");
    } else {
        header("location:addproduct.php?error=Error adding product: " . $stmt->error);
    }
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
            <h2 class="mt-5 text-center">Add New Product</h2>
            <hr>
            <div class="content-item my-5">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger mt-4 w-75 mx-auto mb-0">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php elseif (isset($_GET['message'])): ?>
                    <div class="alert alert-success mt-4 w-75 mx-auto mb-0">
                        <?php echo $_GET['message']; ?>
                    </div>
                <?php endif; ?>
                <form action="addproduct.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="product-name">Product Name</label>
                            <input type="text" class="form-control" id="product-name" name="product_name"
                                placeholder="Product Name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="from-group col-6">
                            <label for="product-price">Product Price</label>
                            <input type="number" class="form-control" id="product-price" name="product_price"
                                placeholder="Product Price" required>
                        </div>
                        <div class="from-group col-6">
                            <label for="product-category">Product Category</label>
                            <select name="product_category" id="" class="form-select" required>
                                <option value="" selected="" disabled="">Select Categorie</option>
                                <option value="Men">Men</option>
                                <option value="Women">Women</option>
                                <option value="Accessory">Accessory</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="from-group col-12">
                            <label for="product-description">Product Description</label>
                            <textarea name="product_description" id="" cols="30" rows="5" class="form-control"
                                required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product_image" class="form-control" id="product-image" required>
                        </div>
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product_image2" class="form-control" id="product-image" required>
                        </div>
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product_image3" class="form-control" id="product-image" required>
                        </div>
                        <div class="col-3">
                            <label for="product-image">Product Image</label>
                            <input type="file" name="product_image4" class="form-control" id="product-image" required>
                        </div>
                        <h6><span class="text-danger">Note:</span> Image must be scaled [1:1] , and type File PNG</h6>
                    </div>
                    <div class="form-group text-end pt-3">
                        <button type="submit" class="btn btn-success" name="add_product">Add</button>
                        <button type="reset" class="btn  btn-danger">reset</button>

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