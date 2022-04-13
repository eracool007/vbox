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
    <div class="mb-sm">
        <input class="form-input width100" name="titre" id="titre" placeholder="Titre de la recette" value="<?= htmlspecialchars($singleRecipe->titre); ?>" size="100"> 
        
    </div>
    <div>
        <label for="description">Description</label>
    </div>
    <div class="mb-sm">
        <textarea class="form-input width100" rows="10" name="description" id="description" placeholder="Description de la recette"><?= html_entity_decode($singleRecipe->description); ?></textarea>
        
    </div>

    <!-- CATEGORIES -->
    Catégories
    <div class="mb-sm">
        <?php
        
        $i=0;
        foreach($allCategories as $cat){ ?>
           
            <input aria-description="boite a cocher" type="checkbox" id="cat[<?= $i ?>]" name="cat[<?= $i ?>]" value="<?=$cat['id_categorie'] ?>"
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
            <label for="ing[<?= $i; ?>]">Ingrédient: </label> <input class="form-input width-md" type="text" id="ing[<?= $i; ?>]" name="ing[<?= $i; ?>]" value="<?= htmlspecialchars($ing); ?>">
            
            <div class="circle-btn">
                    <div class="circle-minus"><i class="fas fa-minus-circle minus"></i>
                    </div>
                </div>
            
        </div>
       
    <?php $i++; }
    } else { ?>
        <div class="ingredient">    
            <label for="ing[]">Ingrédient: </label> <input class="form-input width-md" type="text" id="ing[]" name="ing[]" value="">
        
            <div class="circle-btn">
                <div class="circle-minus"><i class="fas fa-minus-circle minus"></i>
                </div>
            </div>
        </div>
     <?php }?>
    </div>
    
    <!--Add new ingredient button-->
    <div class="circle-btn mb-sm"><div class="circle-plus"><i class="fas fa-plus-circle plus"></i></div>
    </div>
    
    Ajouter un ingredient</div>
    <div>
        <label for="instructions">Instructions</label>
    </div>
    <div class="mb-sm">
        <textarea class="form-input width100" rows="10" name="instructions" id="instructions" placeholder="Instructions de la recette"><?= html_entity_decode($singleRecipe->instructions); ?></textarea>
    </div>
    <div>
        <label for="notes">Notes</label>
    </div>
    <div class="mb-sm">
        <textarea class="form-input width100" rows="10" name="notes" id="notes"><?= html_entity_decode($singleRecipe->notes); ?></textarea>
    </div>
    <div class="mb-sm">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" value="<?= htmlspecialchars($singleRecipe->pdate); ?>">
    </div>
    
    <div> 
        <label for="altImage">Texte alternatif pour image</label>
    </div>
    <div class="mb-sm">
        <textarea class="form-input width100" name="altImage" id="altImage" placeholder="Texte alternatif et crédit photo ici" rows="10"><?= htmlspecialchars($singleRecipe->altImage); ?></textarea>
    </div>
    <div>
        <label for="preparation">Temps de preparation en minutes: </label>
        <input class="form-input width-sm" type="number" name="preparation" id="preparation" value="<?= htmlspecialchars($singleRecipe->preparation); ?>">
    </div>
    <div>
        <label for="cuisson">Temps de cuisson en minutes: </label>
        <input class="form-input width-sm" type="number" name="cuisson" id="cuisson" value="<?= htmlspecialchars($singleRecipe->cuisson); ?>">
    </div>
    <div class="mb-sm">
        <label for="portion">Nombre de portions: </label>
        <input class="form-input width-sm" type="number" name="portion" id="portion" value="<?= htmlspecialchars($singleRecipe->portion); ?>">
    </div>

    <button class="btn btn-voir btn-txt" role="button" aria-label="sauvegarder la recette">Sauvegarder</button>
    <?php if($singleRecipe->id) : ?>
    
        <a href="single-recette.php?id=<?= $singleRecipe->id; ?>" class="green-links form-links"> Annuler</a>
    <?php else : ?>
        <a href="recettes.php" class="green-links form-links"> Annuler</a>
    <?php endif; ?>
</form>
<!--fin recette-form-->
