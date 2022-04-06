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
        <div class="main-content align-text-l height-set">
            <h2 class="section-title">Se connecter</h2>

            <?php if(! empty($error)) : ?>
                <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $error; ?></p>
            <?php endif; ?>

            <form method="post">
                <div>
                    <label for="email">Courriel</label>
                    <input name="email" title="email" id="email">
                </div>
                <div>
                    <label form="password">Password</label>
                    <input type="password" title="email" name="password" id="password" autocomplete="current-password">
                </div>
                <button aria-label="connecter">Connecter!</button>
            </form>
        <div>
    </div>
</section>
</main>
<?php require 'includes/footer.php'; 


