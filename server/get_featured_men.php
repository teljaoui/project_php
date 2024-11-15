<?php

include("connection.php");

$stmt = $conn->prepare("SELECT * FROM products where product_category = 'Men'  ORDER BY RAND() limit 4");
$stmt->execute();

$featured_men = $stmt->get_result();



?>