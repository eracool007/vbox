<?php

require 'includes/init.php';
require 'includes/head.php';

Auth::requireLogin();

$conn = require 'includes/db.php';


/*variable for type of header*/
$type="admin";

$singleArticle = new Article();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $singleArticle->titre= $_POST['titre'];
    $singleArticle->texte = $_POST['texte'];
    $singleArticle->pdate = $_POST['date'];
    $singleArticle->imagef = $_POST['image'];
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
<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Ajouter un article</h2>
                
                <?php require 'includes/article-form.php'; ?>

            <!--fin row1-->    
            </div>
    </div>
    </div>
    </section>  
    

<?php require 'includes/footer.php'; ?>