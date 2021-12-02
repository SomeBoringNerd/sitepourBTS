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
        <?php 
        
            include("../entete.php");
            echo "<br><br><br><br>
                <center>
                <megaTitle>Paramètres du compte</megaTitle>";

            require_once "../admin/config.php";
            


            $USER_ID_TO_LOAD = $_SESSION["id"];

            echo  "<br><p>" . $USER_ID_TO_LOAD . "<br>";
            echo $_SESSION["id"] . "<br>";

            $requete = mysql_query("SELECT * FROM users WHERE id = $USER_ID_TO_LOAD");


            echo $sql . "<br>";

            $result = $link->query($sql);
    
            while($resultat = mysql_fetch_object($requete)) 
            {
                $USER_NAME = $resultat->username;
                $LAST_ONLINE = $resultat->LAST_ONLINE;
                echo "<form action=\"settings.php\" method=\"post\">
                    <p>pseudo :</p>
                    <textarea value=\"user_message\">$USER_NAME</textarea>

                    <p>pseudo :</p>
                    <textarea value=\"user_message\" rows=\"1\" cols=\"16\" class=\"msg\">$USER_NAME</textarea>
                </form>";
            }
        ?>
        </center>
    </body>
</html>