<?php
session_start();

$message = '';

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['cart'])) {
        $product_array_ids = array_column($_SESSION['cart'], "product_id");
        if (!in_array($_POST['product_id'], $product_array_ids)) {
            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_image' => $_POST['product_image'],
                'product_price' => $_POST['product_price'],
                'product_quantity' => $_POST['product_quantity']
            );
            $_SESSION['cart'][$_POST['product_id']] = $product_array;
            $message = "Product added to carte successfully";
        } else if (in_array($_POST['product_id'], $product_array_ids)) {
            $_SESSION['cart'][$_POST['product_id']]['product_quantity'] = $_POST['product_quantity'];
            $message = "Product Quantity Update successfully";
        } else {
            $message = "";
        }
    } else {
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_image' => $_POST['product_image'],
            'product_price' => $_POST['product_price'],
            'product_quantity' => $_POST['product_quantity']
        );
        $_SESSION['cart'][$_POST['product_id']] = $product_array;
    }

} else if (isset($_POST['edit_quantity'])) {
    $_SESSION['cart'][$_POST['product_id']] = [
        'product_id' => $_SESSION['cart'][$_POST['product_id']]['product_id'],
        'product_name' => $_SESSION['cart'][$_POST['product_id']]['product_name'],
        'product_image' => $_SESSION['cart'][$_POST['product_id']]['product_image'],
        'product_price' => $_SESSION['cart'][$_POST['product_id']]['product_price'],
        'product_quantity' => $_POST['product_quantity']
    ];
    $message = "Product Quantity Update successfully";
} else if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    $message = "Product removed from the cart successfully.";
    if (empty($_SESSION['cart'])) {
        echo '<script>alert("Cart is empty"); window.location.href="shop.php";</script>';
        exit();
    }
} else {
    if (empty($_SESSION['cart'])) {
        echo '<script>alert("Cart is empty"); window.location.href="shop.php";</script>';
        exit();
    }
}


function calculateTotal()
{
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['product_price'] * $item['product_quantity'];
        }
        $_SESSION['total'] = $total;
    }
    return $total;
}


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


    <!--Cart-->

    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr class="mx-0">
        </div>


        <?php if ($message != ''): ?>
            <div class="alert alert-success">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <a href="<?php echo "single_product.php?product_id=" . $value['product_id'] ?>">
                                <img src="assets/imgs/<?php echo $value['product_image']; ?>" alt="" srcset="">
                            </a>
                            <div>
                                <p><?php echo substr($value['product_name'], 0, 10) . (strlen($value['product_name']) > 10 ? '...' : ''); ?></p>
                                <small><span>$</span><?php echo $value['product_price']; ?></small>
                                <br>
                                <form action="" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                    <input type="submit" name="remove_product" class="remove-btn" value="Remove" />
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'] ?>"
                                min="1">
                            <input type="submit" value="Edit" class="edit-btn" name="edit_quantity">
                        </form>
                    </td>
                    <td>
                        <span>$</span>
                        <span
                            class="product-price"><?php echo $value['product_price'] * $value['product_quantity']; ?></span>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <div class="cart-total">
            <table>

                <tr>
                    <td>Total</td>
                    <td>$<?php echo calculateTotal() ?></td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <form action="checkout.php" method="post">
                <button type="submit" class="btn checkout-btn" name="Checkout">Checkout</button>
            </form>
        </div>

    </section>




    <?php include("layout/footer.php") ?>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>