<?php

/**
 * Article
 * 
 **/

 class Article {

    /** @var int */
    public $id;

    /** @var varchar 255 */
    public $titre; 

    /** @var text */
    public $texte;

    /** @var pdate Published date*/
    public $pdate;

    /** @var varchar 100 Image file name*/
    public $imagef;

    /** @var varchar 255 */
    public $altImage;

    /** @var array */
     public $error = [];
    
     

    public function __constructor($id, $titre, $texte, $pdate, $imagef, $altImage){
        $this->id = $id;
        $this->titre = $titre;
        $this->texte = $texte;
        $this->pdate= $pdate;
        $this->imagef= $imagef;
        $this->altImage= $altImage;
    }
    /**----------------------------------------------------------- 
    * Get an article by id
    *
    * @param object $conn Conn db connection
    * @param int $id Id of record to return
    * 
    * @return object of selected record
    */
    public static function getArticleById($conn, $id){
        
       
        $sql="SELECT * 
        FROM tb_article 
        WHERE id= :id;";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
        
        if($stmt->execute()){
           
            return $stmt->fetch();
        }
        
    }
     /**------------------------------------------------------
     * Get all the articles
     * 
     * @param object $conn Connection to the db
     * 
     * @return array An associative array of all articles records
     */
     public static function getAllArticles($conn){
         $sql = "SELECT *
                FROM tb_article
                ORDER BY pdate DESC;";
        
        $result = $conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
     }

    /**------------------------------------------------------
    * Get the latest article
    * 
    * @param object $conn Connection to the db
    * 
    * @return object Latest article
    */
    public static function getLatestArticle($conn){
        
        $sql = "SELECT * 
                FROM tb_article
                ORDER BY pdate DESC
                LIMIT 1;";

        $result = $conn->query($sql);
        $result->setFetchMode(PDO::FETCH_CLASS, 'Article');

        return $result->fetch();
        
    }

    /**------------------------------------------------------
    * Validate article record
    * 
    * @param varchar 255 $titre required Article title
    * @param text $texte required Article content
    * @param pdate $pdate Published date
    * @param varchar 100 $imagef Article image filename
    * @param varchar 255 $altImage Image alternate text and photo credits if required
    * 
    * @return bool True if no error
    */
    protected function validateArticle()
    {
        
        if($this->titre == ''){
            $this->errors[]= 'Titre requis';
        }
    
        if($this->texte == ''){
            $this->errors[] = 'Contenu requis';
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
        return empty($this->errors);
    }
    

    /**------------------------------------------------------
    * Add article into db
    * 
    * @param object $conn Connection to the db
    * 
    * @return boolean True if updated, False otherwise
    */
    
    public function addArticle($conn){
        
        if($this->validateArticle()){
             $sql = "INSERT INTO tb_article (titre, texte, pdate, imagef, altImage)
                VALUES (:titre, :texte, :pdate, :imagef, :altImage);";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':titre', $this->titre, PDO::PARAM_STR);
            $stmt->bindValue(':texte', $this->texte, PDO::PARAM_STR);
            $stmt->bindValue(':imagef', $this->imagef, PDO::PARAM_STR);
            $stmt->bindValue(':altImage', $this->altImage, PDO::PARAM_STR);

            if($this->pdate ==''){
                $stmt->bindValue(':pdate', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':pdate', $this->pdate, PDO::PARAM_STR);
            }
            
            if($stmt->execute()){
                $this->id = $conn->lastInsertId();
                return true;
            }
            
        } else {
            return false;
        }
    }
    /**------------------------------------------------------
    * Update article into db
    * 
    * @param object $conn Connection to the db
    * 
    * @return boolean True if update successfull
    */
    
    public function updateArticle($conn){
       
        if($this->validateArticle())
        {
            $sql = "UPDATE tb_article
                SET titre = :titre, 
                    texte = :texte,
                    pdate = :pdate,
                    imagef = :imagef,
                    altImage = :altImage
                WHERE id = :id;";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':titre', $this->titre, PDO::PARAM_STR);
        $stmt->bindValue(':texte', $this->texte, PDO::PARAM_STR);
        $stmt->bindValue(':imagef', $this->imagef, PDO::PARAM_STR);
        $stmt->bindValue(':altImage', $this->altImage, PDO::PARAM_STR);

        if($this->pdate ==''){
            $stmt->bindValue(':pdate', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':pdate', $this->pdate, PDO::PARAM_STR);
        }
        return $stmt->execute();

        } else {
            return false;
        }
        
    }

    /**------------------------------------------------------
    * Delete article
    * 
    * @param object $conn Connection to the db
    * 
    * @return boolean True if delete successfull
    */
    public function deleteArticle($conn){

        $sql = "DELETE FROM tb_article
                WHERE id = :id;";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        
        return $stmt->execute();

    }
    
 }