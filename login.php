<?php
require 'includes/init.php';
$conn = require 'includes/db.php';
$page="";
//variables for metatags
$titrePage="VBox - Page de connection";
$descriptionPage = "Page de connection au site V-Box";
$imagePage = "https://www.caroline-fontaine.com/vbox/images/image11.jpg";

$subscribe=false;
$error = [];
$newUser = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && (!isset($_GET['subscribe']))){

    if(User::auth($conn, $_POST['email'], $_POST['password'])){
        
        Auth::login();
        if(User::isAdmin($conn, $_POST['email'], $_POST['password'])){
            Auth::admin();
        }
        Url::redirect('/');

    }else {
        $error[]= "Information de connection erronée.";
    }
} else {
    if(isset($_GET['subscribe'])){
        $subscribe=true;
        if(isset($_POST) && (!empty($_POST))){
            
            $newUser = new User();

            $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            $newUser->email = $POST['email'];
            $newUser->password = $POST['password'];
            $newUser->password2 = $POST['password2'];
                        
            if($newUser->insertUser($conn)){
               Url::redirect("/login.php"); 
            } 
        }
    }
}

require 'includes/head.php';

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
                <h2 id="form-title" class="section-title">
                    <?php ($subscribe) ? $stitre="S'inscrire" : $stitre="Se connecter"; ?><?= $stitre; ?></h2>

                <?php if(! empty($error)) : ?>
                    <?php foreach($error as $err) : ?>
                        <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $err; ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if($subscribe) : ?>
                    <?php if (!empty($newUser->errors)) : ?>
                        <?php foreach($newUser->errors as $err) : ?>
                            <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $err; ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <form method="post">
                    <div class="user-form">
                        <div class="col-form-sm">
                            <label for="email">Courriel</label>
                        </div>
                        <div class="full">
                            <input type="email" class="user-input" name="email" title="email" id="email" autocomplete="username" required>
                        </div>
                    </div> 
                    <div class="user-form mb-sm">
                        <div class="col-form-sm">
                            <label form="password">Mot de passe</label>
                        </div>
                        <div class="full">
                            <input class="user-input" type="password" title="email" name="password" id="password" autocomplete="current-password" required>
                        </div>
                    </div>
                    <?php if($subscribe) : ?>
                    <div class="user-form mb-sm">
                        <div class="col-form-sm">
                            <label form="password">Mot de passe</label>
                        </div>
                        <div class="full">
                            <input class="user-input" type="password" title="email2" name="password2" id="password2" placeholder="Confirmation du mot de passe" required>
                        </div>
                    </div>
                    <?php endif; ?>
                   
                    <button class="btn btn-voir btn-txt" role="button" aria-label="connecter"><?php echo ($subscribe) ? "M'inscrire!" : "Connecter!"; ?></button>
                    
                </form>
                <?php if(!$subscribe) : ?>
                <p class="register"><em>Pas encore inscrit?</em> <a class="green-links" href="?subscribe=1" arial-label="s'inscrire">Inscrivez-vous maintenant!</a></p>
                <?php else: ?>
                <p class="register"><em>Je suis déjà inscrit(e)!</em> <a class="green-links" href="?subscribe=0" arial-label="me connecter">Me connecter!</a></p>
                <?php endif; ?>
                </div>
                
            </div>
        <div>
    </div>
</section>
</main>
<?php require 'includes/footer.php'; ?> 


