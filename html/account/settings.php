<?php
    // Initialize the session
    session_start();
    
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: ../index.php");
        exit;

    }
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../index.css">
</head>
    <body>
        <?php include("../entete.php");?>
        <br><br><br><br>
        <center>
            <megaTitle>Connexion</megaTitle>
            <p>Connectez vous ici.</p>
        </center>
    </body>
</html>