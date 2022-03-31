<?php
                 
                if(!empty($singleArticle->errors)): ?>
                
                    <?php foreach($singleArticle->errors as $error): ?>
                        <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $error; ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
                <!--article-form-->
                <form method="post">
                    <div>
                        <label for="titre">Titre</label><div>
                    <div>
                        <input name="titre" id="titre" placeholder="Titre de l'article" size="100" value="<?= htmlspecialchars($singleArticle->titre); ?>"> 
                    </div>
                    <div>
                        <label for="texte">Contenu</label>
                    </div>
                    <div>
                        <textarea name="texte" id="texte" placeholder="Contenu de l'article" rows="10" cols="100" ><?= html_entity_decode($singleArticle->texte); ?></textarea>
                    </div>
                    <div>
                        <label for="date">Date</label>
                       
                        <input type="date" name="date" id="date" value="<?= htmlspecialchars($singleArticle->pdate); ?>">
                    </div>

                    <!--<div>
                        <label for="image">Image</Iabel>
                        <input type="file" name="image" id="image" placeholder="Insérer une image" accept=".jpg, .png, .bmp" value="<?= htmlspecialchars($singleArticle->imagef); ?>"/>
                        </div>

                    <div> -->
                        <label for="altImage">Texte alternatif pour image</label>
                    </div>
                    <div>
                        <textarea name="altImage" id="altImage" placeholder="Texte alternatif et crédit photo ici" rows="10" cols="100"><?= htmlspecialchars($singleArticle->altImage); ?></textarea>
                    </div>

                    <button>Sauvegarder</button>

                   
                </form>
                <!--fin article-form-->
