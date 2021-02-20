<?php
require_once("header.php");
require_once("database/connection.php");

$conn->exec("USE $dbName");
$stmt = $conn->prepare("SELECT * FROM orders ORDER BY orderid DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch();
    $orderid = $result['orderid'];
?>
<div class="container">
    <div class="row mb-5">
      <div class="col-12">
        <h1 id="confirmation" class="sectionHeading"> <?php echo $_GET['name'] ?>s resa till <?php echo $_GET['product'] ?> är bokad!</h1>
      </div>
      <div class="">
        <h3 class=""> 
        Kostnad: <?php echo $_GET['price'] ?> kr
        <br>Ert bokningsnummer är: <?php echo $orderid ?>
        <br>Bekräftelse och kvitto skickas till: <?php echo $_GET['email'] ?> 
        <br><br>Tack för att ni valde att handla hos TripÆ[d]ventüre.
        <br>Ha en fortsatt trevlig dag! </h3>
        </div>
    </div>
</div>

<?php
require_once('terms.php');
require_once('footer.php');