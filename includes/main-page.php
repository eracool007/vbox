<?php
$categories = [];
$numberOfCards = 3;
$featuredArticle = Article::getLatestArticle($conn);

$lastRecipies = array_slice(Recette::getAllRecipies($conn), 0, $numberOfCards);

?>
<!--main page-->
<section>
      <!--section nouvelles de notre blog-->
      <?php if(!empty($featuredArticle)) { ?>
        <div class="row1">
          <div class="main-content align-text-l">
            <h2 class="section-title">Nouvelles de notre blog</h2>
          </div>
        </div>
        <div class="row1">
          
            <div class="main-content double-box">
              <div id="featured_article_image"
                class="column50 bg-medium double-left double-news-image shadow" title="<?= $featuredArticle->altImage; ?>"></div>

              <div id="featured_article_preview" class="column50 align-text-c double-right shadow align-v">
                <div>
                <h3><?= $featuredArticle->titre; ?></h3>
                <div class="row2">
                  <p class="p-main">
                    <?= substr($featuredArticle->texte, 0, 110).'...'; ?>
                  </p>
                </div>
                <a class="deco_none" href="single-blog.php?id=<?= $featuredArticle->id; ?>"><div class="btn btn-lire"> Lire l'article</div></a>
              </div></div>
            </div>
        </div>
      <?php } ?>
    </section>

    <!--section dernieres recettes-->
    <?php if(!empty($lastRecipies)) { ?>
      <section>
        <div id="last-recipes" class="row1 mt-100">
          <div class="main-content align-text-l ">
            <h2 class="section-title">Dernières recettes</h2>
          </div>
        </div>
        <div class="row1">
          <div class="main-content">
            <!--Debut carte recette-->
            
            <?php 
            if(!empty($lastRecipies)){
              $count = 0;
              $countCat = 0;
              $cat="";

              foreach ($lastRecipies as $recipe) { 
              $idName="recipe".$count;
              $category= Categories::getCategory($conn, $recipe['id'], true);
              
              ?>

              <div class="column33">
                <div class="card-p0b shadow">
                  <a href="single-recette.php?id=<?= $recipe['id']; ?>">
                  <div class="bg-image" id="<?= $idName; ?>" title="<?= $recipe['altImage']; ?>"></div></a>
                  <div class="card-inner">
                    <p><h4><?= $recipe['titre']; ?></h4> </p>
                    <p><h5>
                          <a class="link_category" href="single-categorie.php?id=<?= $category[0]['id_categorie']?>">
                                <?= $category[0]['nom_categorie']; ?></a>
                        </h5></p>
                  </div>
                </div>
              </div>
            <?php $count++; }} ?>
            
            <!--Fin cartes recette-->
          </div>
        </div>
      </section>
      <!--main page-->
      <?php } ?>
    
    <?php if(!empty($featuredArticle)) { ?>
    <script>loadImage("<?= $featuredArticle->imagef; ?>", "featured_article_image")</script>
    <?php } ?>
    <?php 
      if(!empty($lastRecipies)) { 
        for ($i = 0; $i < $numberOfCards; $i++) { 
          $count=$i;
          $idName = "recipe" . strval($count) ?>

          <script>loadImage("<?= $lastRecipies[$i]['imagef']; ?>", <?= '"' . $idName . '"'; ?>); </script>

        <?php
        }
      } ?>
    
    