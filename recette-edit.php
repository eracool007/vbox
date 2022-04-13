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
    $singleRecipe = Recette::getRecipeById($conn, $numId);

    if(! $singleRecipe){
        echo "Aucune recette"; exit;
    }

    //get categories
    $categoryList = Categories::getCategory($conn, $singleRecipe->id, false);
    if(!empty($categoryList)){
        foreach($categoryList as $cat){
           $singleRecipe->category[]= $cat["id_categorie"];
        }
    }

    //get items
    $listeIngredients = Ingredients::getIngredients($conn, $singleRecipe->id);
  
    if (!empty($listeIngredients)) {
       
        foreach($listeIngredients as $ing){ 
            $singleRecipe->items[] = $ing["item"];
        }
    }
} else {
    ManageError::showErrorPage($type);
    exit; 
}

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
        $singleRecipe->category = [];
        foreach($_POST['cat'] as $cat){
            $singleRecipe->category[] = $cat;
        }
    }

   //put ingredients in array
   if(isset($_POST['ing'])){
       $singleRecipe->items = [];   
       $i=0;

       foreach ($_POST['ing'] as $ingredient){
        if($ingredient!= ""){
            $singleRecipe->items[] = $ingredient;
        $i++;
        }
       }
    } 

    if($singleRecipe->updateRecipe($conn)){
        $numId = intval($singleRecipe->id); 
        Url::redirect("/single-recette.php?id=$numId");
    } 
}
$allCategories = Categories::getAllCategories($conn);
?>

<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';   
  $errorMsg = "La recette n'existe pas ou la page a été supprimée";           
?>

</header>
<!--section recette-->
<main>
<section>
    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Modifier une recette</h2>
                <?php require 'includes/recette-form.php'; ?>
            </div>
        </div>
    </div>
</section>  
</main>
<?php require 'includes/footer.php'; ?>