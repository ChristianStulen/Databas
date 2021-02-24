<?php
require_once('header.php');
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Anslutning och val av databas
    require_once("database/connection.php");
    $dbName; // Databas för kontaktformulär
    $tblName = "messages"; // Tabell för meddelanden
    $conn->exec("USE $dbName");

    // Rensa otillåtna tecken
    $namn = filter_var($_POST['namn'], FILTER_SANITIZE_STRING);
    $epost = filter_var($_POST['epost'], FILTER_SANITIZE_EMAIL);
    $mottagare = $_POST['mottagare'];
    $meddelande = filter_var($_POST['meddelande'], FILTER_SANITIZE_STRING);

    // Kontrollera förekomst av otillåtna tecken
    $valid_namn = false;
    $valid_epost = false;

    if (preg_match("~^[\p{L}\p{Z}]+$~u", $namn)) {
        $valid_namn = true;
    } else {
        $message = "<div class='alert alert-danger pb-1' role='alert'>
        <p>Kunde inte spara meddelande (otillåtna tecken i fältet namn)</p>
        </div>";
    }
    if (!filter_var($_POST['epost'], FILTER_VALIDATE_EMAIL) === false) {
        $valid_epost = true;
    } else {
        $message .= "<div class='alert alert-danger pb-1' role='alert'>
        <p>Kunde inte spara meddelande (otillåtna tecken i fältet epost)</p>
        </div>";
    }

    // Meddelande sparas om inmatningsfälten passerar validering
    if ($valid_namn and $valid_epost) {

        // Skapa en SQL-sats (förbereda en sats)
        $stmt = $conn->prepare("INSERT INTO $tblName (namn, epost, mottagare, meddelande)
                                    VALUES (:namn, :epost, :mottagare, :meddelande)");

        // Binda parametrar (binda variabler med platshållare)
        $stmt->bindParam(':namn', $namn);
        $stmt->bindParam(':epost', $epost);
        $stmt->bindParam(':mottagare', $mottagare);
        $stmt->bindParam(':meddelande', $meddelande);

        // Kör SQL-sats
        $stmt->execute();

        // Hämta sista id som infogats A_I
        $last_id = $conn->lastInsertId();

        $message = "<div class='alert alert-success pb-1' role='alert'>
        <p>Tack $namn. Ditt meddelande har skickats (nr.  $last_id)</p>
        </div>";
    }
}
?>

<!-- Page Content -->
<div class="container">

    <!-- Contact -->
    <div>
        <div class="row">
            <div class="col-12">
                <h1 id="kontakt" class="sectionHeading">Kontaktformulär</h1>

                <form novalidate action="<?php echo htmlspecialchars('#'); ?>" method="post" class="row">
                    <div class="form-group col-md-4">
                        <label for="mottagare">Mottagare</label>
                        <select name="mottagare" id="mottagare" class="form-control">
                            <option selected value="">Välj...</option>
                            <option value="Annika">Annika Rengfelt</option>
                            <option value="Christian">Christian Stulen</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="namn">Ditt namn</label>
                        <input id="namn" name="namn" type="text" required class="form-control" placeholder="Namn">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="epost">Din epost</label>
                        <input id="epost" name="epost" type="email" required class="form-control" placeholder="E-post">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="meddelande">Ditt meddelande</label>
                        <textarea id="meddelande" name="meddelande" cols="30" rows="5" required class="form-control" placeholder="Skriv ett meddelande"></textarea>
                    </div>

                    <div class="col-md-12 form-group d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary me-md-2">Skicka meddelande</button>
                    </div>
                </form>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" and $message) echo $message; ?>
            </div>
        </div>
    </div> <!-- /.contact -->

    <!-- About us -->
    <div>
        <div class="row">
            <div class="col-12">
                <h1 class="sectionHeading">Om oss</h1>
            </div>
        </div>

        <div class="row text-center my-3">
            <div class="col-md my-3">
                <div class="">
                    <img class="mx-auto rounded-circle img-fluid" src="img/team/a.jpg" alt="" style="height:30vh;">
                    <h4>Annika Rengfelt</h4>
                    <p class="text-muted">annika.rengfelt@yh.nackademin.se</p>
                    <a class="mx-2" href="#"><i class="fab fa-linkedin" style="font-size:2rem;"></i></a>
                    <a class="mx-2" href="#"><i class="fab fa-github" style="font-size:2rem;"></i></a>
                </div>
            </div>

            <div class="col-md">
                <div class="" my-3>
                    <img class="mx-auto rounded-circle img-fluid" src="img/team/c.jpg" alt="" style="height:30vh;">
                    <h4>Christian Stulen</h4>
                    <p class="text-muted">christian.stulen@yh.nackademin.se</p>
                    <a class="mx-2" href="#"><i class="fab fa-linkedin" style="font-size:2rem;"></i></a>
                    <a class="mx-2" href="#"><i class="fab fa-github" style="font-size:2rem;"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /. about us -->

</div>
<!-- /.container -->

<?php

require_once('footer.php');

?>