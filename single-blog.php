<?php
require 'includes/init.php';
$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';


/*variable for type of header*/
$type="blog";

/*indicates wich type to feature in right navigation*/
$feature = 'recette';
$errorMsg = "L'article n'existe pas ou la page a été supprimée";  
?>


</header>

<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';   
           
?>
<!--section articles-->
<main>
<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <div class="col-left">
                    <div id="blog-img" class="bg-image-blog" title="<?= htmlspecialchars($singleArticle->altImage); ?>"></div>
                    <h2 class="section-title pb-0"><?= htmlspecialchars($singleArticle->titre); ?></h2>
                    <?php 
                    if ($admin) :?>
                        <a href="article-edit.php?id=<?= $singleArticle->id; ?>" class="admin-links">Modifier</a>&nbsp;|&nbsp;<a href="article-delete.php?id=<?= $singleArticle->id; ?>" class="admin-links"> Supprimer</a>&nbsp;|&nbsp;<a href="article-image-edit.php?id=<?= $singleArticle->id; ?>" class="admin-links">Modifier image</a>
                    <?php endif; ?>
                    <!--Article complet-->
                    <p class="date"><?= $singleArticle->pdate; ?></p>
                    <p class="p-single">
                        <?= html_entity_decode($singleArticle->texte);?>
                    </p>
                </div>
                <!--fin col-left-->
                <!--section menu des categories-->
                <?php require 'includes/navigation-vertical.php'; ?>
            <!--fin column-right-->    
            <!--fin row1-->    
            </div>
        </div>
    </div>
</section> 
</main> 
    <script>loadImage("<?= $singleArticle->imagef; ?>", "blog-img"); </script>

<?php require 'includes/footer.php'; ?>