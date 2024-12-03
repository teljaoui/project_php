<?php

/*

untreated
confirmed
shipped
delivered

*/
include('server/connection.php');


if (isset($_POST['order_details'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $stmt = $conn->prepare("SELECT * FROM order_item where order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows != 0) {
        $order_items = $result->fetch_all(MYSQLI_ASSOC);
        $total_order_price = calculateTotalOrder($order_items);

    } else {
        header("location:account.php?error=Order item not found");
    }

} else {
    header("location:account.php");
}

function calculateTotalOrder($order_items)
{
    $total = 0;
    foreach ($order_items as $row) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $total += $product_price * $product_quantity;
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


    <?php include('layout/header.php'); ?>

    <section class="container my-5 py-5 cart" id="orders">
        <div class="container">
            <h3 class="mt-5 text-center">Order details</h3>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($order_items as $item) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $item['product_image']; ?>" alt="" srcset="">
                            <p><?php echo substr($item['product_name'], 0, 20) . (strlen($item['product_name']) > 20 ? '...' : ''); ?>
                            </p>
                        </div>
                    </td>
                    <td>
                        $<?php echo $item['product_price']; ?>
                    </td>
                    <td>
                        <?php echo $item['product_quantity']; ?>
                    </td>
                    <td>
                        $<?php echo $item['product_price'] * $item['product_quantity']; ?>
                    </td>

                </tr>
            <?php } ?>
        </table>
        <?php if ($order_status == "not_paid"): ?>
            <div class="container">
                <form action="payment.php" method="post" class="float-end">
                    <input type="hidden" name="total_order_price" value="<?php echo $total_order_price; ?>">
                    <input type="hidden" name="order_status" value="<?php echo $order_status ;  ?>">
                    <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now">
                </form>
            </div>
        <?php endif; ?>

    </section>



    <?php include("layout/footer.php") ?>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>