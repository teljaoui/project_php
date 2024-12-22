<?php
include("server/connection.php");

$order_info = [];
$order_item = [];
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM order_item Where order_id = ? ");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order_item = $stmt->get_result();

    $stmt1 = $conn->prepare("SELECT * FROM users u inner join orders o on u.user_id = o.user_id where o.order_id =?;");
    $stmt1->bind_param("i", $order_id);
    $stmt1->execute();
    $order_info = $stmt1->get_result()->fetch_assoc();

    if (empty($order_id) || !$order_info || $order_item->num_rows == 0) {
        header("Location: index.php?error=Order Not Found!");
        exit();
    }

}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/pdf-lib/dist/pdf-lib.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</head>
<style>
    .download {
        border-radius: 50px;
        padding: 5px 12px;
        font-size: 15px;
        background-color: blue;
        text-transform: inherit !important;
        font-weight: 510;
        transition: 0.5s ease-in-out;
        margin-block: 20px;
    }

    .download svg {
        border-radius: 50%;
        background-color: #fff;
        color: blue;
        align-items: center;
        font-size: 15px;
        padding: 2px;
        transition: 0.5s ease-in-out;
    }

    .download span {
        font-size: 17px;
    }

    .download:hover {
        background-color: #fff;
        border: 0.5px solid blue;
        transform: scale(1.1);
        color: blue;
    }

    .download:hover svg {
        color: #fff;
        background-color: blue;
    }

    .content {
        width: 60%;
        margin-inline: auto;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.102);
    }

    .hr {
        width: 100%;
        padding-block: 8px;
        border-radius: 0px;
    }

    .content .header {
        padding-inline: 5%;
    }

    .content .header img {
        width: 100px;
        height: 100px;
    }

    .content .header span {
        color: coral;
        font-size: 25px;
        text-align: center;
    }

    .content h6 {
        font-size: 17px;
        color: #000066;
        font-weight: 700;
    }

    .content p {
        font-size: 14px;
    }

    .content .hrhead {
        width: 60%;
        height: 1.5px !important;
        background-color: #7F7F7F !important;
        margin-block: 10px !important;
    }

    .content .contentbody {
        padding-inline: 7%;
    }

    .userinfo li {
        list-style: none;
        display: flex;
    }

    .userinfo span {
        font-weight: 600;
        font-size: 17px;
        color: #232f3e;
        margin-right: 8px;
    }

    .userinfo p {
        color: #777777;
        font-size: 17px;
    }

    .total {
        display: flex;
        justify-content: flex-end;
    }

    .total table {
        width: 100%;
        max-width: 200px;
        border-top: 3px solid #7F7F7F;
    }

    .total table td {
        padding: 2px 5px;
    }

    #print {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background: #fff;
        overflow: hidden;
        box-shadow: none;
    }


    @media only screen and (max-width:990px) {
        .content {
            width: 90%;
        }

        .total table {
            width: 100%;
            margin-inline: auto;
        }
    }
</style>

<body>



    <!--Navbar-->
    <section class="pb-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Receipt</h2>
            <hr>
        </div>
        <div class="container mx-auto text-center">
            <div class="content text-start">
                <div class="print" id="print">
                    <hr class="hr">
                    <div class="title text-center">
                        <h5>Order receipt</h5>
                        <hr>
                    </div>
                    <div class="header row">
                        <div class="col-6">
                            <img src="../assets/imgs/logo.png" alt="">
                            <span>Clothing</span>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h6>Date</h6>
                                <hr class="hrhead">
                                <p><?php echo date('Y-m-d', strtotime($order_info['order_date'])); ?></p>
                            </div>
                            <div class="text-center">
                                <h6>Receipt number</h6>
                                <hr class="hrhead">
                                <p id="order_id"><?php echo $order_info['order_id'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="contentbody">
                        <h6>User Information</h6>
                        <hr class="hrhead mx-0">
                        <div class="userinfo">
                            <ul>
                                <li>
                                    <span>Name: </span>
                                    <p><?php echo $order_info['user_name']; ?></p>
                                </li>
                                <li>
                                    <span>Email: </span>
                                    <p><?php echo $order_info['user_email']; ?></p>
                                </li>
                                <li>
                                    <span>Phone: </span>
                                    <p><?php echo $order_info['user_phone']; ?></p>
                                </li>
                                <li>
                                    <span>City: </span>
                                    <p><?php echo $order_info['user_city']; ?></p>
                                </li>
                                <li>
                                    <span>Adress: </span>
                                    <p><?php echo $order_info['user_adress']; ?></p>
                                </li>
                            </ul>
                        </div>
                        <h6>Products</h6>
                        <hr class="hrhead mx-0">
                        <div class="products">
                            <section class="cart">
                                <table class="mt-5 pt-5">
                                    <tr>
                                        <th>Product</th>
                                        <th>Prix</th>
                                        <th>Quantity</th>
                                    </tr>
                                    <?php foreach ($order_item as $item) { ?>
                                        <tr>
                                            <td><?php echo substr($item['product_name'], 0, 20) . (strlen($item['product_name']) > 20 ? '...' : ''); ?>
                                            </td>
                                            <td>$<?php echo $item['product_price'] ?></td>
                                            <td><?php echo $item['product_quantity'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </section>
                        </div>
                        <div class="total">
                            <table>
                                <tr>
                                    <td>
                                        <h6>Total paid</h6>
                                    </td>
                                    <td>$ <?php echo $order_info['order_cost'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="download" onclick="generatePDF()">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19V5m0 14-4-4m4 4 4-4" />
                        </svg>
                        <span>Download Now</span>
                    </button>
                </div>

            </div>


        </div>

    </section>


    <script>
        async function generatePDF() {
            const element = document.getElementById("print");
            const order_id = document.getElementById("order_id") ? document.getElementById("order_id").textContent : null;

            if (!order_id) {
                alert("Order ID is missing!");
                return;
            }

            try {
                const canvas = await html2canvas(element, {
                    scale: 2,
                    useCORS: true
                });

                const imgData = canvas.toDataURL("image/png");

                const { PDFDocument } = PDFLib;
                const pdfDoc = await PDFDocument.create();

                const page = pdfDoc.addPage([canvas.width, canvas.height]);
                const image = await pdfDoc.embedPng(imgData);

                page.drawImage(image, {
                    x: 0,
                    y: 0,
                    width: canvas.width,
                    height: canvas.height,
                });

                const pdfBytes = await pdfDoc.save();
                const blob = new Blob([pdfBytes], { type: "application/pdf" });

                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = "Order_receipt_Clothing_" + order_id + ".pdf";
                link.click();
            } catch (error) {
                console.error("PDF generation failed:", error);
                alert("An error occurred while generating the PDF.");
            }
        }
    </script>


    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>