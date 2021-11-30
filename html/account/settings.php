<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }    
    
?>

<html>
    <head>
        <title>modifier mon profil</title>
        <link rel="stylesheet" href="../index.css">
    </head>

    <body>
        <?php include("/entete.php"); ?>
        <br><br><br><br>


    </body>
</html>