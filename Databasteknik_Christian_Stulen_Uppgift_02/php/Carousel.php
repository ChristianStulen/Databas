<?php

/** 
 * Klassen Carousel innehåller funktioner som:
 * hämtar data från databas, omvandlar till array och visar data
 * 
 * Annika Rengfelt
 * https://github.com/adrowsy
 * KVALIT20 - Databasteknik - Uppgift 2
 * 2021-02-12
 * */

require_once("database/connection.php");
$conn->exec("USE $dbName");

class Carousel
{

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

    $img_dir = "http://localhost/Databas/Databasteknik_Christian_Stulen_Uppgift_02/img/";

    # Anger index för de bilder som ska visas i karusellen
    $firstImg = $array[3]['image_lg'];
    $firstAlt = $array[3]['name'];

    $secondImg = $array[6]['image_lg'];
    $secondAlt = $array[6]['name'];

    $thirdImg = $array[9]['image_lg'];
    $thirdAlt = $array[9]['name'];

    # CSS-klassen d-none döljer karusell från små skärmar 
    # Mer info https://getbootstrap.com/docs/4.0/components/carousel/

    $carousel = "
        <div class='col-md-12 d-none d-md-block'>

        <div id='carouselExampleIndicators' class='carousel slide my-4 ' data-ride='carousel'>
          <ol class='carousel-indicators'>
            <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
            <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
            <li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
          </ol>

          <div class='carousel-inner' role='listbox'>
            <div class='carousel-item active'>
              <img class='d-block img-fluid' src='$img_dir/$firstImg' alt='$firstAlt'>
            </div>
            <div class='carousel-item'>
              <img class='d-block img-fluid' src='$img_dir/$secondImg' alt='$secondAlt'>
            </div>
            <div class='carousel-item'>
              <img class='d-block img-fluid' src='$img_dir/$thirdImg' alt='$thirdAlt'>
            </div>
          </div>
          <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
            <span class='sr-only'>Previous</span>
          </a>
          <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
            <span class='carousel-control-next-icon' aria-hidden='true'></span>
            <span class='sr-only'>Next</span>
          </a>
        </div>
      </div>
      ";

    echo $carousel;
  }
}