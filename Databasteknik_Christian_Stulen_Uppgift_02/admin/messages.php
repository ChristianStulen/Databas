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
$tblName = "messages";

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
                <th width='5%'>#</th>
                <th width='15%'>Till</th>
                <th width='15%'>Från</th>
                <th width='15%'>E-post</th>
                <th>Meddelande</th>
                <th width='10%' class='text-right'>Radera</th>
            </tr>
HTML;

$items = 0;
foreach ($result as $key => $value) {

    $items++;
    $id = $value['id'];

    $table .= <<<HTML
            <tr>
                <td>$value[id]</td>
                <td>$value[mottagare]</td>
                <td>$value[namn]</td>
                <td>$value[epost]</td>
                <td>$value[meddelande]</td>
                <td class='text-right'>
                    <a href='delete.php?id=$value[id]&table=$tblName' class='btn btn-primary'>Radera</a>
                </td>
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

    echo <<<HTML
        <div class="row">
            <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
            <p><a href='delete.php?id=all&table=$tblName' class='btn btn-danger me-md-2'>Radera alla</a>
            </div>
        </div><!-- ./row -->
        HTML;
} else {
    echo <<<HTML
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info pb-1" role="alert">
                <p>Det finns inga meddelanden</p>
            </div>
        </div>
    </div><!-- ./row -->
    HTML;
}

echo <<<HTML

    </div><!-- ./ container -->
HTML;