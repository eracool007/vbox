<?php
require 'includes/init.php';
Auth::requireLogin();

$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';


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
        
        Url::redirect("/blog.php");
        
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

<main>
<section>
    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Supprimer un article</h2>
                <form method="post">
                    <p>Voulez-vous vraiment supprimer l'article?</p>
                    <button aria-label="supprimer l'article">Supprimer</button> 
                    <a href="single-blog.php?id=<?= $singleArticle->id; ?>" class="footer-links"> Annuler</a>
                </form>
                <!--fin row1-->    
            </div>
        </div>
    </div>
</section>  
</main>
<?php require 'includes/footer.php'; ?>