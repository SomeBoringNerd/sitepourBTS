<?php
    session_start();
    require("../admin/config.php");

    $USER_ID_TO_LOAD = $_SESSION["id"];

    if(isset($USER_ID_TO_LOAD)){

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
                <br><br><br><br>
                <html>
                    <head>
                        <title>Settings</title>
                        <link rel=\"stylesheet\" href=\"../index.css\">
                    </head>
                    <body>
                        <center>
                            <megaTitle>Paramètres</megaTitle>
                        </center>
                        <br>
                        <div id=\"border_pic\" name=\"Nom d'utilisateur\">
                            <img src=\"../rescources/ProfilePic/$USER_NAME.png\" height=\"256\" width=\"256\" id=\"img_settings\">
                        </div>
                        <center>
                        <form action=\"contact.php\" method=\"post\">
                            <div>
                                <p>connecté en temps que $USERNAME </p>
                            </div>
                            <div>
                                <label for=\"msg\"><p style=\"font-size: 40;\">Pseudo :</p></label>
                                <textarea id=\"msg\" name=\"user_message\" rows=\"1\" cols=\"16\" class=\"msg\" value=\"user_message\" required>$USERNAME</textarea>
                            </div><br>
                            <div>
                                <label for=\"msg\"><p style=\"font-size: 40;\">Bio :</p></label>
                                <textarea id=\"msg\" name=\"user_message\" rows=\"7\" cols=\"50\" class=\"msg\" value=\"user_message\" required></textarea>
                            </div><br>
                            <div class=\"button\">
                            <p>Envoyer le message</p>
                            <button id=\"button_register\" type=\"submit\" value=\"Submit\"><pr>Mettre a jour le profil</pr></button>
                                    
                            </div>
                        </form>
                        </center>
                    ";
            }
        }
        else{
            header("location: login.php");
        }        
    }
?>

    </body>
</html>