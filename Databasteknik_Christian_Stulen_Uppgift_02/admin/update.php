<?php
// OBS!! Behövs ej, sparad bara för vidare utveckling skulle önskas


require_once ("../header.php");
require_once ("../database/connection.php");
//GETs the id and then find the relevant data from the database.
$customerid = $_GET['customerid'];


$stmt = $conn->prepare("SELECT * FROM customers WHERE customerid = :customerid");
$stmt->bindParam(':customerid' , $customerid);
$stmt->execute();
$result = $stmt->fetch();

$firstname = $result['firstname'];
$lastname = $result['lastname'];
$str_address = $result['str_address'];
$zip = $result['zip'];
$city = $result['city'];
$tel  = $result['tel'];
$email  = $result['email'];
?>
<!--A form with the data for the id is printed. The user can now edit name, email and message.-->
<form action="#" class="" method="post" >

       
<div class="col-md-6 form-group">
    <input type="text" class="form-control " name="fname" value="<?php echo $firstname ?>">
</div>
<div class="col-md-6 form-group">
    <input type="text" class="form-control" name="lname" value="<?php echo $lastname ?>">
</div>
<div class="col-md-6 form-group">
    <input type="text" class="form-control" name="street" value="<?php echo $str_address ?>">
</div>
<div class="col-md-6 form-group">
    <input type="text" class="form-control" name="zip" value="<?php echo $zip ?>">
</div>
<div class="col-md-6 form-group">
    <input type="text" class="form-control" name="city" value="<?php echo $city ?>">
</div>
<div class="col-md-6 form-group">
    <input type="text" class="form-control" name="tel" value="<?php echo $tel ?>">
</div>
<div class="col-md-6 form-group">
    <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
</div>

</div>
<!--Button to submit the new data to the fatabase.-->
<div class="col-md-4 my-2 form-group">
    <input type="submit" value="Submit" class="form-control btn btn-outline-light">
</div>



</form>
<?php

//When the submit button is pressed the following if statment kicks in. It updates with the new values 
//and then refreshes the page.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $str_address = $_POST['street'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $tel  = $_POST['tel'];
    $email  = $_POST['email'];

    $sql = "UPDATE customers SET firstname = :firstname, lastname = :lastname, str_address = :str_address, zip = :zip, city = :city, tel = :tel, email = :email WHERE customerid = :customerid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':customerid', $customerid);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':str_address', $str_address);
    $stmt->bindParam(':zip', $zip);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    echo "<meta http-equiv='refresh' content='0'>";
}