<?php
require 'includes/init.php';
require 'includes/head.php';
$conn = require 'includes/db.php';
$type="blog";
?>
    <header>
      <?php
      require 'includes/navigation.php';
      require 'includes/header-subpage.php';
      ?>
  
    </header>   
<?php
$articleArray = Article::getAllArticles($conn);
$numberOfArticles = count($articleArray);
$numberOfCards=0;
$feature = 'recette';
/*indicates wich type to feature in right navigation*/


$imgDirectory = 'blog';

?>
<!--section articles-->
<section>
    <div class="row1">
        <div class="main-content align-text-l">
        <h2 class="section-title">Bienvenue sur notre blog!</h2>
        <?php 
                    if ($log == "Quitter") :?>
                        <p><a href="article-add.php" class="footer-links">Ajouter un article</a> </p>
                    <?php endif; ?>
          <h3>Résultats 1-<?=$numberOfArticles ?> de <?= $numberOfArticles ?></h3><br>
         
        </div>
    </div>
    <div class="row1">
        <div class="main-content">

        <!--articles-->
          <div class="row1">
              <div class="col-left">
                <?php if(!empty($articleArray)) { 
                    foreach($articleArray as $article) {
                        $idName = "article" . $numberOfCards;
                           
                    ?>

                    <!--Debut carte-->
                    
                    <div class="column25 mb-sm">
                        <div class="card-p0 shadow">
                            <a class="deco-none" href="single-blog.php?id=<?= $article['id']; ?>">
                            <div class="bg-image" id="<?= $idName ?>" title="<?= $article['altImage']; ?>"></div></a>
                            <div class="card-inner">
                                <p><h4><?= $article['titre']; ?></h4> </p>
                                <p class="p-blog-intro"><?= substr($article['texte'], 0, 50) . "... "; ?> <a class="footer-links" href="single-blog.php?<?= $article['id']; ?>">Lire</a></p>
                            </div>
                        </div>
                    </div>

                <?php
                    $numberOfCards++; 
                    } 
                    
                } ?>
                
                 
              </div>
            

          <!--fin col-left-->
          <!--section menu des categories-->
          <?php
          
          require 'includes/navigation-vertical.php';
          ?>
          <!--fin column-right-->    
          <!--fin row1-->    
          </div>

    </div>
  </div>
</section>  

<section>
  <div class="main-content">
    <!-- <div class="row1">

      <div class="page-nav">
        <a href="#" class="page-nav-link"><i class="fas fa-chevron-left chevrons"></i> Page précédente</a>
        <a href="#" class="page-nav-link"> Page suivante <i class="fas fa-chevron-right chevrons"></i></a>
      </div>
    </div> -->
  </div>
</section>


<?php 
      if(!empty($articleArray)) { 
        for ($i = 0; $i < $numberOfCards; $i++) { 
          $count=$i;
          $idName = "article" . strval($count) ?>

          <script>loadImage("<?= $articleArray[$i]['imagef']; ?>", <?= '"' . $idName . '"'; ?>); </script>

        <?php
        }
      } ?>



<?php
require 'includes/footer.php';
?>
