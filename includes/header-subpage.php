<?php

switch($type) {
  
  case "blog": 
    $mainTitle = "Blog";
    $sousTitre = "Blog culinaire et santé";
    break;

  case "recette":
    $mainTitle = "Recettes par catégories";
    $sousTitre = "";
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
      } 
      break;

  default:
    $mainTitle = "V-Box";
    $sousTitre = "Juste des recettes simples et délicieuses!";
    break;
}
/*

$url = $_SERVER['REQUEST_URI'];
$mainTitle = "V-Box";
$sousTitre = "Juste des recettes simples et délicieuses!";

if(strpos($url, 'blog.php')){
    
  $mainTitle = "Blog";
  $sousTitre = "Blog culinaire et santé";
  
} elseif(strpos($url, "recettes.php")) {
  $mainTitle = "Recettes par catégories";
  $sousTitre = "";
  
} elseif(strpos($url, "single-categorie")) {

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
    }  
} 
*/

?>
<div class="row1 header-subpage">
        
    <div class="main-content">
        <h1 class="main-title"><?= $mainTitle; ?></h1>
        <p class="sous-titre"><?= $sousTitre?></p>
    
    </div>
</div>
