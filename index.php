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

<?php
  //Error msgs here  
  if(isset($_GET['error'])){
    require 'includes/error.php';
    exit;
  
  }else {

  require 'includes/main-page.php';
  
  }

  //to subscribe to newsletter

  if(isset($_POST['mailing'])){
    
    require 'includes/mailing-list.php';
  } 

require 'includes/footer.php';
?>