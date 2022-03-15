<?php
require '../includes/init.php';
require '../includes/head.php';
Auth::requireLogin();

$conn = require '../includes/db.php';

?>
    <header>
      <?php
      require '../includes/navigation.php';
      
      ?>
  
    </header>

    <?php
$articleArray = Article::getAllArticles($conn);
$numberOfArticles= 0;
$imgDirectory = 'blog';

?>
<!--section articles-->
<section>
    <div class="row1">
        <div class="main-content align-text-l">
        <h2 class="section-title">Administration</h2>
        <?php 
          if ($log == "Quitter") { ?>
              <p><a href="article-add.php" class="footer-links">Ajouter un article</a> </p>
          <?php } ?>
          <?php if (empty($articleArray)){ ?>
            Aucun article disponible
          <?php } else {  ?>
         
        </div>
    </div>
    <div class="row1">
        <div class="main-content">

        <!--articles-->
          <div class="row1">
              <div class="main-content align-text-l">
                 <!--Table start-->
                    
                 <table>
                        <thead>
                          <th>Title</th>
                        </thead>
                        <tbody>
                        <?php if(!empty($articleArray)) { 
                            foreach($articleArray as $article) {
                               ?>
                            <tr>
                              <td>
                          
                                    <a class="deco-none" href="single-blog.php?id=<?= $article['id']; ?>">
                                    <?= htmlspecialchars($article['titre']); ?>
                                    </div>
                              </td>
                            </tr>  
                          </table>

                          <?php $numberOfArticles++; } ?>
                          </tbody>
                    
                        <?php } } ?>
                
                 
              </div>
            

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
        for ($i = 0; $i < $numberOfArticles; $i++) { 
          $count=$i;
          $idName = "article" . strval($count) ?>

          <script>loadImage("<?= $articleArray[$i]['imagef']; ?>", <?= '"' . $idName . '"'; ?>); </script>

        <?php
        }
      } 
    
     ?>

 <!--Footer-->
 
      
  </body>
  
  
</html>