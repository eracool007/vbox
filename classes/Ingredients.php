<?php

/**
 * class managing ingredients 
 * 
 */
class Ingredients {

    /**
     * Gets ingredients by recipe id
     * 
     * @param object $conn Connection to db
     * @param int $idNum Recipie id
     * 
     * @return array Ingredient array
     */
    
    public static function getIngredients($conn, $idNum) {
        $sql ="SELECT *
            From tb_liste_ingredients
            WHERE id_recette = :idNum";
        
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':idNum', $idNum, PDO::PARAM_INT);
        
        if($stmt->execute()){
           
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        
    }
}