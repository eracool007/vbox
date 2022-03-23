<?php

require 'includes/init.php';
require 'includes/head.php';

Auth::requireLogin();

$conn = require 'includes/db.php';


/*variable for type of header*/
$type="admin";



if($_SERVER["REQUEST_METHOD"] == "POST"){

    

}
//end $_post

?>
<header>
  <?php
  require 'includes/navigation.php';
  require 'includes/header-subpage.php';   
  $errorMsg = "Il semble y avoir une erreur";           
?>

</header>

<section>

    <div class="row1">
        <div class="main-content">
            <div class="row1">
                <h2>Ajouter une image pour la recette</h2>
                
                

            <!--fin row1-->    
            </div>
    </div>
    </div>
    </section>  


<?php require 'includes/footer.php'; ?>