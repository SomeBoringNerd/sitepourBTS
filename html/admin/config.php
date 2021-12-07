<?php
    session_start();
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', 'motdepasse');
    define('DB_NAME', 'register_user_system');

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($link === false){
        echo "<script>console.log('fuck');</script>";
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }else{
        echo "<script>console.log('it worked yey');</script>";
    }
?>
