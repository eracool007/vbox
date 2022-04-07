<?php
/**
 * User
 * 
 * for login section
 *  
 */

class User {

    public $id;
    public $username;
    public $password;
    public $admin;

    /**
     * Get user information
     * 
     * @param object $conn Db connection
     * @param var $email User email
     * @param var $password User password
     * 
     * @return array of record
     * 
     */
    public static function getUser($conn, $email, $password){

        $sql= "SELECT *
                FROM tb_user
                WHERE email = :email";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        //Return array as a User object
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();
        
        return $stmt->fetch();
    }
    /**************************************** */
    /**
     * User authentification
     * 
     * for login section
     * 
     * @param object $conn Db connection
     * @param var $email User email
     * @param var $password User password
     * 
     * @return boolean True if login is correct, otherwise, null will be returned
     * 
     */

    public static function auth($conn, $email, $password){

        $user = static::getUser($conn, $email, $password);
        if($user){
            return password_verify($password, $user->password);
        } else {
            return false;
        }
        
    }

    /**
     * User admin verification
     * Checks if user has admin rights
     * 
     * @param object $conn Db connection
     * @param var $email User email
     * @param var $password User password
     * 
     * @return boolean True if is admin, false otherwise
     * 
     */
    public static function isAdmin($conn, $email, $password){

        $user = static::getUser($conn, $email, $password);

        if($user){
            return($user->admin);
        }else {
             return false;
        }
    }

    /**
     * New user check
     * Checks if user already exists
     * 
     * @param object $conn Db connection
     * @param var $email User email
     * 
     * @return boolean True user already in db, false otherwise
     * 
     */
    public static function userExist($conn, $email, $password) {
        
        return $user=static::getUser($conn, $email, $password);
        
    }
    
}
