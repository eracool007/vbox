<?php

session_start();

if ($_SESSION['is_logged_in']){

    session_start();

    //set new array to empty session
    $_SESSION = array();

    //check if cookies, if so, clear them
    if(ini_get("session.use_cookies")){
        $param = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $param["path"], $param["domain"], $param["secure"], $param["httponly"]);
    }
    session_destroy();
    
}

header("location: index.php");

