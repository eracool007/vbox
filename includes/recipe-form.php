<?php

if(! empty($singleRecipe->errors)): ?>
    <?php 
        foreach($singleRecipe->errors as $error): ?>
            <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $error; ?></p>
    <?php endforeach; ?>
    <?php endif; ?>

<form method="post">
    <div>
        <label for="titre">Titre</label>
        <input name="titre" id="titre" placeholder="Titre de la recette" value="<?= htmlspecialchars($singleRecipe->titre); ?>"> 
    </div>
    <div>
        <label for="description">Description</label>
    </div>
    <div>
        <textarea rows="10" cols="100" name="description" id="description" placeholder="Description de la recette" value="<?= htmlspecialchars($singleRecipe->description); ?>"> </textarea>
    </div>
    <!-- CATEGORIES -->
    Catégories

    <div>
        <?php
        $i=0;
        foreach($allCategories as $cat){ ?>
            
            <input type="checkbox" id="cat[<?= $i ?>]" name="cat[<?= $i ?>]" value="<?=$cat['id_categorie'] ?>"> <label for="cat[<?= $i ?>] "><?=$cat['nom_categorie'] ?></label> <br>
            
        <?php $i++; } ?>
        
    </div>
    <!-- INGREDIENTS -->
    Ingrédients
    <div>
        <label for="ing[0]">Ingredient:</label> <input type="text" id="ing[0]" name="ing[0]" value=""><i class="fas fa-plus-circle plus"></i><i class="fas fa-minus-circle minus"></i><br>

        <label for="ing[1]">Ingredient:</label> <input type="text" id="ing[1]" name="ing[1]" value=""><i class="fas fa-plus-circle plus"></i><i class="fas fa-minus-circle minus"></i><br>

        <label for="ing[3]">Ingredient:</label> <input type="text" id="ing[2]" name="ing[2]" value=""><i class="fas fa-plus-circle plus"></i><i class="fas fa-minus-circle minus"></i><br>


    <div>
        <label for="instructions">Instructions</label>
    </div>
    <div>
        <textarea rows="10" cols="100" name="instructions" id="instructions" placeholder="Instructions de la recette" value="<?= htmlspecialchars($singleRecipe->instructions); ?>"> </textarea>
    </div>
    <div>
        <label for="notes">Notes</label>
    </div>
    <div>
        <textarea rows="10" cols="100" name="notes" id="notes" value="<?= htmlspecialchars($singleRecipe->notes); ?>"> </textarea>
    </div>
    <div>
        <label for="date">Date</label>
        <input type="date" name="date" id="date" value="<?= htmlspecialchars($singleRecipe->pdate); ?>">
    </div>

    <div>
        <label for="image">Image</Iabel>
        <input type="file" name="image" id="image" placeholder="Insérer une image" accept=".jpg, .png, .bmp" value="<?= htmlspecialchars($singleRecipe->imagef); ?>"/>
        </div>

    <div>
        <label for="altImage">Texte alternatif pour image</label>
    </div>
    <div>
        <textarea name="altImage" id="altImage" placeholder="Texte alternatif et crédit photo ici" rows="10" cols="100"><?= htmlspecialchars($singleRecipe->altImage); ?></textarea>
    </div>
    <div>
        <label for="preparation">Temps de preparation en minutes</label>
        <input type="number" name="preparation" id="preparation" value="<?= htmlspecialchars($singleRecette->preparation); ?>">
    </div>
    <div>
        <label for="cuisson">Temps de cuisson en minutes</label>
        <input type="number" name="cuisson" id="cuisson" value="<?= htmlspecialchars($singleRecipe->cuisson); ?>">
    </div>
    <div>
        <label for="portion">Nombre de portions</label>
        <input type="number" name="portion" id="portion" value="<?= htmlspecialchars($singleRecipe->portion); ?>">
    </div>

    <button>Sauvegarder</button>
</form>