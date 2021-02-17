<?php

/** 
 * Klassen Carousel innehåller funktioner som:
 * hämtar API (JSON), omvandlar till en array och skriver ut valda bilder till en bildkarusell
 * 
 * Annika Rengfelt
 * https://github.com/adrowsy
 * KVALIT20 - Backend - Uppgift 3
 * 2021-01-27
 * */

class Carousel
{

  public static $url = "http://localhost/Databas/Databasteknik_Christian_Stulen_Uppgift_02/img";

  public static function main()
  {
    try {
      $array = self::getData(self::$url);
      self::viewData($array);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public static function getData($url)
  {
    $json = @file_get_contents($url); // @ anger att eget felmeddelande ska visas
    if (!$json)
      throw new Exception("<div class='alert alert-danger'>Cannot access $url</div>");
    return json_decode($json, true); //True ger associativ array
  }

  public static function getFirstPara($string)
  {
    $string = substr($string, 0, strpos($string, '.')) . '!';
    return $string;
  }
  public static function viewData($array)
  {
    $img_dir = "http://localhost/Databas/Databasteknik_Christian_Stulen_Uppgift_02/img";
    $firstimg = $array[2]['image_lg'];
    $secondimg = $array[9]['image_lg'];
    $thirdimg = $array[5]['image_lg'];
    $fourthimg = $array[6]['image_lg'];

    $firstcap = $array[2]['name'];
    $secondcap = $array[9]['name'];
    $thirdcap = $array[5]['name'];
    $fourthcap = $array[6]['name'];

    $firstdes = self::getFirstPara($array[2]['description']);
    $seconddes = self::getFirstPara($array[9]['description']);
    $thirddes = self::getFirstPara($array[5]['description']);
    $fourthdes = self::getFirstPara($array[6]['description']);


    $carousel = "

        <div class='col-md-12 d-none d-md-block'>
        
        <div id='carouselExampleIndicators' class='carousel slide my-4' data-ride='carousel'>
        <ol class='carousel-indicators'>
          <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
          <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
          <li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
          <li data-target='#carouselExampleIndicators' data-slide-to='3'></li>
        </ol>
        <div class='carousel-inner' role='listbox'>
          <div class='carousel-item active'>
            <img class='d-block img-fluid' src='$img_dir/$firstimg' alt='$firstimg'>
            <div class='carousel-caption d-none d-md-block'>
        <h5>$firstcap</h5>
        <p>$firstdes</p>
      </div>
          </div>
          
          <div class='carousel-item'>
            <img class='d-block img-fluid' src='$img_dir/$secondimg' alt='$secondimg'>
            <div class='carousel-caption d-none d-md-block'>
        <h5>$secondcap</h5>
        <p>$seconddes</p>
      </div>
          </div>
          <div class='carousel-item'>
            <img class='d-block img-fluid' src='$img_dir/$thirdimg' alt='$thirdimg'>
            <div class='carousel-caption d-none d-md-block'>
        <h5>$thirdcap</h5>
        <p>$thirddes</p>
      </div>
          </div>
          <div class='carousel-item'>
            <img class='d-block img-fluid' src='$img_dir/$fourthimg' alt='$fourthimg'>
            <div class='carousel-caption d-none d-md-block'>
        <h5>$fourthcap</h5>
        <p>$fourthdes</p>
      </div>
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
