<?php
require 'includes/init.php';
$conn = require 'includes/db.php';
$page="";
//variables for metatags
$titrePage="VBox - Page de connection";
$descriptionPage = "Page de connection au site V-Box";
$imagePage = "https://www.caroline-fontaine.com/vbox/images/image11.jpg";

$subscribe=false;
$error=[];

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
            
            $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            $email = $POST['email'];
            $password = $POST['password'];
            $password2 = $POST['password2'];
            
        
            //validate email
            if (!filter_var($POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error[] = "Courriel invalide";
            }    
           //confirm password
            if($password != $password2){
                $error[] = "Les mots de passe de concordent pas.";
            }
            //field filled
            if($email =="" || $password =="" || $password2 ==""){
                $error[]="Tous les champs doivent être remplis.";
            }
            if(empty($error)){
               if(User::userExist($conn, $email, $password)){
                $error[] = "Cet utilisateur existe déja.";
               } else { echo "n existe pas"; exit; }
            }
        }
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
                    <?php foreach($error as $err) : ?>
                        <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $err; ?></p>
                    <?php endforeach; ?>
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
                <p class="register"><em>Pas encore inscrit?</em> <a class="green-links" href="?subscribe=1" arial-label="s'inscrire">Inscrivez-vous maintenant!</a></p>
                </div>
                
            </div>
        <div>
    </div>
</section>
</main>
<?php require 'includes/footer.php'; 


