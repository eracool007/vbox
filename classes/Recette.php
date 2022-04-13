<?php

/**------------------------------------------------------
 * Recette
 * 
 */

 class Recette{

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

    /** @var varchar 200 Image file name*/
    public $imagef;

    /** @var varchar 255 Image alt text and photo credits*/
    public $altImage;

    /** @var int Preparation time in minutes*/
    public $preparation;
    
    /** @var int Cooking time in minutes*/
    public $cuisson;

     /** @var int Number of portions*/
     public $portion;

     /** @var Array $category containing array of categories */
     public $category = [];

     /** @var Array $items array containing recipe ingredients*/
     public $items = [];

    /** @var array Error array*/
    public $errors = [];
    
    public function __constructor($id, $titre, $description, $instructions, $notes, $pdate, $imagef, $altImage, $preparation, $cuisson, $portion, $category) {
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
        $this->category = $category;
        
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

    /**------------------------------------------------------
     * Get page of recipes
     * @param object $conn Connection to db
     * @param integer $limit Number of recipes to return
     * @param integer $offset Number of recipes to skip
     * 
     * @return array Associative array of recipes for actual page
     */

    public static function getPage($conn, $limit, $offset, $catId){
        $sql="SELECT r.id, r.titre, r.imagef, r.altImage, r.pdate
            FROM tb_recette as r
            LEFT JOIN tb_liste_categories AS l on r.id = l.id_recette
            WHERE l.id_nom_categorie= :catId
            ORDER BY r.pdate DESC
            limit :limit
            offset :offset";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':catId', $catId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**------------------------------------------------------
     * Counts number of recipes
     * 
     * @var object $conn Connection to db
     * 
     * @return integer Number of article records
     */
    public static function countRecipes($conn){
        return $conn->query('SELECT COUNT(*) FROM tb_recette')->fetchColumn();
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
        if(trim($this->titre) =='') {
            $this->errors[] = "Titre requis";
        }
    
        if(empty($this->category)){
            $this->errors[] = "Au moins une catégorie est requise.";
            
        }
    
        if($this->preparation !=""){
            
            if(! is_numeric($this->preparation)){
            $this->errors[] = "Le temps de preparation doit être indiqué par un chiffre";
            }
        }

        if($this->cuisson !=""){
            
            if(! is_numeric($this->cuisson)){
            $this->errors[] = "Le temps de cuisson doit être indiqué par un chiffre";
            }
        }

        if($this->cuisson !=""){
            
            if(! is_numeric($this->cuisson)){
            $this->errors[] = "Le temps de cuisson doit être indiqué par un chiffre";
            }
        }
       
       return empty($this->errors);
    }

    /**------------------------------------------------------
    * Add recipe into db
    * 
    * @param object $conn Connection to the db
    * 
    * @return boolean True if added, False otherwise
    */
    public function addRecipe($conn){

        if($this->validateRecipe()){
      
            try{

                $conn->beginTransaction();

                $sql = "INSERT INTO tb_recette(titre, description, instructions, notes, pdate, altImage, preparation, cuisson, portion)
                VALUES (:titre, :description, :instructions, :notes, :pdate, :altImage, :preparation, :cuisson, :portion);";

                $stmt = $conn->prepare($sql);

                $stmt->bindValue(':titre', $this->titre, PDO::PARAM_STR);
                $stmt->bindValue(':instructions', $this->instructions, PDO::PARAM_STR);
                $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
                $stmt->bindValue(':notes', $this->notes, PDO::PARAM_STR);
                //$stmt->bindValue(':imagef', $this->imagef, PDO::PARAM_STR);
                $stmt->bindValue(':altImage', $this->altImage, PDO::PARAM_STR);
            
                if($this->pdate ==''){
                    $stmt->bindValue(':pdate', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindValue(':pdate', $this->pdate, PDO::PARAM_STR);
                }

                if($this->preparation ==''){
                    $stmt->bindValue(':preparation', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindValue(':preparation', $this->preparation, PDO::PARAM_INT);
                }

                if($this->cuisson ==''){
                    $stmt->bindValue(':cuisson', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindValue(':cuisson', $this->cuisson, PDO::PARAM_INT);
                }

                if($this->portion ==''){
                    $stmt->bindValue(':portion', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindValue(':portion', $this->portion, PDO::PARAM_INT);
                }

                if($stmt->execute()){
                    $this->id = $conn->lastInsertId();
                }

                //category section 
               foreach($this->category as $cat){

                $sql = "INSERT INTO tb_liste_categories(id_recette, id_nom_categorie)
                        VALUES(:id_recette, :id_nomcategorie);";

                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id_recette', intval($this->id), PDO::PARAM_INT);
                $stmt->bindValue(':id_nomcategorie', $cat, PDO::PARAM_INT);

                $stmt->execute();
                }
                
                foreach($this->items as $item) {
                  
                    $sql ="INSERT INTO tb_liste_ingredients(id_recette, item)
                            VALUES(:id_recette, :item);";
                    
                    $stmt = $conn->prepare($sql);
                    
                    $stmt->bindValue(':id_recette', intval($this->id), PDO::PARAM_INT);
                    $stmt->bindValue(':item', $item, PDO::PARAM_STR);
                    $stmt->execute();
                } 
                return $conn->commit();
    
            } catch (\PDOException $e) {
                $conn->rollBack();
                die("Il semble y avoir eu une erreur."); 
            }
    
        } else {
            return false;
        }
    }

    /**------------------------------------------------------
    * Update recette into db
    * 
    * @param object $conn Connection to the db
    * 
    * @return boolean True if update successfull
    */
    public function updateRecipe($conn){

        if($this->validateRecipe()){
            $this->deleteCat($conn);
            $this->deleteItem($conn);
            
            try{

                $conn->beginTransaction();
            
                $sql = "UPDATE tb_recette
                        SET titre = :titre,
                            description = :description,
                            instructions = :instructions,
                            notes = :notes,
                            pdate = :pdate,
                            altImage = :altImage,
                            preparation = :preparation,
                            cuisson = :cuisson,
                            portion = :portion
                        WHERE id = :id;";

                $stmt = $conn->prepare($sql);

                $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
                $stmt->bindValue(':titre', $this->titre, PDO::PARAM_STR);
                $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
                $stmt->bindValue(':instructions', $this->instructions, PDO::PARAM_STR);
                $stmt->bindValue(':notes', $this->notes, PDO::PARAM_STR);

                $stmt->bindValue(':altImage', $this->altImage, PDO::PARAM_STR);
            
                if($this->pdate ==''){
                    $stmt->bindValue(':pdate', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindValue(':pdate', $this->pdate, PDO::PARAM_STR);
                }

                if($this->preparation ==''){
                    $stmt->bindValue(':preparation', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindValue(':preparation', $this->preparation, PDO::PARAM_INT);
                }

                if($this->cuisson ==''){
                    $stmt->bindValue(':cuisson', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindValue(':cuisson', $this->cuisson, PDO::PARAM_INT);
                }

                if($this->portion ==''){
                    $stmt->bindValue(':portion', null, PDO::PARAM_NULL);
                } else {
                    $stmt->bindValue(':portion', $this->portion, PDO::PARAM_INT);
                }

                $stmt->execute();
                
               foreach($this->category as $cat){

                $sql = "INSERT INTO tb_liste_categories(id_recette, id_nom_categorie)
                        VALUES(:id_recette, :id_nomcategorie);";

                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id_recette', intval($this->id), PDO::PARAM_INT);
                $stmt->bindValue(':id_nomcategorie', $cat, PDO::PARAM_INT);

                $stmt->execute();

                }
                
                foreach($this->items as $item) {
                  
                    $sql ="INSERT INTO tb_liste_ingredients(id_recette, item)
                            VALUES(:id_recette, :item);";
                    
                    $stmt = $conn->prepare($sql);
                    
                    $stmt->bindValue(':id_recette', intval($this->id), PDO::PARAM_INT);
                    $stmt->bindValue(':item', $item, PDO::PARAM_STR);
                    $stmt->execute();
                    
                } 
                return $conn->commit();
                
            } catch (\PDOException $e) {
                $conn->rollBack();
                die("Il semble y avoir eu une erreur."); 
            }
           
        } else {
             
            return false;
        }
    }

    /**------------------------------------------------------
    * Delete category from tb_liste_categories
    * 
    */
    private function deleteCat($conn){

        $sql = "DELETE FROM tb_liste_categories
                WHERE id_recette = :id;";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

     /**------------------------------------------------------
    * Delete ingredient item from tb_liste_ingredients
    * 
    */
    private function deleteItem($conn){

        $sql = "DELETE FROM tb_liste_ingredients
                WHERE id_recette = :id;";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**------------------------------------------------------
    * Delete article
    * 
    * @param object $conn Connection to the db
    * 
    * @return boolean True if delete successfull
    */
    public function deleteRecipe($conn){

        $this->deleteCat($conn);
        $this->deleteItem($conn);
        $sql = "DELETE FROM tb_recette
                WHERE id = :id;";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }


    /**------------------------------------------------------
    * setImageFile
    * 
    * @param object $conn Connection to the db
    * @param string $filename Filename of image
    * 
    * @return boolean True if delete successfull
    */
    public function setImageFile($conn, $filename){
        $sql = "UPDATE tb_recette
                SET imagef = :imagef
                WHERE id = :id";
        $stmt= $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':imagef', $filename, PDO::PARAM_STR);

        return $stmt->execute();
    }
 }
    
 