<?php

/**
 * Redirection method
 * 
 */
class Url{
    /**-----------------------------------------------------
     * Redirection class
     * 
     * @param string $path 
     * 
     * @return void
     */
    public static function redirect($path){

        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !='off') {
            $protocol = 'https';
        } else {
            $protocol ='http';
        }
        header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/vbox" . $path);
    }
}


 