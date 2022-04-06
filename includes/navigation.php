<?php
     $categoryA=Categories::getAllCategories($conn);
     
?>
<!--navigation-->
<div class="fixed-top">
      <div class="row1 bg-dark">
        <div class="main-content">
          <div class="column50 align-text-l logo-big">
            <a href="index.php" class="logo-link">V-Box<i class="fas fa-leaf logo-leaf-big"></i></a>
          </div>
          <div class="column50 align-text-r account">
            <span id="account">
            <i class="fas fa-user account-icon"></i> <a href="<?= $logLink; ?>"  class="login"><?= $log ?></a>
            <?php if(!$cart || empty($cart)): ?>
            </span>
            <?php endif; ?>
            <?php if($cart && !empty($cart)): ?> |</span> <a href="index.php?shopping=1" class="login"><i class="fa-solid fa-cart-shopping account-icon"></i> </a>
            <?php endif; ?> 
            
          </div>
        </div>
      </div>

      <div class="row1 bg-medium" id="barre-grise">
        <div class="main-content">
          <div class="column75 align-text-l main-menu">
            <nav class="nav-bar-links">
              <ul id="main-menu-list">
                <li><a href="recettes.php">Recettes <i class="fas fa-caret-down"></i></a>
                  <ul>
                    <div class="sub-nav">
                        <?php if (!empty($categoryA)) { 
                            foreach ($categoryA as $category){?>
                                <div class="div-nav">
                                  <li class="sub-nav-li">
                                    <a href="single-categorie.php?id= <?= $category['id_categorie']; ?>" class="a-cat">
                                   <?= $category['nom_categorie']; ?> </a>
                                  </li>
                                </div>  
                        <?php } }?>
                    </div>
                  </ul>
                </li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="index.php?page=about">À propos</a></li>
                <!-- <li><a href="about.php#contact">Contact</a></li> -->
              </ul>
            </nav>
          </div>
          <div class="columnSearch">
            <div class="search-row">
              <form method="post" action="search.php">
                <div class="search-container">
                  <input type="text" class="search" name="search" placeholder="Rechercher" aria-label="rechercher"/>
                </div>
                <div class="search-icon-container">
                  <button role="button" aria-label="chercher" class="btn-search"><i class="fas fa-search"></i>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      <!--fin navigation-->
      
      <label for="mailing">
              <input class="cta-input" type="email" name="mailing" id="mailing" placeholder="Courriel"><button role="button" aria-label="envoyer mon adresse courriel" class="btn-mailing"><i class="fas fa-paper-plane"></i></button></label>