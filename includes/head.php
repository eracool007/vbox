<?php 
require 'includes/auth.php';

if(!isset($_SESSION)) {
  session_start();
  $log="Se connecter";
  
 
} else {
  
  if(isLoggedIn())
  {
    
  $log="Quitter";
  $logLink = "logout.php";
  
  } else {
      
      $log="Se connecter";
      $logLink = "login.php";
   }
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
    <script
      src="https://kit.fontawesome.com/4592bcc5fd.js"
      crossorigin="anonymous"
    ></script>
    <script src="js/script.js"></script>
    <title>V-Box : La boîte à recette végane</title>
  </head>
  <body>