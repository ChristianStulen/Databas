<?php

/****************************************
 * 
 *                READ
 * Läs tabellen från databasen
 * Presentera resultatet i en HTML-tabell
 * 
 ***************************************/

// Hämta $conn (en instans av PDO)
require_once('../database/connection.php');
$conn->exec("USE $dbName");
$tblName = "orders";

// Förbered en SQL-sats
$stmt = $conn->prepare("SELECT * FROM $tblName");

// Kör SQL-satsen
$stmt->execute();

// Returns an array containing all of the result set rows
$result = $stmt->fetchAll();

echo <<<HTML
<div class='container'>
    <div class='row'>
        <div class='col-12'>
            <h1 id='villkor' class='sectionHeading'>Visar tabellen $tblName</h1>
        </div>
    </div><!-- ./row -->
    
HTML;

$table = <<<HTML
    <div class="row">
        <div class="col-12">
            <table class='table table-hover'>
            <tr>
                <th >OrderID</th>
                <th >ProductID</th>
                <th >CustomerID</th>
            </tr>
HTML;

$items = 0;
foreach ($result as $key => $value) {

    $items++;
    $id = $value['orderid'];

    $table .= <<<HTML
            <tr>
                <td>$value[orderid]</td>
                <td>$value[productid]</td>
                <td>$value[customerid]</td>
            </tr>
HTML;
}

$table .= <<<HTML
        </table>
    </div>
</div><!-- ./row -->
HTML;

if ($items > 0) {

    echo $table;

   
} else {
    echo <<<HTML
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info pb-1" role="alert">
                <p>Det finns inga ordrar</p>
            </div>
        </div>
    </div><!-- ./row -->
    HTML;
}

echo <<<HTML

    </div><!-- ./ container -->
HTML;