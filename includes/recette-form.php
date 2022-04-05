<?php

if(! empty($singleRecipe->errors)): ?>
    <?php 
        foreach($singleRecipe->errors as $error): ?>
            <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $error; ?></p>
    <?php endforeach; ?>
    <?php endif; ?>

<!--recette-form-->
<form method="post">
    <div>
        <label for="titre">Titre</label><div>
    <div>
        <input name="titre" id="titre" placeholder="Titre de la recette" value="<?= htmlspecialchars($singleRecipe->titre); ?>" size="100"> 
        
    </div>
    <div>
        <label for="description">Description</label>
    </div>
    <div>
        <textarea rows="10" cols="100" name="description" id="description" placeholder="Description de la recette"><?= html_entity_decode($singleRecipe->description); ?></textarea>
        
    </div>
    <!-- CATEGORIES -->
    Catégories

    <div>
        <?php
        
        $i=0;
        foreach($allCategories as $cat){ ?>
           
            <input aria-label="boite a cocher" type="checkbox" id="cat[<?= $i ?>]" name="cat[<?= $i ?>]" value="<?=$cat['id_categorie'] ?>"
            <?php 
            
            if(!empty($singleRecipe->category)){
                if(in_array($cat['id_categorie'], $singleRecipe->category)){

                echo "checked";
            }
            
            }
       
            ?>> 
            <label for="cat[<?= $i ?>] "><?=$cat['nom_categorie'] ?></label> <br>
            
        <?php $i++; } ?>
        
    </div>
    <!-- INGREDIENTS -->
    Ingrédients

    <div id="ingredient-section">
    <?php
    $i=0;
    
    if(!empty($singleRecipe->items)){
         //foreach($recipeIngArray as $ing){ 
        foreach($singleRecipe->items as $ing){
        ?>
        <div class="ingredient">
            <label for="ing[<?= $i; ?>]">Ingredient:</label> <input type="text" size="75" id="ing[<?= $i; ?>]" name="ing[<?= $i; ?>]" value="<?= htmlspecialchars($ing); ?>">
            
            <div class="circle-btn">
                    <div class="circle-minus"><i class="fas fa-minus-circle minus"></i>
                    </div>
                </div>
            
        </div>
       
    <?php $i++; }
    } else { ?>
        <div class="ingredient">    
            <label for="ing[]">Ingredient:</label> <input type="text" size="75" id="ing[]" name="ing[]" value="">
        
            <div class="circle-btn">
                <div class="circle-minus"><i class="fas fa-minus-circle minus"></i>
                </div>
            </div>
        </div>
     <?php }?>
    

    
        
    </div>
    
    <!--Add new ingredient button-->
    <div class="circle-btn"><div class="circle-plus"><i class="fas fa-plus-circle plus"></i></div>
    </div>
    
    Ajouter un ingredient</div>
    <div>
        <label for="instructions">Instructions</label>
    </div>
    <div>
        <textarea rows="10" cols="100" name="instructions" id="instructions" placeholder="Instructions de la recette"><?= html_entity_decode($singleRecipe->instructions); ?></textarea>
    </div>
    <div>
        <label for="notes">Notes</label>
    </div>
    <div>
        <textarea rows="10" cols="100" name="notes" id="notes"><?= html_entity_decode($singleRecipe->notes); ?></textarea>
    </div>
    <div>
        <label for="date">Date</label>
        <input type="date" name="date" id="date" value="<?= htmlspecialchars($singleRecipe->pdate); ?>">
    </div>
    
    <!--
    <div>
        <label for="image">Image</Iabel>
        <input type="file" name="image" id="image" placeholder="Insérer une image" accept=".jpg, .png, .bmp" value="<?= htmlspecialchars($singleRecipe->imagef); ?>"/>
        </div>
-->
    <div> 
        <label for="altImage">Texte alternatif pour image</label>
    </div>
    <div>
        <textarea name="altImage" id="altImage" placeholder="Texte alternatif et crédit photo ici" rows="10" cols="100"><?= htmlspecialchars($singleRecipe->altImage); ?></textarea>
    </div>
    <div>
        <label for="preparation">Temps de preparation en minutes</label>
        <input type="number" name="preparation" id="preparation" value="<?= htmlspecialchars($singleRecipe->preparation); ?>">
    </div>
    <div>
        <label for="cuisson">Temps de cuisson en minutes</label>
        <input type="number" name="cuisson" id="cuisson" value="<?= htmlspecialchars($singleRecipe->cuisson); ?>">
    </div>
    <div>
        <label for="portion">Nombre de portions</label>
        <input type="number" name="portion" id="portion" value="<?= htmlspecialchars($singleRecipe->portion); ?>">
    </div>

    <button aria-label="sauvegarder la recette">Sauvegarder</button>
</form>
<!--fin recette-form-->