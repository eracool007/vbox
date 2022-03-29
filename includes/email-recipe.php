<?php
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
$email = $POST['mailrecipe'];
$emailErr="";
//validate email
if (!filter_var($POST['mailrecipe'], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Courriel invalide";

  }

if($emailErr == ""){
  
  //$name = $POST['name'];
  $to = strip_tags($POST['mailrecipe']);
 
  $email = "caroline@caroline-fontaine.com";
  $subject = "Votre recette VBOX";
  
  $headers = [
    'MIME-Version' => 'MIME-Version: 1.0',
    'Content-type' => 'text/html; charset=UTF-8',
    'From' => $email,
    'Reply-to' => $email,
  ];
  
  //Email html builing
  $comment = "<div><h1>" . $singleRecette->titre . "</h1><br>";

  //check for valid url
  $url="";
  $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
  $url = $base_url . $_SERVER["REQUEST_URI"];
  if($url != ""){
    $comment .= "<br><a href='".$url."'>Voir la recette sur le web</a><br><br>"; 
  }

  $comment .= "<img src='https://www.caroline-fontaine.com/vbox/images/assets/".$singleRecette->imagef. "' width='300px' height='auto'>" ;
  $comment .= "<p>Préparation:  ". $singleRecette->preparation ." min.<br>Cuisson: ".$singleRecette->cuisson ." min.<br>Portions: ". $singleRecette->portion ."</p><br></div>";
  $comment .="<div><h3>DESCRIPTION</h3><p>" . html_entity_decode($singleRecette->description) . "</p><br></div><div>";
  $comment .="<h3>INGREDIENTS</h3><ul>";

     $listeIngredients = Ingredients::getIngredients($conn, $singleRecette->id);
        if (!empty($listeIngredients)) {
          
          foreach($listeIngredients as $ing){ 
            
            $comment .= "<li class='ing'><input type='checkbox' id='ing".$ing['id']."' name='ingredient".$ing['id']."' value='ingredient".$ing['id']."'>";
            
            $comment .= "<label for='ingredient".$ing['id']. "'>".$ing['item'];
            $comment .= "</label></li>";

          }
        } else { 
            echo "Aucun ingrédient mentionné."; 
        }
      $comment .= "</ul><br></div>";
      $comment .= "<div><h3>PREPARATION</h3>";
      $comment .= "<p>".html_entity_decode($singleRecette->instructions). "</p><br></div>";

      if($singleRecette->notes && $singleRecette->notes != "" && $singleRecette->notes != " "){
        $comment .="<div><h3>NOTES</h3><p>";
        $comment .= html_entity_decode($singleRecette->notes); 
        $comment .= "</p></div>";

      }

        
 try {
    mail($to, $subject, $comment, $headers);
    echo "<script> alert('Merci, la recette été envoyée avec succès'); </script>";
  } catch (Exception $e){
    echo "<script> alert('La recette n'a pas pu être envoyée. Veuillez réessayer plus tard.')";
  } 
} else {
  echo "Erreur";
}