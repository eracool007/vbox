<?php
require 'includes/init.php';
require 'includes/head.php';
$conn = require 'includes/db.php';

/*variable for type of header*/
$type="blog";

/*indicates wich type to feature in right navigation*/
$feature = 'recette';

?>
<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';   
  $errorMsg = "L'article n'existe pas ou la page a été supprimée";           
?>

</header>
<?php
if(isset($_GET['id'])){
    
    $numId = $_GET['id'];  
    settype($numId, 'integer');
    $singleArticle = GetRecord::getSelectedRecord($conn, "tb_article", $numId);
    

    } else {

        ManageError::showErrorPage($type);
        exit; 
    }

    if (empty($singleArticle)){
        ManageError::showErrorPage($type);
        exit; 
    }

?>

<!--section articles-->
<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <div
                class="col-left">
                    <div id="blog-img" class="bg-image-blog" title="<?= $singleArticle[0]['altImage']?>"></div>
                    <h2 class="section-title pb-0"><?= $singleArticle[0]['titre']?></h2>
                    <!--Article complet-->
                    <p class="date"><?= $singleArticle[0]['date']?></p>
                    <p class="p-single">
                        <?= $singleArticle[0]['texte']?>
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
    <script>loadImage("<?= $singleArticle[0]['image']; ?>", "blog-img"); </script>

<?php require 'includes/footer.php'; ?>