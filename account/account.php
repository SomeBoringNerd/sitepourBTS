<?php
    session_start();
    require("../admin/config.php");

    if(isset($_GET["id"]))
    {
        $USER_ID_TO_LOAD = $_GET["id"];
    }else{
        $USER_ID_TO_LOAD = $_SESSION["id"];
    }

    if(isset($USER_ID_TO_LOAD)){

        $sql = "SELECT * FROM users WHERE id = $USER_ID_TO_LOAD";
        $result = $link->query($sql);

        if ($result->num_rows > 0) 
        {// logiquement, le résultat devrait retourner une seule valeur 
         // donc utiliser une boucle est valide même si c'est une mauvaise idée
            while($row = $result->fetch_assoc()) 
            {
                $USER_NAME = $row["username"];
                include("../entete.php");
                echo "
                <br><br><br><br>
                <html>
                    <head>
                        <title>Page utilisateur de $USER_NAME</title>
                        <link rel=\"stylesheet\" href=\"../index.css\">
                    </head>
                    <body>
                        <center>
                            <megaTitle>page de $USER_NAME</megaTitle>
                        </center>

                        <div id=\"border_pic\" name=\"Nom d'utilisateur\">
                            <img src=\"../rescources/ProfilePic/$USER_NAME.png\" height=\"128\" width=\"128\">
                        
                        <p id=\"border_user\">$USER_NAME</p>

                    </body>
                </html>";
                
            }
        }else{
            echo "cet utilisateur n'existe pas";
        }
    }
?>