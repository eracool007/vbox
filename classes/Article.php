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

    /** @var date */
    public $date;

    /** @var varchar 100 */
    public $image;

    /** @var varchar 255 */
    public $altImage;

    /** @var array */
     public $error = [];
    

    public function __constructor($id, $titre, $texte, $date, $image){
        $this->id = $id;
        $this->titre = $titre;
        $this->texte = $texte;
        $this->date=$date;
        $this->image=$image;
        $this->altImage=$altImage;
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
                ORDER BY date DESC;";
        
        $result = $conn->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
     }

     
     /**------------------------------------------------------
     * Get all the articles
     * 
     * @param object $conn Connection to the db
     * 
     * @return objects all articles records
     
    public static function getAllArticles($conn){
        $sql = "SELECT *
               FROM tb_article
               ORDER BY date DESC;";
       
       $result = $conn->query($sql);
       $result->setFetchMode(PDO::FETCH_CLASS, 'Article');

       return $result->fetch();
    }*/

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
                ORDER BY date DESC
                LIMIT 1;";

        $result = $conn->query($sql);
        $result->setFetchMode(PDO::FETCH_CLASS, 'Article');

        return $result->fetch();
        
    }
    /**------------------------------------------------------
    * Add article into db
    * 
    * @param object $conn Connection to the db
    * 
    */
    
    public static function insertArticle($conn){
        
        $sql = "INSERT INTO tb_article
                VALUES (titre, texte, date, image, altImage);";
                

        
    }

 }