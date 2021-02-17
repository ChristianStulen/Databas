<?php
//Gives us the a layout of all of the data in the database.
//It show ID, Name, Email, Message, and gives the option to either
//update or delete the data. There is also a delete all option. 
require_once("../database/connection.php");

$stmt = $conn->prepare("SELECT * FROM messages");
$stmt->execute();

$result = $stmt->fetchAll();
$table = " <table class='table'>";
$table .= "
   
<tr>
<th>ID</th>
<th>Mottagare</th>
<th>Namn</th>
<th>Epost</th>
<th>Meddelande</th>
<th>Skickat</th>
<th>Admin || <a href='/Databas\Databasteknik_Christian_Stulen_Uppgift_02\admin\delete.php?id=alla'>Ta bort allt</a></th>
</tr>";

foreach($result as $key => $value){


$table .= "
<tr>
<td>$value[id]</td>
<td>$value[mottagare]</td>
<td>$value[namn]</td>
<td>$value[epost]</td>
<td>$value[meddelande]</td>
<td>$value[time]</td>
<td>
            <a href='/Databas\Databasteknik_Christian_Stulen_Uppgift_02\admin\update.php?customerid=$value[id]'>Uppdatera</a> || 
            <a href='/Databas\Databasteknik_Christian_Stulen_Uppgift_02\admin\delete.php?customerid=$value[id]'>Ta bort</a>
        </td>
     </tr>";

}

$table .= "</table>";
echo $table;
?>
