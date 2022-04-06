<?php
/**
 * Login session methods
 */
    class Auth {
    /**
     * Check if user is logged in
     * 
     * @return boolean True if logged in, False otherwise
     */
    public static function isLoggedIn(){

        return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
    }

    /**
     * RequireLogin
     * 
     * @return void
     */
    public static function requireLogin(){
        if(! static::isLoggedIn()){
            die("Accès refusé");
        }
    }

    /**
     * Check if user is admin user
     * 
     * @return boolean True if admin, False otherwise
     */
    public static function isAdmin(){

        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
    }

    /**
     * RequireAdmin
     * 
     * @return void
     */
    public static function requireAdmin(){
        if(! static::isAdmin()){
            die("Accès refusé");
        }
    }

    /**
     * set session
     * 
     * @return void
     */
    public static function login(){

        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
    }
    
    /**
     * set session admin
     * 
     * @return void
     */
    public static function admin(){

        session_regenerate_id(true);
        $_SESSION['is_admin'] = true;
    }


    /**
     * Log out of session
     * 
     * @return void
     */
    public static function logout(){
       
        $_SESSION = [];

        //check and clear if cookies
        if (ini_get("session.use_cookies")){

            $param = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $param["path"], $param["domain"], $param["secure"], $param["httponly"]);
        }
        session_destroy();
        
    }
}

