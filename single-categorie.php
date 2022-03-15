<?php
ob_start();
require 'includes/init.php';
require 'includes/head.php';
$conn = require 'includes/db.php';

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


?>
    <!--section Recettes de la-dite categorie-->
    <section>
    <div class="row1">
        <div class="main-content align-text-l">
        <h2 class="section-title">Resultats 1-12 de 25</h2>
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
                         if (empty($categoryItems)){
                           $type="single-categorie-none";
                           ManageError::showErrorPage($type);
                           exit;
                             
                         } else{
                        $count = 1;
                        foreach($categoryItems as $categoryItem){
                            $numberOfCards++;
                          ?>
                            <div class="column25 mb-sm">
                                <div class="card-p0 shadow">
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
      <div class="main-content">
        <div class="row1">
          <div class="page-nav">
            <a href="#" class="page-nav-link"><i class="fas fa-chevron-left chevrons"></i> Page précédente</a>
            <a href="#" class="page-nav-link"> Page suivante <i class="fas fa-chevron-right chevrons"></i></a>
          </div>
        </div>
      </div>
      
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
  