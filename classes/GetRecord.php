<?php
/**
 * GetRecord
 * Function to get single record
 * 
 * @param conn db connection
 * @param table table to connect
 * @param id id of record to return
 * 
 * @return array record selected
 */

 class GetRecord{
    
    /**----------------------------------------------------------- 
    * Get record from a selected table
    *
    * @param conn db connection
    * @param table table to connect
    * @param id id of record to return
    * 
    * @return array associative array of selected record
    */
    public static function getSelectedRecord($conn, $table, $id){
        
       
        $sql="SELECT * 
        FROM $table 
        WHERE id= :id;";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        if($stmt->execute()){
           
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }

 }