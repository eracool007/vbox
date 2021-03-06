    <!--section CTA-->
    <section class="p-0" id="infolettre">
      <div class="row1 bg-light-green">
        <div class="main-content align-text-c">
          <div class="cta">
          <h3 class="title-cta">Vous ne voulez rien manquer?</h3>
          <p class="p-main">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo,
            nesciunt ducimus cumque ullam ut sint. 
          </p>
          <form action="index.php" method="POST" id="contact" enctype="multipart/form-data">
            <div class="cta-box">
              <label for="mailing">
              <input class="cta-input" type="email" name="mailing" id="mailing" placeholder="Courriel" required><button role="button" aria-label="envoyer mon adresse courriel" class="btn-mailing"><i class="fas fa-paper-plane"></i></button></label>
            </div>
            
          </form>
        </div></div>
      </div>
    </section>
    
    <!--Footer-->
    <footer id="footer">
      <div class="row1 bg-medium">
        <div class="main-content align-text-c">
          <p class="p-footer">Tous droits réservés &copy; <?php echo date("Y"); ?> V-BOX</p>
          <div class="logo-small align-text-c">
          V-Box<i class="fas fa-leaf logo-leaf-small"></i>
          </div>
         </div>
      </div>
    </footer>

    <?php if(isset($type) && ($type=="admin")) : ?>
        <script src="js/admin.js"></script>
    <?php endif; ?>

    <?php if($toprint) : ?>
      <script src="js/modal.js"></script>
      <script src="js/reseaux.js"></script>
    <?php endif; ?>
    
    <?php if(isset($_POST) && isset($_GET['action']) && $_GET['action']=="add") : ?>
      <script>showModal2();</script>
    <?php endif; ?>
    
    <?php if($page == "about.php") : ?>
      <script>loadCollapse();</script>
    <?php endif; ?>

  </body>
  
  
</html>
