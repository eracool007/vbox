<?php

/**
 * User favorites managing class
 * 
 */

 class Favorite{

    /**
     * @var int $id Favorite id
     */
    public $id; 
    
    /**
     * @var int $idUser User id
     */
    public $idUser;

    /**
     * var int $idRecette Recipe id
    */
    public $idRecette;

    /**
     * Get user favorites
     * 
     * @param $conn Connection to db
     * @param var $idUser
     * 
     * @return Array $userFavorites
     */
    public static function getUserFavorites($conn, $idUser){
        
        $sql = "SELECT r.id, r.titre, r.imagef, r.altImage
        FROM tb_recette AS r
        left join tb_favorite AS f
        ON r.id = f.id_recette
        WHERE f.id_user = $idUser;";
        
        $result = $conn->query($sql);
       
        return $result->fetchAll(PDO::FETCH_ASSOC);
    } 

    /** 
     * check if recipe in favorites
     * 
     * @param int $idUser
     * @param int $idRecette
     * 
     * @return boolean True if is in favorite, false otherwise
     */
    public static function isFavorite($conn, $idUser, $idRecette){

        $sql = "SELECT id_recette
                FROM tb_favorite
                WHERE id_user = $idUser AND id_recette = :idRecette;";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':idRecette', $idRecette, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if($stmt->execute()){
            return $stmt->fetch();
        }
    }
    /**
     * Add a new favorite
     * 
     * @object $conn
     * 
     * @return true if it worked, false other wise;
     */
    
     public function addFavorite($conn){
        if(!static::isFavorite($conn, $this->idUser, $this->idRecette)){
            
            $sql="INSERT INTO tb_favorite(id_user, id_recette)
                VALUES ($this->idUser, $this->idRecette);";
        
            if($conn->query($sql)){
                return true;
            }else {
                return false;
            }
        }
    }

    /**
     * Delete a recipe from favorites
     * 
     * @var object $conn 
     * 
     * @return true if it worked, false otherwise
     * 
     */
    public static function deleteFavorite($conn, $idUser, $idRecette){
        $sql = "DELETE FROM tb_favorite
                WHERE id_user = $idUser AND id_recette = $idRecette;";
        if($conn->query($sql)){
            return true;
        }else {
            return false;
        }
    }
    
 }