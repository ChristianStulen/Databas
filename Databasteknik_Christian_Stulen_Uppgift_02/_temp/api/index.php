<?php

/**
 * Produkt-API version 3
 * Nytt i version 3: 
 * - Anpassning för databas
 * - Objektorientering
 * 
 * Begränsningar
 *  - APIet skapar maximalt 10 olika produkter!
 *  - Data levereras enbart i JSON-format (ej XML)
 * 
 * Annika Rengfelt
 * https://github.com/adrowsy
 * KVALIT20 - Databasteknik - Uppgift 2
 * 2021-02-11
 * 
 */


header("Content-Type: application/json; charset=UTF-8");

include_once("Product.php");
include_once("fetch_data.php");

$show_default = 10;
$show = isset($_GET["show"]) ? $_GET["show"] : $show_default;

// Validering av indata för 'show'
# https://www.w3schools.com/php/php_filter_advanced.asp

$min = 1;
$max = $show_default;

if (filter_var($show, FILTER_VALIDATE_INT, array("options" => array("min_range" => $min, "max_range" => $max))) === false) {

    $msgs = array();

    $msg = array("message" => "Show måste vara ett tal mellan 1 och 10", "status" => "failed");
    array_push($msgs, $msg);

    $error = json_encode($msgs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo $error;

} else {

    $products = array();

    for ($i = 0; $i < $show; $i++) {

        $product = new Product(
            $productid[$i],
            $name[$i],
            $description[$i],
            $image[$i],
            $price[$i],
            $in_stock[$i]
        );

        array_push($products, $product);
    }

    /* Konverterar PHP-arrayen till en JSON-string
    * JSON_UNESCAPED_SLASHES Don't escape /.
    * JSON_UNESCAPED_UNICODE Encode multibyte Unicode characters literally (default is to escape as \uXXXX).
    * JSON_PRETTY_PRINT Use whitespace in returned data to format it.
    * https://www.php.net/manual/en/json.constants.php
    */

    $json = json_encode($products, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    echo $json;
}
