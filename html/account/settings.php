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
                        <title>Page utilisateur</title>
                        <link rel=\"stylesheet\" href=\"../index.css\">
                    </head>
                    <body>
                        <center>
                            <megaTitle>page de $USER_NAME</megaTitle>
                        </center>
                        <br>
                        <div id=\"border_pic\" name=\"Nom d'utilisateur\">
                            <img src=\"../rescources/ProfilePic/$USER_NAME.png\" height=\"256\" width=\"256\">
                        </div>
                        <p id=\"border_user\">pseudo :<br><br> $USER_NAME</p>
                        <p id=\"border_user\" id=\"slightly_smaller_p\">vu(e) en ligne : $LAST_ONLINE</p>
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