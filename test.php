
<html>
<body>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/struct.css" />
   
    <script src="https://kit.fontawesome.com/146f5f72b9.js" crossorigin="anonymous"></script>

    <script src="js/script.js"></script>
    <title>V-Box : La boîte à recette végane</title>
  </head>

      <main>
        

              <!--Ingredients-->
              <section class="mt-0">
                  <div class="row1">
                    <h3 class="h3-sm">INGREDIENTS</h3>
                    <form action="single-recette.php?id=<?= $singleRecette->id ?>&action=add" method="post">
                    <ul class="ingredients">
                      
                          <li class="ing">
                          test
                          
                        
                          
                          </li>
                      </ul>
                    

                  <div class="ingredients mt-0" id="add-to-list">
                      &#8595;
                      <div class="add-to-list">
                          <button id="add-btn" type="submit">Ajouter à ma liste d'épicerie</button>
                      </div>
                  </div> 
                </form>    
                </div>
              </section>
              
              <!--Add to cart modal-->
              <div id="myModal2" class="modal">
                <div class="modal-content">
                  <span class="close2">&times;</span>
                  <h3>Les ingrédients ont été ajoutés à votre liste d'épicerie!</h3>
                  <p>Pour accéder à votre liste et l'imprimer, cliquer sur le panier dans le menu du haut de la page.</p>
                  <p><img src="images/help/cart.png" alt="Panier pour liste d'épicerie"></p>
                  
                </div>
              </div>  
              
             
    
              <footer id="footer">
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
      <script src="js/modal.js"></script>
      <script src="js/reseaux.js"></script>
      <script>showModal2();</script>
     </body>
  
  
</html>
