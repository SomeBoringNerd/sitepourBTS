<?php
    session_start();
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'username');
    define('DB_PASSWORD', 'password');
    define('DB_NAME', 'register_user_system');

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($link === false){
    }
?>
