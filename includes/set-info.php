<?php

//variables for metatags
$titrePage="VBox - La boîte à recette végane - Un blog et des recettes saines pour optimiser votre santé";
$descriptionPage = "Recettes véganes simples et articles de blog santé pour manger et vivre sainement en augmentant sa consommation de produits végétaux";
$imagePage = "https://www.caroline-fontaine.com/vbox/images/image11.jpg";

//check if main header needed;
$mainHeader = true;

//sets default page
$page= "includes/main-page.php";

//check url and sets main array for page.
$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if(strpos($url, 'single-recette')) {
    
    if(isset($_GET['id'])){
        
        $numId =  $_GET['id'];
        settype($numId, 'integer');
        
        $singleRecette = Recette::getRecipeById($conn, $numId);
        
      } else {
        
        ManageError::showErrorPage($type);
        exit;
      }
    
      if (empty($singleRecette)){
       echo 3; exit;  
        ManageError::showErrorPage($type);
        exit;
      }
      $titrePage= $singleRecette->titre;
      if($singleRecette->description != ""){
           $descriptionPage = $singleRecette->description;
      } else {
          $descriptionPage = $singleRecette->titre." - Une délicieuse recette végane à essayer!";
      }
      $imagePage = "https://www.caroline-fontaine.com/vbox/images/assets/".$singleRecette->imagef;
      
      include 'includes/init-favorite.php';
      
} elseif(strpos($url, 'single-blog')) {
    if(isset($_GET['id'])){
    
        $numId = $_GET['id'];  
        settype($numId, 'integer');
        $singleArticle = Article::getArticleById($conn, $numId);
        
    
        } else {
    
            ManageError::showErrorPage($type);
            exit; 
        }
    
        if (empty($singleArticle)){
            ManageError::showErrorPage($type);
            exit; 
        }
    $titrePage = $singleArticle->titre;
    $descriptionPage = "VBox - Des articles de blog pour une mode de vie sain!";
    $imagePage = "https://www.caroline-fontaine.com/vbox/images/assets/".$singleArticle->imagef;
    
} elseif(strpos($url, 'about')) {
    
    $page = "about.php";
    $mainHeader = false;
    $titrePage="À propos du projet V-Box";
    $descriptionPage = "Description du projet de site web V-Box et ses pricipales fonctionnalités, ainsi que la liste des outils et des technologies utilisés.";
    $imagePage = "https://www.caroline-fontaine.com/vbox/images/image11.jpg";
} elseif(strpos($url, 'single-categorie')) {
    $mainHeader = false;
    $descriptionPage = "Une foule de recettes véganes et santé triées par catégories";
    $titrePage="V-Box: Rechercher des recettes par catégorie";
    $imagePage = "https://www.caroline-fontaine.com/vbox/images/image11.jpg";
} elseif(strpos($url, 'recettes.php')) {
    $mainHeader = false;
    $descriptionPage = "Toutes nos catégories de recettes véganes et santé";
    $titrePage="Catégories de recettes véganes et santé";
    $imagePage = "https://www.caroline-fontaine.com/vbox/images/image11.jpg";

} elseif(strpos($url, 'search')) {
    $mainHeader = false;
    $descriptionPage = "Recherche de recettes ou articles de blog";
    $titrePage="Recherche de recettes véganes et d'articles de blog santé";
    $imagePage = "https://www.caroline-fontaine.com/vbox/images/image11.jpg";

}