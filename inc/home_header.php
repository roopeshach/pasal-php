<!DOCTYPE html>
<html lang="en">
<head>
  <title>PASAL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php 

$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  


?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">PASAL </a>
    </div>
    <ul class="nav navbar-nav">
      <li class="<?php if($curPageName == "home.php") echo 'active'; else echo '';?>"><a href="home.php">Home</a></li>
      <li class="<?php if($curPageName == "cart.php") echo 'active'; else echo '';?>"><a href="cart.php">My Cart</a></li>
      <li class="<?php if($curPageName == "order.php") echo 'active'; else echo '';?>"><a href="order.php">My Orders</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li><a href="home.php?logout='1'"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
    </ul>
  </div>
</nav>
  

