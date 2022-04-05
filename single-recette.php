<?php
ob_start();
require 'includes/init.php';
$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';

/*variable for type of header*/
$type = "recette";
/*return page if error*/
$back = "recettes.php";

?>
<header>
  <?php
  require 'includes/navigation.php';
  ?>
</header>
<?php
  //check for valid url
  $url="";
  $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
  $url = $base_url . $_SERVER["REQUEST_URI"];

  $categoryList = Categories::getCategory($conn, $singleRecette->id, false);
  ?>
  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_CA/sdk.js#xfbml=1&version=v13.0" nonce="4FGfHdDn"></script>

      <main class="top">
          <div class="row1">
            <div class="main-content">
              <!--Details de la recette-->

              <div class="row1">
                <div id="recipe-main" title="<?= $singleRecette->altImage; ?>" class="col-left-cat">
              
                    <h1 class="main-title-recipe"><?= $singleRecette->titre; ?></h1>
                    <img src="images/assets/<?= $singleRecette->imagef; ?>" id="main-image">
                    <p class="recipe-info">
                      Préparation:   <?= $singleRecette->preparation; ?> min.<br>
                      Cuisson:   <?= $singleRecette->cuisson; ?> min.<br>
                      Portions:   <?= $singleRecette->portion; ?>
                    </p>
                  
                  <div class="social">
                    
                    <div id="pinterest" class="align-text-l social-icons">
                        <div class="social-box pinterest align-v">
                          <a class="share" href="https://pinterest.com/pin/create/button/?url=<?= urlencode($url);?>">
                          <i class="fab fa-pinterest-p"></i> </a>
                          
                        </div>
                        <div data-href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($url);?>&amp;src=sdkpreparse" data-layout="button" data-size="small" id="facebook" class="social-box facebook align-v">
                          <a  class="share" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($url);?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"> 
                          <i class="fab fa-facebook-f"></i></a>
                        </div>
                      
                        <!-- class="fb-xfbml-parse-ignore" -->
                        <div id="linkedin" class="social-box linkedin align-v">
                          <a class="share" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($url);?>">
                            <i class="fab fa-linkedin"></i></a>
                        </div>
                        <div id="twitter" class="social-box twitter align-v">
                        >"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div id="mail" class="social-box envelope align-v">
                          <i class="fas fa-envelope"></i>
                        </div>
                      
                    </div>
                    <div class="partager">Partager cette recette!

                    </div>
                  </div>
                  
                </div>
        
                <!--fin column-left-->
                <!--section menu des categories-->
                <aside class="col-right-cat">
                  <div class="cat-sidebar-title">
                    <h5 class="fix-margin">CATÉGORIES</h5>
                  </div>
                  <div class="cat-box-holder">
                    <?php
                    foreach($categoryList as $cat) { ?>
                        <div class="cat-item">
                          <a class="a-cat-single" href="single-categorie.php?id=<?= $cat['id_categorie']?>"><?= $cat['nom_categorie']; ?></a>
                        </div>
                    <?php } ?>
                  </div>
                  <div class="print">
                    <button type="button" class="btn-print" onClick="window.print();">
                      <i class="fas fa-print fa-lg"></i>
                    </button>
                  </div>
                </aside>
              </div>
              
              <!--Email modal-->
              <div id="myModal" class="modal">
                <div class="modal-content">
                  <span class="close">&times;</span>
                  <p>Veuillez indiquer le courriel pour envoyer la recette: </p>
                  <form id="email-form" method="post" action="single-recette.php?id=<?= $singleRecette->id; ?>" enctype="multipart/form-data">
                    <input type="email" id="mailrecipe" name="mailrecipe">
                    <button type="button" id="send" name="send">Envoyer</button>
                    </form>
                </div>
              </div>   
                  
              
             
              <!--Description recette-->
              <section id="description">
                <div class="row1">
                  <?php if($log == "Quitter") : ?> 
                    <a class="admin-links" href="recette-edit.php?id=<?= $singleRecette->id; ?>">Modifier</a>&nbsp;|&nbsp;<a class="admin-links" href="recette-delete.php?id=<?= $singleRecette->id; ?>">Supprimer</a>&nbsp;|&nbsp;<a class="admin-links" href="recette-image-edit.php?id=<?= $singleRecette->id; ?>">Modifier l'image</a> 
                  <?php endif; ?> 
                  
                  <h3 class="h3-sm">DESCRIPTION</h3>
                  <p class="p-single">
                  <?= html_entity_decode($singleRecette->description); ?>
                  </p>
              </div>
             
              </section>

              <!--Ingredients-->
              <section class="mt-0">
                  <div class="row1">
                    <h3 class="h3-sm">INGREDIENTS</h3>
                    <form action="single-recette.php?id=<?= $singleRecette->id ?>&action=add" method="post">
                    <ul class="ingredients">
                      <?php
                      $listeIngredients = Ingredients::getIngredients($conn, $singleRecette->id);
                      if (!empty($listeIngredients)) {
                        
                        foreach($listeIngredients as $ing){ 
                          ?>
                          <li class="ing">
                          <input type="checkbox" id="ing<?= $ing['id']; ?>" name="ingredient<?= $ing['id']; ?>" value="<?= $ing['item']; ?>">
                          <label for="ingredient<?= $ing['id']; ?>"> <?= $ing['item']; ?>
                          
                        </label>
                          
                          </li>
                          <?php
                        }
                      } else { 
                          echo "Aucun ingrédient mentionné."; 
                      } ?>
                    </ul>
                    

                  <div class="ingredients mt-0" id="add-to-list">
                      &#8595;
                      <div class="add-to-list">
                          <button class="btn-add" id="add-btn" type="submit">Ajouter à ma liste d'épicerie</button>
                      </div>
                  </div> 
                </form>    
                </div>
              </section>
              
              <!--Add to cart modal-->
              <div id="myModal2" class="modal">
                <div class="modal-content">
                  <span class="close2">&times;</span>
                  <h2 class="align-text-c">Les ingrédients sélectionnés ont été ajoutés à votre liste d'épicerie!</h2>
                  <p class="align-text-c"><img src="images/help/cart.png" width="175"alt="Panier pour liste d'épicerie"></p><p class="align-text-c"><br>Pour accéder à votre liste et l'imprimer, cliquer sur le panier dans le menu du haut de la page.</p>
                  
                  
                </div>
              </div>  
              
              <!--Preparation-->
              <section class="mt-0" id="preparation">
                <div class="row1">
                  <h3 class="h3-sm">PREPARATION</h3>
                  <p class="p-single">
                  <?= html_entity_decode($singleRecette->instructions); ?>
                </p>
              
              </div>
              </section>
             
              <!--Notes-->
              <?php 
              if($singleRecette->notes && $singleRecette->notes != "" && $singleRecette->notes != " "){ ?>
                <section class="mt-0">
                  <div class="bg-light-yellow">
                      <div class="row1 p-sm">
                      <h3 class="h3-sm">NOTES</h3>
                      <p class="p-single p-sm">
                      <?= html_entity_decode($singleRecette->notes); ?>
                      </p>
                      </div>
                  </div>
                </section>
              <?php } ?>
              
            </div>
          </div>
        
  <?php
    if(isset($_POST['mailrecipe'])){
      require 'includes/email-recipe.php';
    }
  ?>
      <script>loadImage("<?= $singleRecette->imagef; ?>", "recipe-main"); </script>
    
    <?php require 'includes/footer.php'; ?>
    
<?php ob_end_flush(); ?>