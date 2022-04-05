<?php

require 'includes/init.php';
Auth::requireLogin();

$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';



/*variable for type of header*/
$type="admin";

//create new recipe array
$singleRecipe = new Recette();


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $singleRecipe->titre= $_POST['titre'];
    $singleRecipe->description = htmlentities($_POST['description']);
    $singleRecipe->instructions= htmlentities($_POST['instructions']);
    $singleRecipe->notes= htmlentities($_POST['notes']);
    $singleRecipe->pdate = $_POST['date'];
    $singleRecipe->altImage = $_POST['altImage'];
    $singleRecipe->preparation = $_POST['preparation'];
    $singleRecipe->cuisson = $_POST['cuisson'];
    $singleRecipe->portion = $_POST['portion'];

    //put selected category ids in array
    if(isset($_POST['cat'])){
        
        foreach($_POST['cat'] as $cat){
    
            $singleRecipe->category[] = $cat;
      
        }
    }
   
   //put ingredients in array
   if(isset($_POST['ing'])){
          
       $i=0;
       foreach ($_POST['ing'] as $ingredient){
        if($ingredient!= ""){
            
            $singleRecipe->items[] = $ingredient;
            
        $i++;
        }
       }
    } 
   
    if($singleRecipe->addRecipe($conn)){
        
        $numId = intval($singleRecipe->id); 
        Url::redirect("/single-recette.php?id=$numId");
    } 
}
//end $_post

$allCategories = Categories::getAllCategories($conn);

?>
<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';   
       
?>

</header>
<main>
<section>
    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Ajouter Une recette</h2>
                
                <?php require 'includes/recette-form.php'; ?>

            <!--fin row1-->    
            </div>
        </div>
    </div>
</section>  
</main>

<?php require 'includes/footer.php'; ?>