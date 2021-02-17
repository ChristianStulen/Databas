<?php
require_once('php/getProducts.php');
require_once('php/Carousel.php');
// require_once("database/create.php"); // Återställer databas, skapar tabeller och läser in data
require_once('header.php');
?>

  <!-- Page Content -->
  <div class="container">

    <!-- Carousel -->
    <div class="row">
      <?php Carousel::main(); ?>
    </div>
    <!-- /.carousel -->

    <!-- Products -->
    <div class="row">

      <div class="col-12">
        <h1 id="aktuellt" class="sectionHeading">Aktuella erbjudanden</h1>
      </div>

      <div class="col">
        <?php getProducts::main(); ?>
      </div>

    </div>
    <!-- /.products -->

  </div>
  <!-- /.container -->


<?php
  require_once('footer.php');
?>