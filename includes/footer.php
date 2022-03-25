    <!--section CTA-->
    <section class="p-0">
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
              <input class="cta-input" type="email" name="mailing" id="mailing" placeholder="Courriel"><button class="btn_mailing"><i class="fas fa-paper-plane"></i></button>
            </div>
            
          </form>
        </div></div>
      </div>
    </section>
    <!--Footer-->
    <footer>
      <div class="row1 bg-medium">
        <div class="main-content align-text-c">
          <p class="p-footer">Tous droits réservés 2022 &#169; V-BOX</p>
         <div class="logo-small align-text-c">
          V-Box<i class="fas fa-leaf logo-leaf-small"></i>
         </div>
         <p class="p-footer"><a href="#" class="footer-links">Crédits photos</a> </p>
        
        </div>
      </div>
    </footer>
    <?php if (isset($type) && ($type="admin")) : ?>

        <script src="js/admin.js"></script>
    
    <?php endif; ?>

  </body>
  
  
</html>
