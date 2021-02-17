
<?php
require_once("header.php");
//Hämtar databasen samt id på produkten med hjälp av GET 
require_once("database/connection.php");
$conn->exec("USE $dbName");
//echo "<code>database: $dbName selected</code><br>";

$productid = $_GET['productid'];
$stmt = $conn->prepare("SELECT * FROM products WHERE productid = :productid");
$stmt->bindParam(':productid' , $productid);
$stmt->execute();
$result = $stmt->fetch();
$name = $result['name']; 

?>
<!--Skriver ut ett formulär där kunden skriver in sina uppgifter-->
<h2>  Ni har valt <?php echo $name ?>. Vänligen fyll i er leverans adress. </h2>
<form action="#" class="" method="post" >

<div class="col-md-3 ">
    <input type="text" class="form-control " name="firstname" placeholder="Förnamn" required>
</div>
<div class="col-md-3 ">
    <input type="text" class="form-control " name="lastname" placeholder="Efternamn" required>
</div>
<div class="col-md-3 ">
    <input type="text" class="form-control" name="street" placeholder="Gata" required>
</div>
<div class="col-md-2 ">
    <input type="text" class="form-control" name="zip" placeholder="Postkod" required>
</div>
<div class="col-md-3 ">
    <input type="text" class="form-control" name="city" placeholder="Stad" required>
</div>
<div class="col-md-3">
    <input type="text" class="form-control" name="tel" placeholder="Telefon nr" required>
</div>
<div class="col-md-3 ">
    <input type="email" class="form-control" name="email" placeholder="E-post" required>
</div>


<!--Skickar datan till både order-->
<div class="col-md-4 my-2 form-group">
    <input type="submit" value="Submit" class="form-control btn btn-outline-light">
</div>

<?php 
//Address mm skickas först till kunddatabasen och sedan skickas en order till orderdatabasen.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $str_address  = $_POST['street'];
    $zip  = $_POST['zip'];
    $city  = $_POST['city'];
    $tel = $_POST['tel'];
    $email  = $_POST['email'];

    //Ser till att ingen skadlig kod skickas 
    $firstname = filter_var($firstname,FILTER_SANITIZE_STRING);
    $lastname = filter_var($lastname,FILTER_SANITIZE_STRING);
    $str_address  = filter_var($str_address,FILTER_SANITIZE_STRING);
    $zip  = filter_var($zip,FILTER_SANITIZE_STRING);
    $city  = filter_var($city,FILTER_SANITIZE_STRING);
    $tel = filter_var($tel,FILTER_SANITIZE_STRING);
    $email  = filter_var($email,FILTER_SANITIZE_EMAIL);

    //Vad som skickas till kunddatabasen
    $stmt = $conn->prepare("INSERT INTO customers (firstname, lastname, str_address, zip, city, tel, email) 
                                           VALUES (:firstname, :lastname, :str_address, :zip, :city, :tel, :email)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':str_address', $str_address);
    $stmt->bindParam(':zip', $zip);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    //Hämtar senast inlagd kund, den som är längst ner på listan
    $stmt = $conn->prepare("SELECT * FROM customers ORDER BY customerid DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch();
    $customerid = $result['customerid'];
    //tid/datum när ordern las. 
    $ordertime = date("Y/m/d/H/i/s");

    //Ordern skickas till orderdatabasen.
    $stmt = $conn->prepare("INSERT INTO orders (productid, customerid, ordertime) 
                                           VALUES (:productid, :customerid, :ordertime)");
    $stmt->bindParam(':productid', $productid);
    $stmt->bindParam(':customerid', $customerid);
    $stmt->bindParam(':ordertime', $ordertime);

    $stmt->execute();?>

    <!--Meddelar att ordern är lagd-->
    <html><script>alert("Ordern är lagd")</script> </html> 
    <?php
}
?>