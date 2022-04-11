<?php
    
    $isFavorite=false;
    if(isset($_SESSION['user_id']) && ($_SESSION['user_id'])){
    
        $isFavorite = Favorite::isFavorite($conn, $_SESSION['user_id'], $singleRecette->id);
        
        if(isset($_GET["addfav"]) && ($_GET["addfav"]==1)){

            $newFavorite = new Favorite();
            $newFavorite->idUser= $_SESSION['user_id'];
            $newFavorite->idRecette =$singleRecette->id;
            
            if($newFavorite->addFavorite($conn)){
                $isFavorite = true;

            }
            

        }
        if(isset($_GET["deletefav"]) && ($_GET["deletefav"] == 1)) {
            if(Favorite::deleteFavorite($conn, $_SESSION['user_id'], $singleRecette->id)){
                $isFavorite = false;
            }
            
        }
        
    } elseif (isset($_GET["addfav"]) && ($_GET["addfav"]==1)){

        Url::redirect("/login.php");
        exit; 
    }
    