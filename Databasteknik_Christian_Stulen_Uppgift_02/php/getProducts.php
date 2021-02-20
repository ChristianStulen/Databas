<?php

/** 
 * Klassen getProducts innehåller funktioner som:
 * hämtar data från databas, omvandlar till array och visar data
 * 
 * Annika Rengfelt
 * https://github.com/adrowsy
 * KVALIT20 - Databasteknik - Uppgift 2
 * 2021-02-17
 * */

require_once('database/connection.php');
$conn->exec("USE $dbName");

class getProducts
{
  public static $min = 1; // Minsta antal produkter att visa
  public static $max = 10; // Max antal produkter att visa

  /** 
   * Hämtar och visar data från databastabell
   */

  public static function main()
  {
    $tblName = "products"; // Tabellen som ska hämtas och visas

    try {
      $products = self::getArrayFromTable($tblName);
      self::viewData($products);
    } catch (Exception $e) {
      echo "<div class='alert alert-warning'>Error: " . $e->getMessage() . "</div>";
      exit();
    }
  }


  /**
   * Get data from a table
   * Returns Assoc. Array
   */

  public static function getArrayFromTable($tblName)
  {
    global $conn; // Hämtas från database.php
    $stmt = $conn->prepare("SELECT * FROM $tblName ");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public static function viewData($array)
  {
    $show = isset($_GET['show']) ? $_GET['show'] : self::$max;
    $shown = 0;

    $product = "
    <div class='row'>";

    foreach ($array as $key => $value) {
      if ($shown < $show) {

        $productid = $value['productid'];
        $img_dir = "http://localhost/Databas/Databasteknik_Christian_Stulen_Uppgift_02/img";
        $image = $value['image'];
        $name = $value['name'];
        $price = $value['price'];
        $price = number_format($price, 0, ',', ' ');
        $description = $value['description'];
        $inStock = $value['in_stock'];

        $product .= <<<HTML
        
        <div class='col-md-6 mb-4'>
          <div class='card h-100'>
            <div>
              <div class='icon-float right'>
                <i class='fas fa-asterisk text-white' style='font-size: 2rem;'></i>
              </div><!-- ./ icon -->
                                        
              <img src='$img_dir/$image' alt='$image' style='' class='card-img-top img-fluid'>
            </div><!-- ./ img -->

            <div class='card-body'>
              <div class='row'>
                <div class='col'>
                  <h2 class='card-title'><a href='#'>$name</a></h2>
                </div>

                <div class='col-lg-auto'>
                  <h4 class='text-lg-right'>$price SEK</h4>
                </div>
              </div>

              <p class='card-text text-right'>Lediga platser: $inStock</p>
              <p class='card-text mt-3'>$description</p>

              <!-- Booking form -->
              <div class=''>
                <form action='order.php' method='get'>
                    <div class='form-row align-items-end'>
                      <input type='hidden' name='productid' value='$productid'>
HTML;

        if ($inStock > 0) {
          $product .= "<button type='submit' class='btn btn-lg btn-success mb-2 btn-block'>Boka</button>";
        } else {
          $product .= "<button disabled type='submit' class='btn btn-lg btn-warning mb-2 btn-block'>Slutsåld</button>";
        }

        $product .= <<<HTML
                    <!-- Legal notice -->
                    <div class='col-12'>
                      <p class='card-text small'>
                      Genom att klicka på "Boka" bekräftar jag att jag har läst och godkänt 
                      <a href='#' class='alert-link text-primary'>Allmänna villkor</a>, 
                      <a href='#' class='alert-link text-primary'>Dataskyddsinformation</a> och 
                      <a href='#' class='alert-link text-primary'>Cookiepolicy</a>
                    </div> <!--./ Legal notice-->
                  </div>
                </form>
              </div> <!-- ./ booking form -->
            </div> <!-- ./ card-body -->
          </div> <!-- ./ card -->
        </div> <!-- ./ col -->
        HTML;

        $shown++;
      }
    }
    $product .= "</div>";

    echo $product;
  }
}
