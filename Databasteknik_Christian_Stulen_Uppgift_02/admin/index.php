<?php

require_once("header.php");
?>

<div class="container">

    <div id="tabs">
      <div class="text-center">
        <ul class="row">
          <li ><a href="#tabs-1">Messages</a></li>
          <li ><a href="#tabs-2">Orders</a></li>
          <li ><a href="#tabs-3">Customers</a></li>
        </ul>
      </div>
      <div id="tabs-1">
        <?php require_once("messages.php"); ?>
      </div>
      <div id="tabs-2">
        <?php require_once("orders.php"); ?>
      </div>
      <div id="tabs-3">
        <?php require_once("customers.php"); ?>
      </div>
    </div>


</div>

<?php
require_once("../footer.php");
?>