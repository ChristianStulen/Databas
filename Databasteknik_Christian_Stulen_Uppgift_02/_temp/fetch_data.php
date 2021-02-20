<?php

require_once("../database/database.php");
$conn->exec("USE $dbName");

/**
 * Get data from a table
 * Returns Assoc. Array
 */

function getArrayFromTable($table)
{

    global $conn; // Hämtas från db.php
    $stmt = $conn->prepare("SELECT * FROM $table ");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

try {
    $productid = getArrayFromTable("productid");
    $name = getArrayFromTable("name");
    $description = getArrayFromTable("description");
    $price = getArrayFromTable("price");
    $image = getArrayFromTable("image");
    $in_stock = getArrayFromTable("in_stock");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}