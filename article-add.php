<?php
require 'includes/init.php';
Auth::requireAdmin();

$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';

/*variable for type of header*/
$type="admin";
$singleArticle = new Article();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $singleArticle->titre= $_POST['titre'];
    $singleArticle->texte = htmlentities($_POST['texte']);
    $singleArticle->pdate = $_POST['date'];
    $singleArticle->altImage = $_POST['altImage'];

    if($singleArticle->addArticle($conn)){
       $numId = intval($singleArticle->id); 
       Url::redirect("/single-blog.php?id=$numId");
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

<!--Add article-->
<main>
<section>
    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Ajouter un article</h2>
                <?php require 'includes/article-form.php'; ?>
            </div>
        </div>
    </div>
</section>  
</main>
<?php require 'includes/footer.php'; ?>