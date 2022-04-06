<?php
require 'includes/init.php';
Auth::requireLogin();

$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';

$type="admin";
$errorMsg = "L'article ou la recette n'existe pas ou la page a été supprimée";  

if(isset($_GET['id'])){
    
    $numId = $_GET['id'];  
    settype($numId, 'integer');
    $singleRecette = Recette::getRecipeById($conn, $numId);

    if(! $singleRecette){
        echo "Aucune recette";
    }
} else {
        
        ManageError::showErrorPage($type);
        exit; 
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

    try {

        if(empty($_FILES)){
            throw new Exception('Fichier non valide.');
        }
        switch ($_FILES['file']['error']) {

        case UPLOAD_ERR_OK: 
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new Exception('Aucun fichier choisi.');
            break;
        case UPLOAD_ERR_INI_SIZE:
            throw new Exception('Le fichier est trop volumineux.');
        default: 
            throw new Exception('Il semble y avoir eu une erreur.');
        }
        //for file > 5mb
        if($_FILES['file']['size'] > 5000000) {
            throw new Exception('Fichier est trop volumineux');
        }
        //restrict type of mime types
        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];
        
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if(! in_array($mime_type, $mime_types)){
            throw new Exception('Mauvais format de fichier');
        }

        //move file and avoid certain characters
        $pathinfo = pathinfo($_FILES['file']['name']);
        $base = $pathinfo['filename'];

        //will replace a non accepted char for _
        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

        $base = mb_substr($base, 0, 200);

        //recreate the name with original file extension
        $filename= $base . "." . $pathinfo['extension'];

        $destination = "images/assets/$filename";

        //check if file exists and add suffix if it does
        $i = 1;
        while(file_exists($destination)){
            $filename= $base . "-$i." . $pathinfo['extension'];
            $destination = "images/assets/$filename";
            $i++;
        }

        if(move_uploaded_file($_FILES['file']['tmp_name'], $destination)){
           
           $previous_image = $singleRecette->imagef;
           
           if ($singleRecette->setImageFile($conn, $filename)){
               
                //remove old image
                //if(($previous_image) && ($previous_image !="")){
                  // unlink("images/assets/$previous_image"); 
                //}
                
                Url::redirect("/single-recette.php?id={$singleRecette->id}");
           }

        } else {
            echo $e->getMessage();
        }

    } catch (Exception $e){
        echo $e->getMessage();
    }
}




?>
<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';   
  $errorMsg = "Il semble y avoir une erreur";           
?>

</header>
<main>
<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Ajouter ou modifier l'image de la recette</h2>
                
                <?php if($singleRecette->imagef): ?>
                    <img class="edit-img" src="images/assets/<?= $singleRecette->imagef; ?>" alt="<?= $singleRecette->altImage; ?>">
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                    <div>
                        <label for="file">Fichier image</label>
                        <input type="file" name="file" id="file">
                    </div>
                    <button aria-label="Ajouter l'image">Ajouter</button>
                </form>

            <!--fin row1-->    
            </div>
        </div>
    </div>
</section>  
</main>

<?php require 'includes/footer.php'; ?>