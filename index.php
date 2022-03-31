<?php
require 'includes/init.php';
require 'includes/head.php';

$conn = require 'includes/db.php';

//check if shopping list is required
$printCart=False;

//clears session cart after print.
if(isset($_GET['clear'])){
  
  if(isset($_SESSION['cart'])){ 
    
    $_SESSION['cart'] = [];
    $cart=false;
    
  }
}

if(isset($_GET['shopping'])){
    
  if(isset($_SESSION['cart'])){
    $printCart=true;
    if(empty($_SESSION['cart'])){
      $cartEmpty = true;
    }else{
      $cartEmpty=false;
    }
  }
}
?>
<header>
  <?php
  require 'includes/navigation.php';
  if(!$printCart){
    require 'includes/header-main.php';
  }
  ?>
</header>
<main>
<?php
//Error msgs here  
if(isset($_GET['error'])){
    require 'includes/error.php';
} elseif($printCart) {

  require 'includes/list.php';
  
} else {

  //default main page
  require 'includes/main-page.php';
}

//to subscribe to newsletter
if(isset($_POST['mailing'])){
    
   require 'includes/mailing-list.php';
} ?>
</main>
<?php
require 'includes/footer.php';
?>