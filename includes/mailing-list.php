<?php
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
$email = $POST['mailing'];
$emailErr="";
//validate email
if (!filter_var($POST['mailing'], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Courriel invalide";

  }
if($emailErr == ""){
  
  //$name = $POST['name'];
  $to = "caroline@caroline-fontaine.com";

  $email = strip_tags($POST['mailing']);
  $subject = "Ajouter à la liste de distribution";
  $comment = '<p>Svp, ajouter le courriel suivant à la liste de distribution : </p> 
      <p>Email: ' . $email . '</p>';
  
  $headers = [
    'MIME-Version' => 'MIME-Version: 1.0',
    'Content-type' => 'text/html; charset=UTF-8',
    'From' => $email,
    'Reply-to' => $email,
  ];
  
  try {
    mail($to, $subject, $comment, $headers);
    echo "<script> alert('Merci, votre courriel a été envoyé et vous serez ajouté à notre liste de distribution!') </script>";
  } catch (Exception $e){
    echo "<script> alert('Le message n'a pas pu être envoyé. Veuillez réessayer plus tard.')";
  } 
  
} else {
  echo "Erreur";
}