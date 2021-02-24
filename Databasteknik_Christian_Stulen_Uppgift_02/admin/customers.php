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
$tblName = "customers";

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
                <th >Customer ID</th>
                <th >First Name</th>
                <th >Last Name</th>
                <th >Street Address</th>
                <th >Zip</th>
                <th >City</th>
                <th >Tel</th>
                <th >Email</th>
            </tr>
HTML;

$items = 0;
foreach ($result as $key => $value) {

    $items++;
    $id = $value['customerid'];

    $table .= <<<HTML
            <tr>
                <td>$value[customerid]</td>
                <td>$value[firstname]</td>
                <td>$value[lastname]</td>
                <td>$value[str_address]</td>
                <td>$value[zip]</td>
                <td>$value[city]</td>
                <td>$value[tel]</td>
                <td>$value[email]</td>
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
                <p>Det finns inga kunder</p>
            </div>
        </div>
    </div><!-- ./row -->
    HTML;
}

echo <<<HTML

    </div><!-- ./ container -->
HTML;