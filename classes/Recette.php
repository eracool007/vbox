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

    /** @var pdate Published date */
    public $pdate;

    /** @var varchar 50 Image file name*/
    public $imagef;

    /** @var varchar 255 Image alt text and photo credits*/
    public $altImage;

    /** @var int Preparation time in minutes*/
    public $preparation;
    
    /** @var int Cooking time in minutes*/
    public $cuisson;

     /** @var int Number of portions*/
     public $portion;

    /** @var array Error array*/
    public $error = [];
    
    public function __constructor($id, $titre, $description, $instructions, $notes, $pdate, $imagef, $altImage, $preparation, $cuisson, $portion) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->instructions = $instructions;
        $this->notes = $notes;
        $this->pdate= $pdate;
        $this->imagef= $imagef;
        $this->altImage= $altImage;
        $this->preparation = $preparation;
        $this->cuisson = $cuisson;
        $this->portion = $portion;
    }
    
    /**---------------------------------------------  
    * Get all recipies
    * @param object $conn Connection to db
    *
    * @return array Associative array of all recipies
    */
    public static function getAllRecipies($conn){
        $sql= "SELECT *
            FROM tb_recette
            ORDER BY pdate DESC";
        
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
     
        $sql="SELECT r.id, r.titre, r.imagef, r.altImage, r.pdate
        FROM tb_recette as r
        LEFT JOIN tb_liste_categories AS l on r.id = l.id_recette
        WHERE l.id_nom_categorie= :catId
        ORDER BY r.pdate DESC;";
      
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':catId', $catId, PDO::PARAM_INT);
        
        if($stmt->execute()){
           
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }

    /**----------------------------------------------------------- 
    * Get recipe by ID
    *
    * @param conn db connection
    * 
    * @param id Recipe ID
    * 
    * @return object of selected record
    */
    public static function getRecipeById($conn, $id){
        
       
        $sql="SELECT * 
        FROM tb_recette 
        WHERE id = :id;";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        
        if($stmt->execute()){
           
            return $stmt->fetch();
        }
        
    }

    /**------------------------------------------------------
    * Validate recipe record
    * 
    * @return bool True if no error
    */
    protected function validateRecipe(){
        if($this->titre =='') {
            $this->error[] = "Titre requis";
        }
        if($this->pdate != ''){
            $date_time= date_create_from_format('Y-m-d H:i:s', $this->pdate);
    
            if($date_time === false){
                $this->error[] = 'Mauvais format de date';
            } else {
                $date_errors = date_get_last_errors();
                if($date_errors['warning_count'] > 0) {
                    $this->error[] = 'Mauvais format de date';
                }
            }
        }
        return empty($this->error);
    }

    /**------------------------------------------------------
    * Add recipe into db
    * 
    * @param object $conn Connection to the db
    * 
    * @return boolean True if added, False otherwise
    */
    public function addRecipe($conn){


    }


    
 }
    
 