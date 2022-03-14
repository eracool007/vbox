<?php

/**
 * Recette
 * 
 */

 class Recette{

    //Recipe variable declaration
    
    /** @var int */
    public $id;

    /** @var varchar 255 */
    public $titre;

    /** @var text */
    public $description;

    /** @var text */
    public $instructions;

    /** @var text */
    public $notes;

    /** @var date */
    public $date;

    /** @var varchar 50 */
    public $imgFilename;

    /** @var array to contain all categories */
 
    




    /**---------------------------------------------  
    * Get all recipies
    * @param object $conn Connection to db
    *
    * @return array Associative array of all recipies
    */
    public static function getAllRecipies($conn){
        $sql= "SELECT *
            FROM tb_recette
            ORDER BY date DESC";
        
        $result = $conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**---------------------------------------------  
     * Get all recipies by category
     * 
     * @param object $conn Connection to db 
     * @param int $catId Category Id
     * 
     * @return array Array of recipies for the category
     */
    public static function getRecipesByCategory($conn, $catId){
     
        $sql="SELECT r.id, r.titre, r.image, r.altImage, r.date
        FROM tb_recette as r
        LEFT JOIN tb_liste_categories AS l on r.id = l.id_recette
        WHERE l.id_nom_categorie= :catId
        ORDER BY r.date DESC;";
      
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':catId', $catId, PDO::PARAM_INT);
        
        if($stmt->execute()){
           
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
    
 }
    
 