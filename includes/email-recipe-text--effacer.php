<?php
/*
ob_start();
require 'includes/init.php';
require 'includes/head.php';
$conn = require 'includes/db.php';


$type = "recette";

$back = "recettes.php";

?>
<header>
  <?php
  require 'includes/navigation.php';
  ?>
</header>
<?php
 
*/

if(isset($_GET['id'])){
  
  $numId =  $_GET['id'];
  settype($numId, 'integer');
   
  $singleRecette = Recette::getRecipeById($conn, $numId);
  
} else {
   
  ManageError::showErrorPage($type);
  exit;
}

if (empty($singleRecette)){
  
  ManageError::showErrorPage($type);
  exit;
}

$categoryList = Categories::getCategory($conn, $singleRecette->id, false);
?>
    <!--Details de la recette-->
     <div>      
    <h1><?= $singleRecette->titre; ?></h1><br>
    <img src="https://www.caroline-fontaine.com/vbox/images/assets/<?= $singleRecette->imagef; ?>" width="300px" height="auto">
                  <p>
                    Préparation:   <?= $singleRecette->preparation; ?> min.<br>
                    Cuisson:   <?= $singleRecette->cuisson; ?> min.<br>
                    Portions:   <?= $singleRecette->portion; ?>
                  </p><br></div>
      
    
  <!--Description recette-->
     <div>
      <h3>DESCRIPTION</h3>
    <p>
      <?= html_entity_decode($singleRecette->description); ?>
      </p><br></div>
      <div>
      <h3>INGREDIENTS</h3>
      
      <ul>
        <?php
        $listeIngredients = Ingredients::getIngredients($conn, $singleRecette->id);
        if (!empty($listeIngredients)) {
          
          foreach($listeIngredients as $ing){ 
            ?>
            <li class="ing">
            <input type="checkbox" id="ing<?= $ing['id']; ?>" name="ingredient<?= $ing['id']; ?>" value="ingredient<?= $ing['id']; ?>">
            <label for="ingredient<?= $ing['id']; ?>"> <?= $ing['item']; ?>
            
          </label>
            
            </li>
            <?php
          }
        } else { 
            echo "Aucun ingrédient mentionné."; 
        } ?>
      </ul><br></div>
      
      <div>
      <h3>PREPARATION</h3>
      <p>
      <?= html_entity_decode($singleRecette->instructions); ?>
    </p><br></div>
  
  <?php 
  if($singleRecette->notes && $singleRecette->notes != "" && $singleRecette->notes != " "){ ?>
          <div><h3>NOTES</h3>
          <p>
          <?= html_entity_decode($singleRecette->notes); ?>
          </p></div>
         
  <?php } ?>
  
<?php require 'includes/footer.php'; ?>
<?php ob_end_flush(); ?>