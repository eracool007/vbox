<?php

require 'includes/init.php';
require 'includes/head.php';
if(!isLoggedIn()){
    die("non autorise");
}
$conn = require 'includes/db.php';

/*variable for type of header*/
$type="admin";

?>

<?php
if(isset($_GET['id'])){
    
    $numId = $_GET['id'];  
    settype($numId, 'integer');
    $singleArticle = Article::getArticleById($conn, $numId);

    if(! $singleArticle){
        echo "aucun article";
    }
} else {
        
        ManageError::showErrorPage($type);
        exit; 
}

if($_SERVER["REQUEST_METHOD"] =="POST"){
    
    if ($singleArticle->deleteArticle($conn)){
        
        header("location: blog.php");
    }
}
?>

<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';   
  $errorMsg = "L'article n'existe pas ou la page a été supprimée";           
?>

</header>
<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Supprimer un article</h2>
                <form method="post">
                    <p>Voulez-vous vraiment supprimer l'article?</p>
                    <button>Supprimer</button> 
                    <a href="single-blog.php?id=<?= $singleArticle->id; ?>" class="footer-links"> Annuler</a>
                </form>

            <!--fin row1-->    
            </div>
        </div>
    </div>
</section>  
<?php require 'includes/footer.php'; ?>