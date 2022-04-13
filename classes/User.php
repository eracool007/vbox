<?php
/**
 * User
 * 
 * for login section
 *  
 */

class User {

    /** @var int */
    public $id;

    /** @var varchar200 */
    public $email;

    /** @var varchar255 */
    public $password;

    /** @var varchar255 */
    public $password2;

    /** @var boolean */
    public $admin;
    
    /** @var array Error array*/
    public $errors = [];
   
    /**-----------------------------------------------------
     * Class constructor
     * 
     * @param int $id Article id
     * 
     * @param int $id User id
     * @param varchar200 $email User email
     * @param varchar255 $password User password
     * @param boolean $admin False by default. Admin user to be set by db adminstrator.
     * 
     * @return void
     */
    public function __constructor($id, $email, $password, $password2, $admin){
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->password2 = $password2;
        $this->admin = $admin;
    }

    /**------------------------------------------------------
     * Get user information
     * 
     * @param object $conn Db connection
     * @param varchar $email User email
     * @param varchar $password User password
     * 
     * @return array of record
     * 
     */
    public static function getUser($conn, $email, $password){

        $sql= "SELECT *
                FROM tb_user
                WHERE email = :email;";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        //Return array as a User object
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();
        
        return $stmt->fetch();
    }
    /**------------------------------------------------------
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
           
            $_SESSION['user_id'] = $user->id;
            
            return password_verify($password, $user->password);
            
        } else {
            return false;
        }
        
    }

    /**------------------------------------------------------
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

    /**------------------------------------------------------
     * New user check
     * Checks if user already exists
     * 
     * @param object $conn Db connection
     * @param var $email User email
     * 
     * @return boolean True user already in db, false otherwise
     * 
     */
    protected function userExist($conn) {

        $sql= "SELECT *
                FROM tb_user
                WHERE email = '{$this->email}';";
    
        $result = $conn->query($sql);
        
        //Return array as a User object
        $result->setFetchMode(PDO::FETCH_CLASS, 'User');

        return $result->fetch();
        
    }
    /**------------------------------------------------------
     * Valide user information
     * 
     * @return boolean true if no error, false otherwise
     */

    protected function validateUser($conn){
        //validate email
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Courriel invalide";
        }    
       //confirm password
        if($this->password != $this->password2){
            $this->errors[] = "Les mots de passe de concordent pas.";
        }
        //field filled
        if($this->email =="" || $this->password =="" || $this->password2 ==""){
            $this->errors[]="Tous les champs doivent être remplis.";
        }

        //will check db only if first items validate.
        if(!$this->errors){
            
            if($this->userExist($conn)){
                $this->errors[] = "Cet utilisateur existe déja.";
                
            }else {
                
                return true;
            }
        }return false;
    }
    /**-----------------------------------------------------
     * Insert new user into db
     * 
     * @param object $conn Db connection
     * @param var $email User email
     * @param var $password User password
     * 
     * @return boolean True user added, false otherwise
     * 
     */
    public function insertUser($conn) {
        
        if($this->validateUser($conn)){
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO tb_user (email, password)
                    VALUES ('{$this->email}', '{$this->password}');";
            
            if($conn->query($sql)){
            
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
           return false; 
        }
    }
}
