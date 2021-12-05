<?php
    session_start();
    require("../admin/config.php");

    if(isset($_GET["id"]))
    {
        $USER_ID_TO_LOAD = $_GET["id"];
    }
    else
    {
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
                $USER_ID = $row["id"];
                $USER_BIO = $row["USER_BIO"];
                $LAST_ONLINE = $row["LAST_ONLINE"];
                include("../entete.php");
                
                $filename = "/rescources/ProfilePic/$USER_ID.png";

                if (!file_exists($filename)) {
                    $filename = "/rescources/ProfilePic/MISSING.png";
                }

                echo "
                <br><br><br><br>
                <html>
                    <head>
                        <title>Page utilisateur</title>
                        <link rel=\"stylesheet\" href=\"../index.css?rnd=132\">
                    </head>
                    <body>
                        <center>
                            <megaTitle>page de $USER_NAME</megaTitle>
                        </center>
                        <br>
                        <div id=\"border_pic\" name=\"Nom d'utilisateur\">
                            <img src=\"../rescources/ProfilePic/$USER_ID.png\" height=\"256\" width=\"256\">
                        </div>
                        <p id=\"border_user\">pseudo :<br><br> $USER_NAME</p>
                        <p id=\"border_user\" id=\"slightly_smaller_p\">vu(e) en ligne : $LAST_ONLINE</p>
                        <div id=\"bio\">
                            <textarea readonly>$USER_BIO</textarea>
                        </div>
                        
                    ";
            }
        }
        else{
            echo "<p>une erreur s'est produite : $link->error</p>";
        }        
    }
?>

                        <div id="POST_HISTORY">
                            <center><p>Historique des postes</p>
                            <p>______________________________</p></center>
                            <?php
                                require("../admin/config.php");
                                if(isset($_GET["id"]))
                                {
                                    $USER_ID_TO_LOAD = $_GET["id"];
                                }
                                else
                                {
                                    $USER_ID_TO_LOAD = $_SESSION["id"];
                                }
                                $sql = "SELECT * FROM forum_post WHERE POST_AUTHOR_ID = $USER_ID_TO_LOAD";

                                $result = $link->query($sql);

                                if ($result->num_rows > 0) 
                                {// logiquement, le résultat devrait retourner une seule valeur 
                                // donc utiliser une boucle est valide même si c'est une mauvaise idée
                                    while($row = $result->fetch_assoc()) 
                                    {
                                        $post_title = $row["POST_TITLE"];
                                        $post_id = $row["POST_ID"];
                                        echo "<a href=\"../forum/post.php?id=$post_id\"><p id=\"forum_account_p\">$post_title</p></a>";
                                    }
                                }else{
                                    echo "<center><p>cet utilisateur n'a pas encore créé de postes.</p></center>";
                                }

                            ?>
                            
                        </div>
                        
                    </body>
                </html>