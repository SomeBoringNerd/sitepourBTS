<?php
    // Initialize the session
    session_start();
    
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: ../index.php");
        exit;

    }else{
        echo "<script>console.log(\"chargement de config.php\")</script>";
        require "../admin/config.php";
        echo "<script>console.log(\"config.php a été chargé\")</script>";
        echo "
        
        <!DOCTYPE html>
        <html lang=\"fr\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Login</title>
            <link rel=\"stylesheet\" href=\"../index.css\">
        </head>
            <body>";
        
        include("../entete.php");
        echo "<br><br><br><br>
            <center>
            <megaTitle>Paramètres du compte</megaTitle>";

        $USER_ID_TO_LOAD = $_SESSION["id"];

        // code MySQL pour update la dernière date de connexion au site
        $sql = "SELECT * FROM users WHERE id = $USER_ID_TO_LOAD";
        
        echo "<p>$sql<br>";
        
        if ($link->query($sql) === TRUE) {
            echo "réussi</p>";
        } 
        else{
            echo "erreur $link->error</p>";
        }
    }
        ?>
        </center>
    </body>
</html>