<?php

/**
 * class getting and containing all categories
 * 
 */
class Categories {
    
    /**
     * Array storing all categories
     */
    public $allCategoriesArray=[];

    /**------------------------------------------------------
     * Get categories in an array 
     * @param object $conn to db 
     * 
     */
    public function __construct($conn) {

        $sql = "SELECT *
                FROM tb_categorie
                ORDER BY nom_categorie;";

        $result = $conn->query($sql);

        $this->allCategoriesArray = $result->fetchAll(PDO::FETCH_ASSOC);
        
        
    }

    /**------------------------------------------------------
     * Counts number of recipies in a category
     * 
     * @param object $conn to db 
     * @param int $idNum Id
     * 
     * @returns number
     */
    public static function countCategories($conn, $idNum) {
        $sql ="SELECT COUNT(id_nom_categorie) as total
                FROM tb_liste_categories
                WHERE id_nom_categorie = :idNum;";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':idNum', $idNum, PDO::PARAM_INT);

        if($stmt->execute())
        {
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        
    }

    /**------------------------------------------------------
     * Get categories for each recipe in an array with their names OR will return only a random one if $random is true
     * 
     * @param $conn to db 
     * @param $id int Category id
     * @param $random bool Returns true if we want only one random category
     * 
     * @return array with category names
     * 
     */
    public static function getCategory($conn, $theId, $random){
        
        if(!$random){
            $sql = "SELECT *
            FROM tb_categorie AS c
            LEFT JOIN tb_liste_categories AS l ON c.id_categorie = l.id_nom_categorie
            WHERE l.id_recette = :theId";
        } else {

            $sql = "SELECT c.id_categorie, c.nom_categorie 
            FROM tb_categorie as c
            LEFT JOIN tb_liste_categories as l ON c.id_categorie = id_nom_categorie
            WHERE l.id_recette = :theId
            ORDER BY RAND()
            LIMIT 1";

        }
        $stmt = $conn->prepare($sql);
        
        $stmt->bindValue(':theId', $theId, PDO::PARAM_INT);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
     /**------------------------------------------------------
     * Get category name
     * 
     * @param $conn to db and recipie id
     * @param $theId int Category id
     *      * 
     * @return var category name
     * 
     */
    public static function getCategoryName($conn, $theId){
        $sql = "SELECT c.nom_categorie
        FROM tb_categorie AS c
        WHERE c.id_categorie = :theId";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':theId', $theId, PDO::PARAM_INT);

        if($stmt->execute()){
            $name = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $name[0]['nom_categorie']; 
        }
       
    }

}
