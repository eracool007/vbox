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

    /** @var varchar 200 Image file name*/
    public $imagef;

    /** @var varchar 255 */
    public $altImage;

    /** @var array Error array*/
     public $errors = [];
    
     /**
     * Class constructor
     * 
     * @param int $id Article id
     * @param varchar255 $titre Article title
     * @param text $texte Article content
     * @param date $pdate Article date
     * @param varchar200 $imagef Article image file name
     * @param varchar255 $altImage Alternate image text   
     * 
     * @return void
     */
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
     * Get page of articles
    *
    * @param object $conn Connection to db
    * @param integer $limit Number of article to return
    * @param integer $offset Number of article to skip
    * @return array Associative array of articles for actual page
    */
    public static function getPage($conn, $limit, $offset){
        $sql = "SELECT *
        FROM tb_article
        ORDER BY pdate DESC
        LIMIT :limit
        OFFSET :offset;";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**------------------------------------------------------
     * Count number of articles
     * 
     * @var object $conn Connection to db
     * 
     * @return integer Number of article records
     * 
     */
    public static function countArticles($conn){
        return $conn->query('SELECT COUNT(*) FROM tb_article')->fetchColumn();

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
    * @return bool True if no error
    */
    protected function validateArticle() {
        
        if(trim($this->titre) == ''){
            
            $this->errors[]= 'Titre requis';
        }
    
        if(trim($this->texte) == ''){
            $this->errors[] = 'Contenu requis';
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
            
             $sql = "INSERT INTO tb_article (titre, texte, pdate, altImage)
                VALUES (:titre, :texte, :pdate, :altImage);";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':titre', $this->titre, PDO::PARAM_STR);
            $stmt->bindValue(':texte', $this->texte, PDO::PARAM_STR);
            //$stmt->bindValue(':imagef', $this->imagef, PDO::PARAM_STR);
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
                    
                    altImage = :altImage
                WHERE id = :id;";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':titre', $this->titre, PDO::PARAM_STR);
        $stmt->bindValue(':texte', $this->texte, PDO::PARAM_STR);
        
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

    /**------------------------------------------------------
    * setImageFile
    * 
    * @param object $conn Connection to the db
    * @param string $filename Filename of image
    * 
    * @return boolean True if delete successfull
    */
    public function setImageFile($conn, $filename){
        $sql = "UPDATE tb_article
                SET imagef = :imagef
                WHERE id = :id";
        $stmt= $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':imagef', $filename, PDO::PARAM_STR);

        return $stmt->execute();
    }
    
 }