<?php
//Variable to set banner image
$classe="header-subpage";

switch($type) {
  
  case "blog": 
    $mainTitle = "Blog";
    $sousTitre = "Blog culinaire et santé";
    break;

  case "recette":
    $mainTitle = "Recettes par catégories";
    $sousTitre = "";
    break;
    
  case "admin";
    $mainTitle = "Administration";
    $sousTitre ="";
    break;
  
  case "about";
    $mainTitle = "À propos du projet VBox";
    $sousTitre ="Par Caroline Fontaine";
    $classe="header-about";
    break;

  case "single-categorie":
    if(isset($_GET['id'])){
      
      $catId=$_GET['id'];
      settype($catId, "integer");
      $categoryItems = Recette::getRecipesByCategory($conn, $catId);
            
      } else {
        
        ManageError::showErrorPage($type);
        exit; 
      }
      
      if (!empty($categoryItems)){
        
        $categoryName= Categories::getCategoryName($conn, $catId);$mainTitle=$categoryName;
        $sousTitre="Recettes par catégorie";
      } else { 
        $type="single-categorie-none";
        ManageError::showErrorPage($type);
        exit; 
       }
      break;

  default:
    $mainTitle = "V-Box";
    $sousTitre = "Juste des recettes simples et délicieuses!";
    break;
}


?>
<!--header-subpage-->

<div class="row1 <?= $classe; ?>">
        
    <div class="main-content">
        <h1 class="main-title"><?= $mainTitle; ?></h1>
        <p class="sous-titre"><?= $sousTitre?></p>
    
    </div>
</div>
<!--header-subpage-->
