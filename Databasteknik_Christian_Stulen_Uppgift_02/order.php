<?php
require_once("header.php");
//Hämtar databasen samt id på produkten med hjälp av GET 
require_once("database/connection.php");
require_once("php/getProducts.php");

$conn->exec("USE $dbName");
//echo "<code>database: $dbName selected</code><br>";

$productid = $_GET['productid'];
$stmt = $conn->prepare("SELECT * FROM products WHERE productid = :productid");
$stmt->bindParam(':productid', $productid);
$stmt->execute();
$result = $stmt->fetch();
$name = $result['name'];
$price = $result['price'];

//Funktion för att kontrollera om kund finns. Returnerar true om den hittar en match. 
function customerExist($controllEmail){ 
    require("database/connection.php");
    $conn->exec("USE $dbName");
    $stmt = $conn->prepare("SELECT * FROM customers");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $doesExist = false;
    
    foreach ($result as $key => $value) {
        $email = $value['email'];
        if( $email == $controllEmail){
            $doesExist = true;
            
        }
    }
    return $doesExist;
}
?>

<!-- Page Content -->
<div class="container">

    <!-- Orderformulär -->
    <div>
        <div class="row">
            <div class="col-12">
                <h1 id="aktuellt" class="sectionHeading">Slutför din order av resan till '<?php echo $name ?>'</h1>

                <div class="alert alert-info">
                    <p>Vänligen fyll i dina uppgifter och leveransadress</p>
                </div>
            </div>
        </div>

        <!--Skriver ut ett formulär där kunden skriver in sina uppgifter-->
        <form action="#" method="post">

            <div class="row">
                <div class="col-md-6 form-group">
                <label for="namn">Förnamn</label>
                    <input id="namn" type="text" class="form-control " name="firstname" placeholder="Förnamn" required>
                </div>
                <div class="col-md-6 form-group">
                <label for="efternamn">Efternamn</label>
                    <input id="efternamn" type="text" class="form-control " name="lastname" placeholder="Efternamn" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                <label for="tel">Telefonnummer</label>
                    <input id="tel" type="text" class="form-control" name="tel" placeholder="Telefon nr" required>
                </div>
                <div class="col-md-6 form-group">
                <label for="epost">E-postadress</label>
                    <input id="epost" type="email" class="form-control" name="email" placeholder="E-post" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                <label for="adress">Gatuadress</label>
                    <input id="adress" type="text" class="form-control" name="street" placeholder="Gata" required>
                </div>
                <div class="col-md-2 form-group">
                <label for="zip">Postnummer</label>
                    <input id="zip" type="text" class="form-control" name="zip" placeholder="Postkod" required>
                </div>
                <div class="col-md-4 form-group">
                <label for="stad">Postort</label>
                    <input id="stad" type="text" class="form-control" name="city" placeholder="Stad" required>
                </div>
            </div>
            <div class="row">
                <!--Skickar datan till både order-->
                <div class="col-md-12 form-group d-grid gap-2 d-md-flex justify-content-md-end">
                    <input type="submit" value="Skicka order" class="btn btn-primary me-md-2">
                </div>
            </div>
    </div><!-- /.order -->
</div>
<!-- /.container -->


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
    $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
    $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
    $str_address  = filter_var($str_address, FILTER_SANITIZE_STRING);
    $zip  = filter_var($zip, FILTER_SANITIZE_STRING);
    $city  = filter_var($city, FILTER_SANITIZE_STRING);
    $tel = filter_var($tel, FILTER_SANITIZE_STRING);
    $email  = filter_var($email, FILTER_SANITIZE_EMAIL);

    
    //Om kunden finns (går på epost) så väljer den det redan existerande kund nr. Annars ny kund
    if (customerExist($email)==true){ 
        //Hämtar lista på kunder
        $stmt = $conn->prepare("SELECT * FROM customers");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //Jämför inmatade eposten mot existerande epost. Sparar kundid om en matchning hittas
        $controllEmail = $email;
        foreach ($result as $key => $value) {
            $customerEmail = $value['email'];
            if( $customerEmail == $controllEmail){
                $customerid = $value['customerid'];
            }
        }
        
    }else{
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
     
    }
    //tid/datum när ordern las. 
    $ordertime = date("Y/m/d/H/i/s");   

    //Ordern skickas till orderdatabasen.
    $stmt = $conn->prepare("INSERT INTO orders (productid, customerid, ordertime) 
                                           VALUES (:productid, :customerid, :ordertime)");
    $stmt->bindParam(':productid', $productid);
    $stmt->bindParam(':customerid', $customerid);
    $stmt->bindParam(':ordertime', $ordertime);

    $stmt->execute(); ?>

    <!--Meddelar att ordern är lagd-->
    <html>
    <script>        
    alert("Ordern är lagd");
    </script>

    </html>
<?php
}

require_once('terms.php');
require_once('footer.php');
?>