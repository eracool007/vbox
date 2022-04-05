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

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $singleArticle->titre= $_POST['titre'];
    $singleArticle->texte = htmlentities($_POST['texte']);
    $singleArticle->pdate = $_POST['date'];
    //$singleArticle->imagef = $_POST['image'];
    $singleArticle->altImage = $_POST['altImage'];

    if($singleArticle->updateArticle($conn)){
        
        Url::redirect("/single-blog.php?id=$singleArticle->id");
            
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
                <h2>Modifier un article</h2>
                <?php require 'includes/article-form.php'; ?>
            <!--fin row1-->    
            </div>
        </div>
    </div>
</section>  
</main>