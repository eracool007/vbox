<?php

require 'includes/init.php';
require 'includes/head.php';

Auth::requireLogin();

$conn = require 'includes/db.php';

/*variable for type of header*/
$type="admin";

?>

<?php
if(isset($_GET['id'])){
    
    $numId = $_GET['id'];  
    settype($numId, 'integer');
    $singleRecette = Recette::getRecipeById($conn, $numId);

    if(! $singleRecette){
        echo "Aucune recette"; exit;
    }
} else {
        
        ManageError::showErrorPage($type);
        exit; 
}

if($_SERVER["REQUEST_METHOD"] =="POST"){
    
    if ($singleRecette->deleteRecipe($conn)){
        
        Url::redirect("/recettes.php");
        
    }
}
?>

<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';   
  $errorMsg = "La recette n'existe pas ou la page a été supprimée";           
?>

</header>
<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Supprimer une recette</h2>
                <form method="post">
                    <p>Voulez-vous vraiment supprimer la recette?</p>
                    <button>Supprimer</button> 
                    <a href="single-recette.php?id=<?= $singleRecette->id; ?>" class="footer-links"> Annuler</a>
                </form>

            <!--fin row1-->    
            </div>
        </div>
    </div>
</section>  
<?php require 'includes/footer.php'; ?>