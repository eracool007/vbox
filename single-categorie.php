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
$pagination = new Pagination($_GET['page'] ?? 1, 6, count($categoryItems));
$recipeArray = Recette::getPage($conn, $pagination->limit, $pagination->offset, $catId);
$numberOfRecipesOnPage = $pagination->firstRecordOfPage + count($recipeArray) - 1;
$numberOfRecipes = count($categoryItems);
?>

<!--Recettes de la-dite categorie-->
<main>
  <?php if($admin){ 
    include 'includes/menu-admin.php';
    }
  ?>
<section>
  <div class="row1">
      <div class="main-content align-text-l">
      <h3 class="section-title">Résultats  <?=$pagination->firstRecordOfPage; ?> - <?=$numberOfRecipesOnPage ?> de <?= $numberOfRecipes ?></h3>
      </div>
  </div>
  <div class="row1">
      <div class="main-content">
          <!--recettes pour la categorie-->
          <div class="row1">
              <div
              class="col-left">
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
                          <div class="column25 col-recette mb-sm">
                              <div class="card-p0b shadow">
                                  <a href="single-recette.php?id=<?= $categoryItem['id']; ?>"><div class="bg-image" id="img-recette<?= $count; ?>" title="<?= $categoryItem['altImage']; ?>"></div></a>
                                  <div class="card-inner">
                                      <p><h4 role="heading" aria-level="3"><?= $categoryItem['titre']; ?></h4> </p>
                                      <p><h5 aria-description="date ajoutée"><?= $categoryItem['pdate']; ?></h5></p>
                                  </div>
                              </div>
                          </div>
                      <?php $count++; }} ?>
                      <!--Fin carte recette-->
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
</main>
<?php 
  if (!empty($recipeArray)){
$count=0;
foreach($recipeArray as $recipeArray){ 
        
  $count++;
  $idName = "img-recette" . strval($count) ?>
<script>
  loadImage("<?= $recipeArray['imagef']; ?>", "img-recette<?= $count; ?>"); 

</script>
<?php } }?>
<?php require 'includes/footer.php'; ?>
<?php ob_end_flush(); ?>
  