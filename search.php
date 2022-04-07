<?php

require 'includes/init.php';
$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';

if(isset($_POST['search']) && ($_POST['search'] != "")){
    $searchString = $_POST['search'];
    $results=SearchDb::search($conn, $searchString);
 
} else {
    header("Location: index.php");
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
            <h2 class="section-title">Résultats de recherche pour: <em><?= $searchString;?> </em></h2>
        </div>

    </div>
    <div class="row1">
    <div class="main-content align-text-l">
    <table class="table">
        
        <tbody>
            <!--Debut -->
            <?php
                if (empty($results)){
                echo "<h3>Aucun résultat</h3>";
                
            } else{
                
                $count = 1;
                foreach($results as $resultat){
                    
                    ($resultat['recette'] == "recette") ? $recette=true : $recette=false;
                    ?>
                    <tr>
                        <td class="img-cell">
                            <?php if($recette) : ?>

                                <a class="green-links" href="single-recette.php?id=<?= $resultat['id']; ?>"><img class="sm-image" src="images/assets/<?= $resultat['imagef']; ?>" alt="<?= $resultat['altImage']; ?>" width="100" height="80" loading="lazy" decoding="async"></a>

                            <?php else : ?>
                                <a class="green-links" href="single-blog.php?id=<?= $resultat['id']; ?>"><img class="sm-image" src="images/assets/<?= $resultat['imagef']; ?>" alt="<?= $resultat['altImage']; ?>" width="100" height="80" loading="lazy" decoding="async"></a>
                                    
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($recette) : ?>

                                <a class="green-links" href="single-recette.php?id=<?= $resultat['id']; ?>"><?= $resultat['titre']; ?></a>
                                <p class="type">Recette</p>

                            <?php else : ?>
                                <a class="green-links" href="single-blog.php?id=<?= $resultat['id']; ?>"><?= $resultat['titre']; ?></a>
                                <p class="type">Article de blog </p>
                            <?php endif; ?>
                        </td>

                        <?php 
                        } 
                        $count++; ?>
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