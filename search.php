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


    <?php include("layout/header.php") ; ?>
    <section class="search my-5 py-5">
        <div class="container">
            <h3 class="mt-5 text-center">Result of search</h3>
            <hr>
        </div>
        <div class="liste">
            <div class="productSearch">
                <img src="assets/imgs/featured.jpg" class="img-fluid" alt="" srcset="">
                <div class="info">
                    <h5 class="p-name">Sports Shoes</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt nam optio tempore expedita, pariatur laborum!</p>
                    <h4 class="p-price">$199.8</h4>
                    <div class="start">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("layout/footer.php") ; ?>



    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>