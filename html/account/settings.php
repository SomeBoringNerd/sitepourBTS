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
            echo $sql;
            echo $USER_ID_TO_LOAD . "<br>";
            echo $_SESSION["id"] . "<br>";

            $result = $link->query($sql);
    
            if ($result->num_rows > 0) 
            {// logiquement, le résultat devrait retourner une seule valeur 
             // donc utiliser une boucle est valide même si c'est une mauvaise idée
                while($row = $result->fetch_assoc()) 
                {
                    $USER_NAME = $row["username"];
                    $LAST_ONLINE = $row["LAST_ONLINE"];
                    echo "<form action=\"settings.php\" method=\"post\">
                        <p>pseudo :</p>
                        <textarea value=\"user_message\">$USER_NAME</textarea>

                        <p>pseudo :</p>
                        <textarea value=\"user_message\" rows=\"1\" cols=\"16\" class=\"msg\">$USER_NAME</textarea>
                    </form>";
                }
            }
            else{
                echo "error \n";
                echo $link->error;
            }
        ?>
        </center>
    </body>
</html>