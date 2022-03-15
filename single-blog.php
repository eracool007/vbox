<?php
require 'includes/init.php';
require 'includes/head.php';
$conn = require 'includes/db.php';

/*variable for type of header*/
$type="blog";

/*indicates wich type to feature in right navigation*/
$feature = 'recette';
$errorMsg = "L'article n'existe pas ou la page a été supprimée";  
?>


</header>
<?php
if(isset($_GET['id'])){
    
    $numId = $_GET['id'];  
    settype($numId, 'integer');
    $singleArticle = Article::getArticleById($conn, $numId);
    

    } else {

        ManageError::showErrorPage($type);
        exit; 
    }

    if (empty($singleArticle)){
        ManageError::showErrorPage($type);
        exit; 
    }

?>
<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';   
           
?>
<!--section articles-->
<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <div
                class="col-left">
                    <div id="blog-img" class="bg-image-blog" title="<?= htmlspecialchars($singleArticle->altImage); ?>"></div>
                    <h2 class="section-title pb-0"><?= htmlspecialchars($singleArticle->titre); ?></h2>
                    <?php 
                    if ($log == "Quitter") :?>
                        <a href="article-edit.php?id=<?= $singleArticle->id; ?>" class="footer-links">Modifier</a> | <a href="article-delete.php?id=<?= $singleArticle->id; ?>" class="footer-links"> Supprimer</a>
                    <?php endif; ?>
                    <!--Article complet-->
                    <p class="date"><?= $singleArticle->pdate; ?></p>
                    <p class="p-single">
                        <?= htmlspecialchars($singleArticle->texte);?>
                    </p>
                </div>
                <!--fin col-left-->
                <!--section menu des categories-->

                <?php 
                
                require 'includes/navigation-vertical.php'; ?>
            <!--fin column-right-->    
            <!--fin row1-->    
            </div>
    </div>
    </div>
    </section>  
    <script>loadImage("<?= $singleArticle->imagef; ?>", "blog-img"); </script>

<?php require 'includes/footer.php'; ?>