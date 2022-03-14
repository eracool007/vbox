<?php
                if(! empty($errors)): ?>
                    <?php foreach($errors as $error): ?>
                        <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $error; ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

                <form method="post">
                    <div>
                        <label for="titre">Titre</label>
                        <input name="titre" id="titre" placeholder="Titre de l'article" value="<?= htmlspecialchars($titre) ?>"> 
                    </div>
                    <div>
                        <label for="texte">Contenu</label>
                    </div>
                    <div>
                        <textarea name="texte" id="texte" placeholder="Contenu de l'article" rows="10" cols="100" ><?= htmlspecialchars($texte) ?></textarea>
                    </div>
                    <div>
                        <label for="date">Date</label>
                        <input type="datetime-local" name="date" id="date" value="<?= htmlspecialchars($publishedDate) ?>">
                    </div>

                    <div>
                        <label for="image">Image</Iabel>
                        <input type="file" name="image" id="image" placeholder="Insérer une image">
                        </div>

                    <div>
                        <label for="altImage">Texte alternatif pour image</label>
                    </div>
                    <div>
                        <textarea name="altImage" id="altImage" placeholder="Texte alternatif et crédit photo ici" rows="10" cols="100"><?= htmlspecialchars($altImage) ?></textarea>
                    </div>

                    <button>Sauvegarder</button>

                   
                </form>
