<?php

include("connection.php");

$stmt = $conn->prepare("SELECT * FROM products where product_category = 'Accessory'  ORDER BY RAND() limit 4");

$stmt->execute();
$result = $stmt->get_result();

$featured_accessory = $result;




?>