<?php



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
        padding-block: 10px;
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
        margin-top: 10px !important;
    }

    .content .contentbody {
        padding-inline: 7%;
    }
    .userinfo  li {
        list-style: none;
        display: flex;
    }

    .userinfo  span {
        font-weight: 600;
        font-size: 17px;
        color: #232f3e;
        margin-right: 8px;
    }

    .userinfo  p {
        color: #777777;
        font-size: 17px;
    }

    @media only screen and (max-width:990px) {
        .content {
            width: 90%;
        }
    }
</style>

<body>



    <!--Navbar-->
    <?php include('layout/header.php'); ?>


    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Receipt</h2>
            <hr>
        </div>
        <div class="container mx-auto text-center">
            <?php if (isset($_GET['order_status'])) { ?>
                <div class="alert alert-success w-50 mx-auto">
                    <?php echo $_GET['order_status']; ?>
                </div>
            <?php } ?>
            <div class="content text-start">
                <hr class="hr">
                <div class="title text-center">
                    <h5>Order receipt</h5>
                    <hr>
                </div>
                <div class="header row">
                    <div class="col-6">
                        <img src="assets/imgs/logo.png" alt="">
                        <span>Clothing</span>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <h6>Date</h6>
                            <hr class="hrhead">
                            <p>2024-12-03</p>
                        </div>
                        <div class="text-center">
                            <h6>Receipt number</h6>
                            <hr class="hrhead">
                            <p>2458</p>
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
                                <p>Teljaoui Mohamed</p>
                            </li>
                            <li>
                                <span>Email: </span>
                                <p>teljaoui@gmail.com</p>
                            </li>
                            <li>
                                <span>Phone: </span>
                                <p>652583234</p>
                            </li>
                            <li>
                                <span>City: </span>
                                <p>Temara</p>
                            </li>
                            <li>
                                <span>Adress: </span>
                                <p>massira 1 , N 282</p>
                            </li>
                        </ul>
                    </div>
                    <h6>Products</h6>
                    <hr class="hrhead mx-0">
                    <div class="products">
                        
                    </div>
                </div>
                <div class="text-center">
                    <button class="download">
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


    <?php include("layout/footer.php") ?>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>