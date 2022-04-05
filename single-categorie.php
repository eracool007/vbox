<?php
ob_start();
require 'includes/init.php';
$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';

/*variable for type of header*/
$type = "single-categorie";
/*return page if error*/
$back = "recettes.php";
/*indicates wich type to feature in right navigation*/
$feature = 'blog';

$numberOfCards = 0;
?>
<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';
  ?>

</header>
<?php

$pagination = new Pagination($_GET['page'] ?? 1, 8, count($categoryItems));
$recipeArray = Recette::getPage($conn, $pagination->limit, $pagination->offset, $catId);
$numberOfRecipesOnPage = $pagination->firstRecordOfPage + count($recipeArray) - 1;
$numberOfRecipes = count($categoryItems);

?>
    <!--section Recettes de la-dite categorie-->
    <section>
    <div class="row1">
        <div class="main-content align-text-l">
        <?php if($log == "Quitter") : ?> 
                  <a class="admin-links" href="recette-add.php">Ajouter une recette</a>
        <?php endif; ?> 
        <h3 class="section-title">Résultats  <?=$pagination->firstRecordOfPage; ?> - <?=$numberOfRecipesOnPage ?> de <?= $numberOfRecipes ?></h3>
        </div>
    </div>
    <div class="row1">
        <div class="main-content">
            
            <!--recettes pour la categorie-->
            
            <div class="row1">
                <div
                class="col-left">
                    <!--<div class="main-content m-0">-->
                        <!--Debut carte recette-->
                        <?php
                         if (empty($recipeArray)){
                           $type="single-categorie-none";
                           ManageError::showErrorPage($type);
                           exit;
                             
                         } else{
                        $count = 1;
                        foreach($recipeArray as $categoryItem){
                            $numberOfCards++;
                          ?>
                            <div id="col-recette" class="column25 mb-sm">
                                <div class="card-p0b shadow">
                                    <a href="single-recette.php?id=<?= $categoryItem['id']; ?>"><div class="bg-image" id="img-recette<?= $count; ?>" title="<?= $categoryItem['altImage']; ?>"></div></a>
                                    <div class="card-inner">
                                        <p><h4><?= $categoryItem['titre']; ?></h4> </p>
                                        <p><h5><?= $categoryItem['pdate']; ?></h5></p>
                                    </div>
                                </div>
                            </div>
                        <?php $count++; }} ?>
                        <!--Fin carte recette-->
                       
                       
                    <!--</div>-->
                    
                </div>

                <!--fin col-left-->
                <!--section menu des categories-->
                <?php require 'includes/navigation-vertical.php'; ?>
            <!--fin column-right-->    
            <!--fin row1-->    
        </div>
    </div>
</section>  
<section>
  
  <nav class="main-content">
    <ul class="page-nav list-none pagination">
        
          <?php if($pagination->previous) : ?>
          <li><a href="?id=<?= $catId; ?>&page=<?= $pagination->previous; ?>" class="page-nav-link"><i class="fas fa-chevron-left chevrons"></i> Page précédente</a></li>
          <?php else: ?>
          <li class="not-visible"><i class="fas fa-chevron-left chevrons"></i> Page précédente</li>
          <?php endif; ?>

          <?php if($pagination->next) : ?>
          <li><a href="?id=<?= $catId; ?>&page=<?= $pagination->next; ?>" class="page-nav-link"> Page suivante <i class="fas fa-chevron-right chevrons"></i></a></li>
          <?php else: ?>
          <li class="not-visible">Page suivante <i class="fas fa-chevron-right chevrons hidden"></i></li>
          <?php endif; ?>
      
    </ul>
  </nav>
    
</section>
          
    
        <?php 
         if (!empty($categoryItems)){
        $count=0;
        foreach($categoryItems as $categoryItem){ 
                
          $count++;
          $idName = "img-recette" . strval($count) ?>
        <script>
          loadImage("<?= $categoryItem['imagef']; ?>", "img-recette<?= $count; ?>"); 

        </script>
    <?php } }?>
<?php require 'includes/footer.php'; ?>
<?php ob_end_flush(); ?>
  