<?php

/**
 * Script som skapar tabeller
 */

require_once('connection.php'); // Hämta $conn
//require_once('products.php'); // Array med produktinformation

$msg = "<p>";

/*
// Ta först bort databasen!
$conn->exec("DROP DATABASE IF EXISTS $dbName");
$msg .= "<code>database: $dbName deleted</code><br>";

// Skapa en ny databas
$conn->exec("CREATE DATABASE IF NOT EXISTS $dbName
             CHARACTER SET utf8
             COLLATE utf8_swedish_ci;");
$msg .= "<code>database: $dbName created</code><br>";
*/

// Välj databasen
$conn->exec("USE $dbName");
$msg .= "<code>database: $dbName selected</code><br>";

// Skapa tabellerna


// Skapa tabellen Products
$tblName = "Products";
$conn->exec(
    "CREATE TABLE $tblName(
            productid INT NOT NULL AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            description VARCHAR(255) NOT NULL,
            price INT(50) NOT NULL,
            image VARCHAR(50) NOT NULL,
            image_lg VARCHAR(50) NOT NULL,
            in_stock INT NOT NULL,
            PRIMARY KEY (productid)
        )"
);
$msg .= "<code>table $tblName created</code><br>";

// Skapa tabellen Customers
$tblName = "Customers";
$conn->exec(
    "CREATE TABLE $tblName(
            customerid INT NOT NULL AUTO_INCREMENT,
            firstname VARCHAR(50) NOT NULL,
            lastname VARCHAR(50) NOT NULL,
            str_address VARCHAR(50) NOT NULL,
            zip VARCHAR(10) NOT NULL,
            city VARCHAR(50) NOT NULL,
            tel VARCHAR(10) NOT NULL,
            email VARCHAR(100) NOT NULL,
            PRIMARY KEY (customerid)
        )"
);

$msg .= "<code>table $tblName created</code><br>";

// Skapa tabellen Orders
$tblName = "Orders";

$conn->exec(
    "CREATE TABLE $tblName(
            orderid INT NOT NULL AUTO_INCREMENT,
            productid INT NOT NULL,
            customerid INT NOT NULL,
            ordertime DATETIME NOT NULL,
            PRIMARY KEY (orderid)
        )"
);
$msg .= "<code>table $tblName created</code><br>";

// Sätt främmande nycklar
$tblName = "Orders";

$conn->exec(
    "ALTER TABLE $tblName
    ADD FOREIGN KEY (customerid) 
    REFERENCES customers(customerid) 
    ON DELETE RESTRICT 
    ON UPDATE RESTRICT; 

    ALTER TABLE $tblName 
    ADD FOREIGN KEY (productid) 
    REFERENCES products(productid) 
    ON DELETE RESTRICT 
    ON UPDATE RESTRICT;)"
);
$msg .= "<code>altered $tblName with foreign keys</code><br>";

// Skapa tabellen Orders
$tblName = "Messages";

$conn->exec(
    "CREATE TABLE $tblName(
            id INT NOT NULL AUTO_INCREMENT,
            mottagare VARCHAR(50),
            namn VARCHAR(50) NOT NULL,
            epost VARCHAR(50) NOT NULL,
            meddelande VARCHAR(50) NOT NULL,
            time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        )"
);
$msg .= "<code>table $tblName created</code><br>";

// Loggmeddelanden
echo $msg;
