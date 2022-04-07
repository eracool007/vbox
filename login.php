<?php
require 'includes/init.php';
$conn = require 'includes/db.php';
$page="";
//variables for metatags
$titrePage="VBox - Page de connection";
$descriptionPage = "Page de connection au site V-Box";
$imagePage = "https://www.caroline-fontaine.com/vbox/images/image11.jpg";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if(User::auth($conn, $_POST['email'], $_POST['password'])){
        
        Auth::login();
        if(User::isAdmin($conn, $_POST['email'], $_POST['password'])){
            Auth::admin();
        }
        Url::redirect('/');

    }else {
        $error = "Information de connection erronée.";
    }
}

require 'includes/head.php';
$conn = require 'includes/db.php';
?>

<header>
  <?php
  require 'includes/navigation.php';
  ?>
</header>
<main>
<section class="marginTop">
    <div class="row1 mt-100">
        <div class="main-content height-set center-all">
            <div class="user-form-box shadow">
                <div class="center80">
                <h2 id="form-title" class="section-title">Se connecter</h2>

                <?php if(! empty($error)) : ?>
                    <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $error; ?></p>
                <?php endif; ?>

                <form method="post">
                    <div class="user-form">
                        <div class="col-form-sm">
                            <label for="email">Courriel</label>
                        </div>
                        <div class="full">
                            <input class="user-input" name="email" title="email" id="email" autocomplete="username">
                        </div>
                    </div> 
                    <div class="user-form mb-sm">
                        <div class="col-form-sm">
                            <label form="password">Password</label>
                        </div>
                        <div class="full">
                            <input class="user-input" type="password" title="email" name="password" id="password" autocomplete="current-password">
                        </div>
                    </div>
                    <button class="btn btn-voir btn-txt" role="button" aria-label="connecter">Connecter!</button>
                    
                </form>
                <p class="register"><em>Pas encore inscrit?</em> <a class="green-links" href="register.php" arial-label="s'inscrire">Inscrivez-vous maintenant!</a></p>
                </div>
                
            </div>
        <div>
    </div>
</section>
</main>
<?php require 'includes/footer.php'; 


