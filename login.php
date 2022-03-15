<?php
require 'includes/init.php';
$conn = require 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if(User::auth($conn, $_POST['email'], $_POST['password'])){
        
        Auth::login();
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

<section class="marginTop">
      
    <div class="row1 mt-100">
        <div class="main-content align-text-l">
        <h2 class="section-title">Se connecter</h2>

        <?php if(! empty($error)) : ?>
            <p class="error-msg oups"><i class="fas fa-exclamation-triangle oups"></i> <?= $error; ?></p>
        <?php endif; ?>

        <form method="post">
            <div>
                <label form="email">Courriel</label>
                <input name="email" id="email">
            </div>
            <div>
                <label form="password">Password</label>
                <input name="password" id="password">
            </div>
            <button>Connecter!</button>
        </form>

    </div>
</section>





<?php require 'includes/footer.php'; 


