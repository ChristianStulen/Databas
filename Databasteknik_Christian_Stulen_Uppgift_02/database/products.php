<?php

/**
 * Separata arrayer för egenskaper hos produkter
 * Sammanfogas till yttre array ($products) 
 * 
 * KVALIT20 - Databasteknik - Uppgift 2
 * 2021-02-11
 * */

$name = array(
    0 => "Skogen",
    1 => "Strandbad",
    2 => "Rockstock",
    3 => "Vinterspa",
    4 => "Naturen",
    5 => "Krokstad berg",
    6 => "Björnläger",
    7 => "Mordor",
    8 => "Mountainbike",
    9 => "Fågelskådning"
);
$description = array(
    0 => "Glöm vardagen för en liten stund och ta med någon du tycker om på en minisemester till skogen – kottarnas och kvistarnas plats! Få platser kan erbjuda så många granbarr som denna. ",
    1 => "Lugna dagar på strandbad. Nu kan du ta med dig någon du inte tycker om till denna sorgliga strand. Ni övernattar i rum. Ni har inte tillgång till skydd från snålblåsten eller bekvämligheter! ",
    2 => "I färgglada Rockstock finns det mycket att uppleva och upptäcka. Tältet kan ni sätta upp i hjärtat av Rostock där du är helt utelämnad till naturens krafter. Du äter middag med skallerormar.",
    3 => "Välkomna till Brösarps Gästgifveri: Denna iskalla plats omgiven av obärmhärtig natur, precis vid det gamla korset. Ni bor i eget tält, ett opersonligt och charmigt sätt att sova med romantisk känsla.",
    4 => "Ta med dig en vän eller hela familjen på en avkopplande vistelse bland höga berg och djupa hav. Här får ni verkligen tid till att koppla av med den dramatiska naturen precis utanför fönstret.",
    5 => "Starta 2020 på berget tillsammans med någon du tycker om. Förutom den vackra omgivningen och naturens mysiga atmosfär får ni ta del av bergets säsongsbetonade meny inkl. varsitt glas varm saft.",
    6 => "Camp Mons är ett läger omgiven av ensamhet. Med sin fantastiska miljö, underbara björnslagsmål och sin hisnande stjärnhimmel med norrsken, kommer du få uppleva en semester som aldrig förr.",
    7 => "Ta med familjen och bo på Orchgården i Mordor. Här bor ni i mysiga svarta jordhålor. Strax intill hittar ni Tolkiens Värld, så passa på att hälsa på Sauron! (Obs! Inträde till Tolkiens Värld ingår inte).",
    8 => "Ta med dig en vän på en vistelse på vackra WCC. Ni hyr ett hus som rymmer sovrum med plats för personer, här har ni tillgång till ved efter en heldag med mountainbike i landskap. ",
    9 => "Trivsel för alla! Njut av fågelskådning med varierande svårighetsgrad. För barnen finns små fåglar och ägg, allt för att väcka nyfikenheten och glädjen som fågelskådning innebär. "
);
$image = array(
    0 => "skogen.jpg",
    1 => "strandbad.jpg",
    2 => "rockstock.jpg",
    3 => "vinterspa.jpg",
    4 => "naturen.jpg",
    5 => "krokstad-berg.jpg",
    6 => "bjornlager.jpg",
    7 => "mordor.jpg",
    8 => "mountainbike.jpg",
    9 => "fagelskadning.jpg"
);

// Bilder till karusell
$image_lg = array(
    0 => "skogen-lg.jpg",
    1 => "strandbad-lg.jpg",
    2 => "rockstock-lg.jpg",
    3 => "vinterspa-lg.jpg",
    4 => "naturen-lg.jpg",
    5 => "krokstad-berg-lg.jpg",
    6 => "bjornlager-lg.jpg",
    7 => "mordor-lg.jpg",
    8 => "mountainbike-lg.jpg",
    9 => "fagelskadning-lg.jpg"
);

$price = array(
    0 => 1268,
    1 => 1259,
    2 => 2745,
    3 => 2690,
    4 => 3449,
    5 => 2498,
    6 => 3600,
    7 => 3400,
    8 => 1789,
    9 => 2895
);
$in_stock = array(
    0 => rand(0, 50),
    1 => rand(0, 50),
    2 => rand(0, 50),
    3 => rand(0, 50),
    4 => rand(0, 50),
    5 => rand(0, 50),
    6 => rand(0, 50),
    7 => rand(0, 50),
    8 => rand(0, 50),
    9 => rand(0, 50)
);

// Skapa 10 olika produkter (product)
// och spara dessa i en ny array som heter products.

$products = array();

for ($i=0; $i < 10 ; $i++) { //Loppar genom varje index och tilldelar värden utifrån motsvarande index i egenskapernas arrayer
  
    $product = array(
        "productid" => $i+1,
        "name" => $name[$i],
        "description" =>  $description[$i],
        "image" => $image[$i],
        "image_lg" => $image_lg[$i], // Bilder till karusell
        "price" => $price[$i],
        "in_stock" => rand(0, 50)
    );
    
    array_push($products, $product);

}

//echo "<pre>";
//print_r($products);

