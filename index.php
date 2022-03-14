<?php
require 'includes/init.php';
require 'includes/head.php';

$conn = require 'includes/db.php';

?>
    <header>
      <?php
      require 'includes/navigation.php';
      require 'includes/header-main.php';
      ?>
  
    </header>
<!--if error in $_GET(index.php?error=true) insert error message here-->

<?php
  if(isset($_GET['error'])){
    require 'includes/error.php';
    exit;
  
  }else {

  require 'includes/main-page.php';
  require 'includes/footer.php';
  }
?>