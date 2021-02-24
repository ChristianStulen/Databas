<?php

/**
 * Script som återställer databas från nolläge
 */

require_once('connection.php'); // Hämta $conn
//require_once('products.php'); // Array med produktinformation

$msg = "<p>";

// Ta först bort databasen!
$conn->exec("DROP DATABASE IF EXISTS $dbName");
$msg .= "<code>database: $dbName deleted</code><br>";

// Skapa en ny databas
$conn->exec("CREATE DATABASE IF NOT EXISTS $dbName
             CHARACTER SET utf8
             COLLATE utf8_swedish_ci;");
$msg .= "<code>database: $dbName created</code><br>";
// Loggmeddelanden
echo $msg;
