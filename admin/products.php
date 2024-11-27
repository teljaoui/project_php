<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
            <h2 class="mt-5 text-center">Products</h2>
            <hr>
            <div class="mx-5 d-flex justify-content-end">
                <form action="" method="post" class="d-flex">
                    <input type="text" class="form-control" id="product-name" name="name"
                        placeholder="Product ID" required>
                        <input type="submit" value="Search" class="button">
                </form>
            </div>
            <div class="content-item my-3">
                <div class="table-responsive dataview">
                    <table class="table datatable ">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Category</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="../assets/imgs/featured.jpg" width="60" height="60" alt="">
                                </td>
                                <td>Sports Shoes</td>
                                <td>$ 150.00</td>
                                <td>Men</td>
                                <td>
                                    <a href="" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <button class="btn btn-danger text-lowercase">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="../assets/imgs/featured.jpg" width="60" height="60" alt="">
                                </td>
                                <td>Sports Shoes</td>
                                <td>$ 150.00</td>
                                <td>Men</td>
                                <td>
                                    <a href="" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <button class="btn btn-danger text-lowercase">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="../assets/imgs/featured.jpg" width="60" height="60" alt="">
                                </td>
                                <td>Sports Shoes</td>
                                <td>$ 150.00</td>
                                <td>Men</td>
                                <td>
                                    <a href="" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <button class="btn btn-danger text-lowercase">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="../assets/imgs/featured.jpg" width="60" height="60" alt="">
                                </td>
                                <td>Sports Shoes</td>
                                <td>$ 150.00</td>
                                <td>Men</td>
                                <td>
                                    <a href="" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <button class="btn btn-danger text-lowercase">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 d-flex justify-content-center text-center pt-4">
                    <nav aria-label="Page navigation example" class="paginate">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="">Previous</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>





    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>