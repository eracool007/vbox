<?php
require 'includes/init.php';
require 'includes/head.php';
$conn = require 'includes/db.php';

/*variable for type of header*/
$type="blog";

/*indicates wich type to feature in right navigation*/
$feature = 'recette';

?>

<?php
if(isset($_GET['id'])){
    
    $numId = $_GET['id'];  
    settype($numId, 'integer');
    $singleArticle = GetRecord::getSelectedRecord($conn, "tb_article", $numId);

    $titre= $singleArticle[0]['titre'];
    $texte = $singleArticle[0]['texte'];
    $publishedDate = $singleArticle[0]['date'];
    $image = $singleArticle[0]['image'];
    $altImage = $singleArticle[0]['altImage'];
    
    } else {

        //ManageError::showErrorPage($type);
        //exit; 
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
  $errorMsg = "L'article n'existe pas ou la page a été supprimée";           
?>

</header>
<!--section articles-->
<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Modifier un article</h2>
                
                <?php require 'includes/article-form.php'; ?>

            <!--fin row1-->    
            </div>
    </div>
    </div>
    </section>  