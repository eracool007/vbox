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

//add ingredients to shopping list
if(isset($_POST) && isset($_GET['action']) && $_GET['action']=="add"){
    
  foreach($_POST as $item){
    
    array_push($_SESSION['cart'], htmlspecialchars($item));
     
  } 
  $cart=true;
  
} 
//check if shopping list is required
$printCart=False;

//check if main header needed;
$mainHeader = true;

//sets default page
$page= "includes/main-page.php";
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>VBox - La boîte à recette végane - Un blog et des recettes saines pour optimiser votre santé</title>
    
    <meta name="title" content="VBox - La boîte à recette végane - Un blog et des recettes saines pour optimiser votre santé">
    <meta name="description" content="Recettes véganes simples et articles de blog santé pour manger et vivre sainement en augmentant sa consommation de produits végétaux">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.caroline-fontaine/vbox/">
    <meta property="og:title" content="VBox - La boîte à recette végane - Un blog et des recettes saines pour optimiser votre santé">
    <meta property="og:description" content="Recettes véganes simples et articles de blog santé pour manger et vivre sainement en augmentant sa consommation de produits végétaux">
    <meta property="og:image" content="https://www.caroline-fontaine.com/vbox/images/image11.jpg"> 
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image"> 
    <meta property="twitter:url" content="https://www.caroline-fontaine/vbox/">
    <meta property="twitter:title" content="VBox - La boîte à recette végane - Un blog et des recettes saines pour optimiser votre santé">
    <meta property="twitter:description" content="Recettes véganes simples et articles de blog santé pour manger et vivre sainement en augmentant sa consommation de produits végétaux">
    <meta property="twitter:image" content="https://www.caroline-fontaine.com/vbox/images/image11.jpg"> 

    <!-- Mobile devices -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <!-- Styles ands JS -->
    <link rel="icon" type="text/png" href="favicon-32x32.png">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/struct.css" />

    <?php if($toprint || $printList) : ?>
      <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
    <?php endif; ?>
    <script src="https://kit.fontawesome.com/146f5f72b9.js" crossorigin="anonymous"></script>

    <script src="js/script.js"></script>

  </head>
  <body>
  