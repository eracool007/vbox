<?php
/**
 * ManageError
 * Function handle errors
 * 
 * @param msg error message
 * 
 */

 class ManageError{
    
    /**  
    * Manage errors and redirect with correct message
    *
    * @param type for type of page
    *    * 
    * Redirects to index page with message
    */
    public static function showErrorPage($type){

     $back = index.php;   

      if (isset($type)){ 
         switch ($type) {
         case "blog":
            $msg="L'article n'existe pas ou la page a été supprimée";
            $back="blog.php";
            break;
         case "recette":
            $msg = "La recette n'existe pas ou la page a été supprimée";
            $back="recettes.php";
            break;
         case "categorie":
            $msg = "La catégorie n'existe pas";
            $back = "recettes.php";
            break;
         default:
            $msg = "Il semble y avoir une erreur";
            $back="index.php";
         }
         
      }

      
      header("location: index.php?error=$msg&back=$back");
      exit;
   }
}