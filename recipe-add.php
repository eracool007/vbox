<?php

require 'includes/init.php';
require 'includes/head.php';

Auth::requireLogin();

$conn = require 'includes/db.php';


/*variable for type of header*/
$type="admin";

$singleRecipe = new Recipe();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $singleRecipe->titre= $_POST['titre'];
    $singleRecipe->description = $_POST['description'];
    $singleRecipe->instructions= $_POST['instructions'];
    $singleRecipe->notes= $_POST['notes'];
    $singleRecipe->pdate = $_POST['date'];
    $singleRecipe->imagef = $_POST['image'];
    $singleRecipe->altImage = $_POST['altImage'];
    $singleRecipe->preparation= $_POST['preparation'];
    $singleRecipe->cuisson= $_POST['cuisson'];
    $singleRecipe->portion= $_POST['portion'];
    
    if($singleRecipe->addRecipe($conn)){
       $numId = intval($singleRecipe->id); 
      
        Url::redirect("/single-recette.php?id=$numId");
    }
}
//--------------ici

?>
<header>
  <?php
  require 'includes/navigation.php';

  $errorMsg = "La recette n'existe pas ou la page a été supprimée";           
?>

</header>
<!--Add article-->
<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Ajouter Une recette</h2>
                
                <?php require 'includes/recipe-form.php'; ?>

            <!--fin row1-->    
            </div>
    </div>
    </div>
    </section>  
    

<?php require 'includes/footer.php'; ?>