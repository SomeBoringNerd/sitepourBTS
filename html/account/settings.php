<?php
    // Initialize the session
    session_start();
    
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: ../index.php");
        exit;

    }else
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_POST["ID"] == $_SESSION["id"])
            {

            }
        }
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
            <megaTitle>Paramètres du compte</megaTitle>
            <?php 
                require("/admin/confing.php");

                $USER_ID_TO_LOAD = $_SESSION["id"];
                $sql = "SELECT * FROM users WHERE id = $USER_ID_TO_LOAD";

                $result = $link->query($sql);
        
                if ($result->num_rows > 0) 
                {// logiquement, le résultat devrait retourner une seule valeur 
                // donc utiliser une boucle est valide même si c'est une mauvaise idée
                    while($row = $result->fetch_assoc()) 
                    {
                        $USER_NAME = $row["username"];
                        $LAST_ONLINE = $row["LAST_ONLINE"];
                        include("../entete.php");
                        echo "

                        <form action=\"settings.php\" method=\"post\">
                            <p>pseudo :</p>
                            <textarea value=\"user_message\">$USER_NAME</textarea>

                            <p>pseudo :</p>
                            <textarea value=\"user_message\" rows=\"1\" cols=\"16\" class=\"msg\">$USER_NAME</textarea>
                        </form>
                            ";
                    }
                }
                else{
                    echo "<p>une erreur s'est produite : $link->error</p>";
                }
            ?>
        </center>
    </body>
</html>