<?php
/**------------------------------------------------------
     * will return a random article or blog array
     * 
     * @param object $conn Connection to the db
     * @param string $feature (blog or article)
     * 
     * @return array 1 random record
     */
    class Random {

        public static function randomItem($conn, $feature) {
        
            $feature =='recette' ? $table='tb_recette' : $table = 'tb_article';

            $sql = "SELECT id
                FROM $table
                ORDER BY RAND()
                LIMIT 1;";

            $result = $conn->query($sql);
            $featured = $result->fetchAll(PDO::FETCH_ASSOC);
            
            $idNum= $featured[0]['id'];
            $sql = "SELECT *
                    FROM $table 
                    WHERE id= $idNum;";
            
            $result = $conn->query($sql);
            
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }
