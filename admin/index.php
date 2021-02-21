<?php


require_once ("header.php");
?>
<body>

<div  id="tabs">
  <ul class="row" >
    <li style="margin-left:20px"><a href="#tabs-1">Messages</a></li>
    <li style="margin-left:20px"><a href="#tabs-2">Orders</a></li>
    <li style="margin-left:20px"><a href="#tabs-3">Customers</a></li>
  </ul>
  <div id="tabs-1">
  <?php require_once ("messages.php"); ?>
  </div>
  <div id="tabs-2">
  <?php require_once ("orders.php"); ?>
  </div>
  <div id="tabs-3">
  <?php require_once ("customers.php"); ?>
  </div>
</div>
 
</body>
</html>
<?php
require_once ("../footer.php");
?>
