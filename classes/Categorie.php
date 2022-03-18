<?php
/**
 * class managing the list of available categories (add or remove categories)
 * 
 */
class Categories {
    
      /** @var int $id_categorie*/
      public $id_categorie;

      /** @var varchar 100 $nom_categorie */
      public $nom_categorie;

      /** @var varchar 50 $imagef Image filename */
      public $imagef;

      /** @var varchar 255 $altImage Image alternate text and photo credits  */
      public $altImage;
  
      /** @var array Error array*/
       public $errors = [];
      
       
  
      public function __constructor($id_categorie, $nom_categorie, $imagef, $altImage){
          
        $this->id = $id;
          $this->nom_categorie = $nom_categorie;
          $this->imagef = $imagef;
          $this->altImage = $altImage;
         
      }
    }