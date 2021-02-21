<?php
require_once("../database/connection.php");
?>

<!DOCTYPE html>
<html lang="sv">

<!-- 
    Validerad X via https://validator.w3.org/
    Document checking completed. No errors or warnings to show.
-->

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>TripÆ[d]ventüre</title>

  
  <!-- https://bootswatch.com/solar/ -->
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/shop-homepage.css" rel="stylesheet">

  <!-- Script for admin page https://jqueryui.com/tabs/-->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="../webshop.php">TripÆ[d]ventüre</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">

        <form><input class="form-control" type="text" placeholder="Sök" aria-label="Search"></form>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="../webshop.php#aktuellt">Aktuella erbjudanden</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../webshop.php#villkor">Villkor & regler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../kontakt.php">Kontakt</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fas fa-sign-in-alt"></i> Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<!-- slut admin/header.php -->