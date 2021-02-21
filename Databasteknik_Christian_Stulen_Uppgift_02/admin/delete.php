  
<?php

/***************************************
 * 
 *                DELETE
 *          Ta bort meddelanden
 * 
 ***************************************/

require_once("header.php");
require_once('../database/connection.php');
$conn->exec("USE $dbName");


if (isset($_GET['id']) && isset($_GET['table'])) {

    $id = $_GET['id'];
    $tblName = $_GET['table'];
    
    if ($_GET['id'] == 'all') {
        $sql = "DELETE FROM $tblName";
    } else {
        $sql = "DELETE FROM $tblName WHERE id = :id";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $rowCount = $stmt->rowCount();

    $rowCount > 1 ? $unit = "meddelanden" : $unit = "meddelande";

    echo <<<HTML

    <div class='container'>
        <div class='row'>
            <div class='col-12'>
                <h1 id='villkor' class='sectionHeading'>Ta bort från tabellen $tblName</h1>
            </div>
        </div>
HTML;

    $message = <<<HTML

        <div class="row"><!-- message -->
            <div class="col-12">
                <div class='alert alert-danger' role='alert'>
                    <p>$rowCount $unit har raderats!</p>
                </div>
            </div>
        </div><!-- ./row -->
HTML;

    if ($rowCount != 0)
    echo $message;
}

echo <<<HTML

    <div class="row">
        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
        <p><a href='index.php' class='btn btn-primary me-md-2'>Visa alla meddelanden</a>
        </div>
    </div><!-- ./ row -->
</div><!-- ./ container -->
HTML;

require_once ("../footer.php");