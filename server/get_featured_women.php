<?php

include("connection.php");

$stmt = $conn->prepare("SELECT * FROM products where product_category = 'Women'  ORDER BY RAND() limit 4");
$stmt->execute();

$featured_Women = $stmt->get_result();



?>