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

        $sql= "SELECT *
                FROM tb_user
                WHERE email = :email";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        //Return array as a User object
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        if($user =$stmt->fetch()){

             return password_verify($password, $user->password);
             
        }
    }
}