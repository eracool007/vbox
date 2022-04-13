<?php
require 'includes/init.php';
Auth::requireAdmin();

$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';

/*variable for type of header*/
$type="admin";

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

<main>
<section>
    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Supprimer une recette</h2>
                <form method="post">
                    <p>Voulez-vous vraiment supprimer la recette?</p>
                    <button class="btn btn-voir btn-txt" role="button" aria-label="supprimer la recette">Supprimer</button> 
                    <a href="single-recette.php?id=<?= $singleRecette->id; ?>" class="green-links form-links"> Annuler</a>
                </form>
            </div>
        </div>
    </div>
</section>  
</main>
<?php require 'includes/footer.php'; ?>