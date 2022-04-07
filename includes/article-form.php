<?php
                 
                if(!empty($singleArticle->errors)): ?>
                
                    <?php foreach($singleArticle->errors as $error): ?>
                        <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $error; ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
                <!--article-form-->
                <form method="post">
                    <div class="mb-sm">
                        <label for="titre">Titre</label><div>
                    <div>
                        <input class="form-input width100" name="titre" id="titre" placeholder="Titre de l'article" size="100" value="<?= htmlspecialchars($singleArticle->titre); ?>"> 
                    </div>
                    <div>
                        <label for="texte">Contenu</label>
                    </div>
                    <div class="mb-sm">
                        <textarea class="form-input width100" name="texte" id="texte" placeholder="Contenu de l'article" rows="10" cols="100" ><?= html_entity_decode($singleArticle->texte); ?></textarea>
                    </div>
                    <div class="mb-sm">
                        <label for="date">Date</label>
                       
                        <input type="date" name="date" id="date" value="<?= htmlspecialchars($singleArticle->pdate); ?>">
                    </div>
                        <label for="altImage">Texte alternatif pour image</label>
                    </div>
                    <div class="mb-sm">
                        <textarea class="form-input width100" name="altImage" id="altImage" placeholder="Texte alternatif et crédit photo ici" rows="10"><?= htmlspecialchars($singleArticle->altImage); ?></textarea>
                    </div>

                    <button class="btn btn-voir btn-txt" role="button" aria-label="sauvegarder l'article">Sauvegarder</button>
                    <?php if($singleArticle->id) : ?>
                        
                        <a href="single-blog.php?id=<?= $singleArticle->id; ?>" class="green-links form-links"> Annuler</a>
                    <?php else : ?>
                        <a href="blog.php" class="green-links form-links"> Annuler</a>
                    <?php endif; ?>
                   
                </form>
                <!--fin article-form-->
