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
//if 'page' exist will use $_get['page'], if not, will use 1,4
$pagination = new Pagination($_GET['page'] ?? 1, 8, Article::countArticles($conn));

$articleArray = Article::getPage($conn, $pagination->limit, $pagination->offset);
$numberOfArticlesOnPage = $pagination->firstRecordOfPage + count($articleArray) - 1;
$numberOfArticles = Article::countArticles($conn);


$numberOfCards=0;
$feature = 'recette';
/*indicates wich type to feature in right navigation*/

?>
<!--section articles-->
<section>
    <div class="row1">
        <div class="main-content align-text-l">
        <h2 class="section-title">Bienvenue sur notre blog!</h2>
        <?php 
                    if ($log == "Quitter") :?>
                        <p><a href="article-add.php" class="admin-links">Ajouter un article</a> </p>
                    <?php endif; ?>
          <h3>Résultats <?=$pagination->firstRecordOfPage; ?> - <?=$numberOfArticlesOnPage ?> de <?= $numberOfArticles ?></h3><br>
         
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
                    
                    <div class="column33 mb-sm">
                        <div class="card-p0 shadow">
                          <article>
                            <a class="deco-none" href="single-blog.php?id=<?= $article['id']; ?>">
                            <div class="bg-image" id="<?= $idName ?>" title="<?= $article['altImage']; ?>"></div></a>
                            <div class="card-inner">
                                <p><h4><?= $article['titre']; ?></h4> </p>
                                <p class="p-blog-intro"><?= substr($article['texte'], 0, 50) . "... "; ?> <a class="footer-links" href="single-blog.php?id=<?= $article['id']; ?>">Lire</a></p>
                            </div>
                          </article>
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
  
    
    <nav class="main-content">
        <ul class="page-nav list-none pagination">
            <?php if($pagination->previous) : ?>
            <li><a href="?page=<?= $pagination->previous; ?>" class="page-nav-link"><i class="fas fa-chevron-left chevrons"></i> Page précédente</a></li>
            <?php else: ?>
            <li class="not-visible"><i class="fas fa-chevron-left chevrons"></i> Page précédente</li>
            <?php endif; ?>

            <?php if($pagination->next) : ?>
            <li><a href="?page=<?= $pagination->next; ?>" class="page-nav-link"> Page suivante <i class="fas fa-chevron-right chevrons"></i></a></li>
            <?php else: ?>
            <li class="not-visible">Page suivante <i class="fas fa-chevron-right chevrons"></i></li>
            <?php endif; ?>

        </ul>
        
      </nav>
    
  
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
