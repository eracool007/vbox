<?php
$tools = ['HTML', 'CSS', 'Javascript', 'Programmation orientée objet', 'PHP', 'MySql', 'phpMyAdmin', 'CPanel', 'GitHub', 'Laragon', 'HeidiSql', 'Adobe XD', 'Photoshop'];
?>
<!--About page-->
<section class="mt-100">
    <!--About-->
    <div class="row1">
        <div class="main-content align-text-l">
        <h2 class="section-title">À propos de ce projet</h2>

        <p class="p-about">
            Bienvenue sur le site fictif créé dans le cadre de ma formation en développement web du Cégep de St-Félicien! 
        </p>
        <p class="p-about">
            Ce projet est le travail final du programme. Ce dernier se devait d'être un outil complet et utilisable tout en répondant aux exigences suivantes: 

            <ul class= "fa-ul mb-sm">
                <li class="list-about"><span class="fa-li bullseye"><i class="fa-solid fa-bullseye"></i></span>Le site devait communiquer avec la base de données afin d’afficher et/ou sauvegarder les données.</li>
                <li class="list-about"><span class="fa-li bullseye"><i class="fa-solid fa-bullseye"></i></span>Le site devait être adapté pour les appareils mobiles.</li>                
                <li class="list-about"><span class="fa-li bullseye"><i class="fa-solid fa-bullseye"></i></span>Les fichiers devaient être optimisés.</li>                
                <li class="list-about"><span class="fa-li bullseye"><i class="fa-solid fa-bullseye"></i></span>Le site devait être le plus accessible possible. </li>
            </ul>
        </p>
        <p class="p-about">
            Afin d'intégrer et d'ainsi mettre en pratique le plus d'éléments que possible dans le temps alloué, j'ai décidé de créer un site pour un organisme à but non lucratif fictif ayant pour mission de promouvoir l’alimentation saine et sans produit animalier. En proposant des articles de blogs et des recettes simples, le but de cet organisme aurait été de rendre la cuisine végétarienne accessible à tous. 
        </p>
         <p class="p-about"><em>*Le nom de V-Box est un diminutif embelli inspiré des mots <q>Boîte à recettes véganes</q>.</em></p>
        
        
        <!--Site fonctionnalities-->
        <h3 class="about-subtitle">Aperçu général des fonctionnalités du site:</h3>
        <div class="collapse-box">
        <button class="collapse"><span class="bullseye"><i class="fa-solid fa-bullseye"></i></span><span class="btn-about">Page d'accueil</span></button>
        <div class="panel">
                <p class="p-about">La page d'accueil du site présente le dernier article ainsi que les 3 dernières recettes ajoutées sur le site.</p>
        </div>    

        <button class="collapse"><span class="bullseye"><i class="fa-solid fa-bullseye"></i></span><span class="btn-about">Page des recettes</span></button>
        <div class="panel">
                <p class="p-about">La page "Recette" présente une recette vedette aléatoire, puis propose la liste des catégories.</p>
        </div>    

        <button class="collapse"><span class="bullseye"><i class="fa-solid fa-bullseye"></i></span><span class="btn-about">Recette individuelle</span></button>
        <div class="panel">
                <p class="p-about">Chaque recette est présentée sur une page unique et permet le partage sur les réseaux sociaux et par courriel. Il est également possible d'accéder au différentes catégories dont elle fait partie et de l'imprimer en format adapté.</p>
        </div>    

        <button class="collapse"><span class="bullseye"><i class="fa-solid fa-bullseye"></i></span><span class="btn-about">Le blog</span></button>
        <div class="panel">
                <p class="p-about">La page "Blog" présente tous les articles de la base de données. Si un grand nombre d'articles est disponible, les articles seront présentés sur plusieurs pages.</p>
        </div>

        <button class="collapse"><span class="bullseye"><i class="fa-solid fa-bullseye"></i></span><span class="btn-about">Sauvegarde des données</span></button>
        <div class="panel">
                <p class="p-about">Les recettes et les articles de blog sont sauvegardées dans une base de données relationnelle.</p>
        </div>    
        
        <button class="collapse"><span class="bullseye"><i class="fa-solid fa-bullseye"></i></span><span class="btn-about">Le menu vertical</span></button>
        <div class="panel">
                <p class="p-about">Un menu vertical contenant toutes les catégories, ainsi que le nombre de recettes par catégories est disponible. Il est affiché sur les pages de catégories et de blog. Par soucis d'espace, et comme les catégories sont également disponibles dans un menu déroulant "Recettes" du menu principal, il n'est pas visible sur les appareils mobiles.</p>
                <p class="p-about">Le menu vertical présente aléatoirement une recette sur les pages de blog, et un article de blog sur les pages de catégories de recettes.</p>
        </div>    
        
        <button class="collapse"><span class="bullseye"><i class="fa-solid fa-bullseye"></i></span><span class="btn-about">Administration des données</span></button>
        <div class="panel">
                <p class="p-about">Les utilisateurs connectés ayant un compte administrateur pourront accéder aux options ajouter, modifier ou supprimer directement sur les pages de recettes ou de blog.</p> Cette option ne sera disponible que sur les postes de bureau et non sur les portables.
        </div>    

        <button class="collapse"><span class="bullseye"><i class="fa-solid fa-bullseye"></i></span><span class="btn-about">Liste d'épicerie</span></button>
        <div class="panel">
                <p class="p-about">À partir de la recette individuelle, l'utilisateur peut sélectionner et ajouter des items à sa liste d'épicerie. Un panier s'affichera alors dans la barre de menu afin d'accéder à la liste et de l'imprimer.</p> 
        </div>    
        
        <button class="collapse"><span class="bullseye"><i class="fa-solid fa-bullseye"></i></span><span class="btn-about">Fonction de courriel</span></button>
        <div class="panel">
                <p class="p-about">Une fonction de courriel a été intégrée afin de permettre à l'utilisateur d'envoyer son adresse de courriel et ainsi être ajouté sur une liste d'envoi.</p>
        </div>   
        </div> 
            
        <h3 class="about-subtitle mt-50">Technologies et outils utilisés pour ce projet</h3> 
        <span class="bullseye">

        <div class="cat-box-holder mb-sm">
        <?php
        foreach($tools as $item) : ?>
            <div class="cat-item tools">
                <?= $item; ?>
            </div>
        <?php endforeach; ?>
        </div>
        </span>
        
        
        <h3 class="about-subtitle mt-50">Photos et images</h3> 
        <p class="p-about">Toutes les photos proviennent du site Unsplash et les icones du site FontAwesome.</p>
        
    </div>

    </div></div>
</section>
