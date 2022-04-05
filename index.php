<?php
require 'includes/init.php';
$conn = require 'includes/db.php';
require 'includes/set-info.php';
require 'includes/head.php';

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

//set page to show
/*if(isset($_GET['page'])){
  switch($_GET['page']){
    case "about":
      $page = "includes/about.php";
      $mainHeader = false;
      break;
    case "contact":
      $page = "includes/about.php";
      $mainHeader = false;
      break;
    default:
      $page= "includes/main-page.php";
  }
}*/
?>
<header>
  <?php
  require 'includes/navigation.php';
  if(!$printCart && $mainHeader){
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
  require $page;
}

//to subscribe to newsletter
if(isset($_POST['mailing'])){
    
   require 'includes/mailing-list.php';
} ?>
</main>
<?php
require 'includes/footer.php';
?>