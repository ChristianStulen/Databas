<?php
//The delete funktion. It uses a GET funktion to decide what should be deleted.
//if 'alla' is typed all rows will be deleted. A message will be send describing
//what was deleted.
require_once ("../header.php");
require_once ("../database/connection.php");

$customerid=$_GET['customerid'];
$message="";
try{
    if($customerid=="alla"){
        $sql= "DELETE FROM `customers`";
        $message="Alla meddelanden har tagits bort.";
    }else{
        $sql= "DELETE FROM `customers` WHERE `customers`.`customerid` = $customerid";
        $message="Meddelandet med ID nr $customerid har tagits bort.";
    }
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':customerid', $customerid);
    $stmt->execute();
    echo $message;    
}catch (PDOException $e) {
    echo $e->getMessage() ."<br> Det finns ordrar som finns knutna till kunden. Ta bort de först innan kund";
    exit(1);
}
?>
