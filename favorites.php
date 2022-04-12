<?php

require 'includes/init.php';
$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';

//check if user cookie
if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
   
    $idUser = ($_SESSION['user_id']);
    $favoris=Favorite::getUserFavorites($conn, $idUser);
 
} else {
    Url::redirect("/login.php");
    exit; 
}

?>
<header>
  <?php
  require 'includes/navigation.php';
  ?>
</header>

<main>

<?php if($admin) : ?>
  <div class="mt-100">
      <?php include 'includes/menu-admin.php'; ?>
  </div>   
<?php endif; ?>  
  
<!--Search page-->
<section class="height-set">
    <div class="row1">
        <div class="main-content align-text-l">
            <h2 class="section-title">Mes favoris: </h2>
        </div>

    </div>
    <div class="row1">
    <div class="main-content align-text-l">
    <table class="table">
        
        <tbody>
            <!--Debut -->
            <?php
                if (empty($favoris)){
                    
                    echo "<h3>Aucun favori enregistré</h3>";
            } else{
                
                foreach($favoris as $favori){
                  ?>
                    <tr>
                        
                        <td class="img-cell">
                            <a class="green-links" href="single-recette.php?id=<?= $favori['id']; ?>"><img class="sm-image" src="images/assets/<?= $favori['imagef']; ?>" alt="<?= $favori['altImage']; ?>" width="100" height="80" loading="lazy" decoding="async"></a>
                        </td>
                        
                        <td>
                            <a class="green-links" href="single-recette.php?id=<?= $favori['id']; ?>"><?= $favori['titre']; ?></a>
                            
                        </td>

                        <?php 
                        } 
                       ?>
                    </tr>
                    <?php }
                    ?>
        </tbody>
    </table>
    </div>
    <!--Fin -->
    </div>
</section>
</main>

<?php require 'includes/footer.php'; ?>