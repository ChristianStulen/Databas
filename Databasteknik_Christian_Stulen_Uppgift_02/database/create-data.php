<?php

/**
 * Script som skapar tabeller
 * och fyller produktdata från $products
 */

require_once('products.php'); // Array med produktinformation
require_once('connection.php'); // Hämta $conn

$msg = "<p>";

// Välj databasen
$conn->exec("USE $dbName");
$msg .= "<code>database: $dbName selected</code><br>";
    
// Fyll tabell med data
    
$tblName = "Products";

foreach ($products as $key => $value) {
    $name = $value['name'];
    $description = $value['description'];
    $price = $value['price'];
    $image = $value['image'];
    $image_lg = $value['image_lg'];
    $in_stock = $value['in_stock'];
    
    $sql = "INSERT INTO $tblName (name, description, price, image, image_lg, in_stock)
        VALUE ('$name', '$description', '$price', '$image', '$image_lg', '$in_stock')";
    $conn->exec($sql);
    $msg .= "<code>-- product '$name' added to $tblName</code><br>";
}

// Loggmeddelanden
echo $msg;
