<?php 

if(!isset($_SESSION)) {
  session_start();
  
  $log="Se connecter";
  
 
} else {
  
  if(Auth::isLoggedIn())
  {
  
  $log="Quitter";
  $logLink = "/vbox/logout.php";
  
  } else {
  
      $log="Se connecter";
      $logLink = "/vbox/login.php";
   }
}

//set cart
$cart = false; 
if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = [];
}

$cart= Cart::itemInCart();

//check if print.css needs to be loaded
if (strpos($_SERVER['REQUEST_URI'], "single-recette") !== false) {
  $toprint=true;
  } else {
  $toprint=false; 
}
if(strpos($_SERVER['REQUEST_URI'], "shopping=1") !== false) {
  $printList=true;
} else {
  $printList=false; 
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/struct.css" />
    <?php if($toprint || $printList) : ?>
      <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
    <?php endif; ?>
    <script src="https://kit.fontawesome.com/146f5f72b9.js" crossorigin="anonymous"></script>

    <script src="js/script.js"></script>
    <title>V-Box : La boîte à recette végane</title>
  </head>
  <body>
