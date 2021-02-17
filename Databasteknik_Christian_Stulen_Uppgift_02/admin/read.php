<?php
//Gives us the a layout of all of the data in the database.
//It show ID, Name, Email, Message, and gives the option to either
//update or delete the data. There is also a delete all option. 
require_once("../database/connection.php");

$stmt = $conn->prepare("SELECT * FROM customers");
$stmt->execute();

$result = $stmt->fetchAll();
$table = " <table class='table'>";
$table .= "
   
    <tr>
        <th>Customer ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Street</th>
        <th>Zip</th>
        <th>City</th>
        <th>Tel</th>
        <th>Email</th>

        <th>Admin || <a href='/Databas\Databasteknik_Christian_Stulen_Uppgift_02\admin\delete.php?customerid=alla'>Ta bort allt</a></th>
    </tr>";

foreach($result as $key => $value){

    
$table .= "
    <tr>
        <td>$value[customerid]</td>
        <td>$value[firstname]</td>
        <td>$value[lastname]</td>
        <td>$value[str_address]</td>
        <td>$value[zip]</td>
        <td>$value[city]</td>
        <td>$value[tel]</td>
        <td>$value[email]</td>
        <td>
            <a href='/Databas\Databasteknik_Christian_Stulen_Uppgift_02\admin\update.php?customerid=$value[customerid]'>Uppdatera</a> || 
            <a href='/Databas\Databasteknik_Christian_Stulen_Uppgift_02\admin\delete.php?customerid=$value[customerid]'>Ta bort</a>
        </td>
     </tr>";

}

$table .= "</table>";
echo $table;
?>
