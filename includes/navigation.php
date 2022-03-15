<?php
      $categoryArray = new Categories($conn);
      $categoryA=$categoryArray->allCategoriesArray;
?>
<div class="fixed-top">
      <div class="row1 bg-dark">
        <div class="main-content">
          <div class="column50 align-text-l logo-big">
            <a href="index.php" class="logo-link">V-Box<i class="fas fa-leaf logo-leaf-big"></i></a>
          </div>
          <div class="column50 align-text-r account">
            <i class="fas fa-user account-icon"></i> <a href="<?= $logLink; ?>" class="login"><?= $log ?></a>
            <!-- <?php if($log == "Quitter") : ?>  | <a class="login" href="/vbox/admin/">Gérer</a><?php endif; ?> -->
          </div>
        </div>
      </div>

      <div class="row1 bg-medium">
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
                <li><a href="about.php">À propos</a></li>
                <li><a href="about.php#contact">Contact</a></li>
              </ul>
            </nav>
          </div>
          <div class="column25 align-text-r">
            <div class="row1">
              <div class="columnFull">
                <div class="search-container align-text-r">
                  <input
                    type="text"
                    class="search"
                    placeholder="Rechercher"
                    aria-label="rechercher"
                  />
                </div>
              </div>
              <div class="search-icon-container">
                <i class="fas fa-search"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      