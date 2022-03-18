<?php
ob_start();
require 'includes/init.php';
require 'includes/head.php';
$conn = require 'includes/db.php';

/*variable for type of header*/
$type = "recette";

/*return page if error*/
$back = "recettes.php";

?>
<header>
  <?php
  require 'includes/navigation.php';
  ?>
</header>
<?php
 


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
    <main>
      <section>
        <div class="row1">
          <div class="main-content">
            <!--Details de la recette-->

            <div class="row1">
              <div id="recipe-main" title="<?= $singleRecette->altImage; ?>" class="col-left-cat">
             
                  <h1 class="main-title-recipe"><?= $singleRecette->titre; ?></h1>
                  <p class="recipe-info">
                    Préparation:   <?= $singleRecette->preparation; ?> min.<br>
                    Cuisson:   <?= $singleRecette->cuisson; ?> min.<br>
                    Portions:   <?= $singleRecette->portion; ?>
                  </p>
                
                <div class="social">
                  <div class="align-text-l social-icons">
                    <div class="social-box pinterest align-v">
                      <i class="fab fa-pinterest-p"></i>
                    </div>
                    <div class="social-box facebook align-v">
                      <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-box messenger align-v">
                      <i class="fab fa-facebook-messenger"></i>
                    </div>
                    <div class="social-box twitter align-v">
                      <i class="fab fa-twitter"></i>
                    </div>
                    <div class="social-box envelope align-v">
                      <i class="fas fa-envelope"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!--fin column-left-->
              <!--section menu des categories-->
              <aside class="col-right-cat">
                <div class="cat-sidebar-title">
                  <h5 class="fix-margin">CATÉGORIES</h5>
                </div>
                <div class="cat-box-holder">
                  <?php
                  foreach($categoryList as $cat) { ?>
                      <div class="cat-item">
                        <a class="a-cat-single" href="single-categorie.php?id=<?= $cat['id_categorie']?>"><?= $cat['nom_categorie']; ?></a>
                      </div>
                  <?php } ?>
                 </div>
                <div class="print">
                    <i class="fas fa-print"></i>
                </div>
              </aside>
            </div>
            <!--Description recette-->
            <section>
              <div class="row1">
                <h3 class="h3-sm">DESCRIPTION</h3>
                <p class="p-single">
                <?= $singleRecette->description; ?>
                </p>
            </div>
              
            </section>

            <section class="mt-0">
                <div class="row1">
                  <h3 class="h3-sm">INGREDIENTS</h3>
                  <ul class="ingredients">
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
                  </ul>

                <div class="ingredients mt-0">
                    &#8595;
                    <div class="add-to-list">
                        Ajouter à ma liste d'épicerie
                    </div>
                </div>     
              </div>
              </section>

            <section class="mt-0">
              <div class="row1">
                <h3 class="h3-sm">PREPARATION</h3>
                <p class="p-single">
                <?= $singleRecette->instructions; ?>
              </p>
            
            </div>
            </section>

            <?php 
            if($singleRecette->notes && $singleRecette->notes != ""){ ?>
              <section class="mt-0">
                <div class="bg-light-yellow">
                    <div class="row1 p-sm">
                    <h3 class="h3-sm">NOTES</h3>
                    <p class="p-single p-sm">
                    <?= $singleRecette->notes; ?>
                    </p>
                    </div>
                </div>
              </section>
            <?php } ?>
            
          </div>
        </div>
      </section>
  
      <script>loadImage("<?= $singleRecette->imagef; ?>", "recipe-main"); </script>

<?php require 'includes/footer.php'; ?>
<?php ob_end_flush(); ?>