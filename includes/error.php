<?php
//For error message page

if(isset($_GET['error'])){
  $msg= htmlspecialchars($_GET['error']);
}
if(isset($_GET['back'])){
  $back = htmlspecialchars($_GET['back']);
}

?>
  <!--section erreur-->
  <section class="height-set">
  <div class="row1">
    <div class="main-content align-text-c">
      <h2 class="section-title mt-100"><i class="fas fa-exclamation-triangle oups"></i> Oups!</h2>
      <div><p class="error"> <?= $msg ?></p>
        
        <div class="btn btn-lire" id="btn-erreur">
          <a class="deco_none link_retour" href="<?= $back ?>"><i class="fas fa-undo-alt"></i> Retour</a>
        </div>

      </div>
    </div>
  </div>

</section> 
<!--fin section erreur-->