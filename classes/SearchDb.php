<?php

/**
 * Search method
 * 
 */

 class SearchDb{
    /**-----------------------------------------------------
     * Search database for specific string
     * 
     * @param $conn Connection to db
     * @param var $searchString User search string
     * 
     * @return Array $resultsRecipes Array containing search results 
     * @return Array Array of search results
     */
    public static function search($conn, $searchString){
        
        if($searchString && $searchString != ""){
            
            $sql = "SELECT id, titre, imagef, altImage, 'recette'
            FROM tb_recette
            WHERE titre LIKE :searchString
            UNION
            SELECT id, titre, imagef, altImage, 'article'
            FROM tb_article
            WHERE titre LIKE :searchString";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':searchString', '%'.$searchString.'%', PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
    }
 }