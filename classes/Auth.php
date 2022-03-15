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
     * set session
     * 
     * @return void
     */
    public static function login(){

        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
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

