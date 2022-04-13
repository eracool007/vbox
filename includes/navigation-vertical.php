<!--navigation-verticale-->
<aside class="col-right">
    <?php
    
    $featuredItem = Random::randomItem($conn, $feature);
    ($feature=="blog") ? $featureLink="single-blog.php" : $featureLink="single-recette.php";
    ?>
    
    <div class="cat-blog-box">

        <div class="cat-blog  align-text-c">
        <?php 
        if(!empty($featuredItem)){ ?>    
            <a href="<?= $featureLink;?>?id=<?= $featuredItem[0]['id']; ?>" >
            <img class="img-resp" src="images/assets/<?= $featuredItem[0]['imagef'] ?>" alt="<?= $featuredItem[0]['altImage']?>" title="<?= $featuredItem[0]['altImage']?>"></a>
            <div class="cat-blog-title">
                <?= $featuredItem[0]['titre'] ?> 
            </div>
        <?php } ?>
            <div class="align-text-l">
                <h4 aria-label="naviguer les recettes par catégorie" id="menu-cat-title">Naviguer les recettes par catégorie</h4>
                <nav>
                    <ul class="ul-cat">
                        <?php
                        if(!empty($categoryA)){ 

                            foreach($categoryA as $category){ ?>
                                <li class="li-cat">
                                    
                                    <a href="single-categorie.php?id=<?= $category['id_categorie']; ?>" class="a-cat">
                                        <?=  $category['nom_categorie']; ?>  
                                    </a> - <?php $number = Categories::countCategories($conn, $category['id_categorie']); 
                                    echo $number[0];?>
                                </li>
                            
                        <?php }} ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</aside>
<!--fin navigation-verticale-->

