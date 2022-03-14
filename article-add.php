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
$errors = [];

$titre='';
$texte= '';
$publishedDate = '';
$image = '';
$altImage = '';


$article = new Article();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $titre= $_POST['titre'];
    $texte = $_POST['texte'];
    $publishedDate = $_POST['date'];
    $image = $_POST['image'];
    $altImage = $_POST['altImage'];

    if($titre == ''){
        $errors[]= 'Titre requis';
    }

    if($texte == ''){
        $errors[] = 'Contenu requis';
    }

    if($publishedDate != ''){
        $date_time= date_create_from_format('Y-m-d H:i:s', $publishedDate);

        if($date_time === false){
            $error[] = 'Mauvais format de date';
        } else {
            $date_errors = date_get_last_errors();
            if($date_errors['warning_count'] > 0) {
                $error[] = 'Mauvais format de date';
            }
        }
    }

    if(empty($errors)){

        $article->titre = $_POST['titre'];
        $article->texte = $_POST['texte'];

        if ($article->date == ''){
            $article->date = null; 
        } else {
            $article->date = $_POST['date'];
        }
        
        $article->image = $_POST['image'];
        $article->altImage = $_POST['altImage'];
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