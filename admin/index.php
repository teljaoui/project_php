<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
            <h2 class="mt-5 text-center">Orders</h2>
            <hr>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger text-center w-50 mx-auto">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php elseif (isset($_GET['message'])): ?>
                <div class="alert alert-success text-center w-50 mx-auto">
                    <?php echo $_GET['message']; ?>
                </div>
            <?php endif; ?>
            <div class="content-item my-5">
                <div class="table-responsive dataview">
                    <table class="table datatable ">
                        <thead>
                            <tr>
                                <th>order Id</th>
                                <th>Order Status</th>
                                <th>User ID</th>
                                <th>Order Date</th>
                                <th>User Phone</th>
                                <th>User City</th>
                                <th>Details</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>not_paid</td>
                                <td>1</td>
                                <td>2024-11-12 17:29:59</td>
                                <td>652583234</td>
                                <td>Temara</td>
                                <td>
                                    <a href="" class="btn btn-primary">DETAILS</a>
                                </td>
                                <td>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>not_paid</td>
                                <td>1</td>
                                <td>2024-11-12 17:29:59</td>
                                <td>652583234</td>
                                <td>Temara</td>
                                <td>
                                    <a href="" class="btn btn-primary">DETAILS</a>
                                </td>
                                <td>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>not_paid</td>
                                <td>1</td>
                                <td>2024-11-12 17:29:59</td>
                                <td>652583234</td>
                                <td>Temara</td>
                                <td>
                                    <a href="" class="btn btn-primary">DETAILS</a>
                                </td>
                                <td>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>not_paid</td>
                                <td>1</td>
                                <td>2024-11-12 17:29:59</td>
                                <td>652583234</td>
                                <td>Temara</td>
                                <td>
                                    <a href="" class="btn btn-primary">DETAILS</a>
                                </td>
                                <td>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>not_paid</td>
                                <td>1</td>
                                <td>2024-11-12 17:29:59</td>
                                <td>652583234</td>
                                <td>Temara</td>
                                <td>
                                    <a href="" class="btn btn-primary">DETAILS</a>
                                </td>
                                <td>
                                    <button class="btn btn-danger">Delete</button>
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