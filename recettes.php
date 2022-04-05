<?php
require 'includes/init.php';
$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';
$type = "recette";
?>
<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';
  $vedette = Random::randomItem($conn, "recette");
  //$categories = new Categories($conn);
  $categories = Categories::getAllCategories($conn);
  
  ?>

</header>

    <!--section Recette vedette-->
    <section>
    <div class="row1">
        <div class="main-content align-text-l">
        <?php if($log == "Quitter") : ?> 
                  <a class="admin-links" href="recette-add.php">Ajouter une recette</a>
        <?php endif; ?> 
        <h2 class="section-title">Recette vedette</h2>
        </div>
    </div>
    <div class="row1">
        <div class="main-content double-box shadow">
        <div id="recette_vedette"
            class="column50 bg-medium vedette-left double-news-image"  title="<?= $vedette[0]['altImage'] ?>"
        ></div>

        <div class="column50 align-text-c vedette-right align-v">
            <div>
            <h3 class="titre-box"><?= $vedette[0]['titre']; ?></h3>
            <div class="row2">
            <p class="p-main">
            
            <?= substr($vedette[0]['description'], 0,110). '...'; ?>
            </p>
            </div>
            <div>
            <a class="deco_none" href="single-recette.php?id=<?= $vedette[0]['id'] ?>"><div class="btn btn-voir">Voir la recette</div></a>
</div>
        </div></div>
        </div>
    </div>
    </section>  
    <!--section des categories-->
    <section>
        <div class="row1">
          <div class="main-content align-text-l ">
            <h2 class="section-title">Categories</h2>
          </div>
        </div>
        <div class="row1">
          <div class="main-content">
             <!--Debut carte categorie-->
             <?php 
             for ($i = 0; $i < count($categories); $i++){ ?>

             <div class="column25 mb-sm">
              <div id="card-category" class="card-p0b shadow">
                <a href="single-categorie.php?id=<?= $categories[$i]['id_categorie']; ?>"><div class="bg-image" id="img-cat<?= $i; ?>" title="<?= $categories[$i]['altImage']; ?>"></div></a>
                <div class="card-inner">
                  <p><h4><?= $categories[$i]['nom_categorie']; ?></h4></p>
                </div>
              </div>
            </div>              
             <?php }
             ?>
             
            <!--Fin cartes recette-->
          </div>
        </div>
      </section>
      
      <script>loadImage("<?= $vedette[0]['imagef']; ?>", "recette_vedette"); </script>
      <?php 
        
        for ($i = 0; $i < count($categories); $i++){ ?>
       
        <script>
          loadImage("<?= $categories[$i]['imagef']; ?>", "img-cat<?= $i; ?>"); 
        </script>
          
        <?php } ?>
<?php require 'includes/footer.php'; ?>