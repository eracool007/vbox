<?php
require 'includes/init.php';
require 'includes/head.php';
$conn = require 'includes/db.php';


if(!isLoggedIn()){
    die("non autorise");
} else { }

/*variable for type of header*/
$type="admin";

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
<!--Add article-->
<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Ajouter un article</h2>
            <!--fin row1-->    
            </div>
    </div>
    </div>
    </section>  
    <script>loadImage("<?= $singleArticle[0]['image']; ?>", "blog-img"); </script>

<?php require 'includes/footer.php'; ?>