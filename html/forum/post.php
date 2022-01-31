<?php
    session_start();
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {           // encore un fix de merde, celui ci empeche une méthode post random
                // de pouvoir supprimer un poste sans vérification
                // note : ne PAS utiliser POST pour vérifier l'authenticité
                // d'un utilisateur
        if(isset($_POST["delete"])){
            if($_SESSION["user_status"] === 1 OR $row["POST_AUTHOR_ID"] == $_SESSION["id"]){
                require("../admin/config.php");
                $id_post = $_POST["POST_ID"];

                $sql = "DELETE FROM forum_post WHERE POST_ID = $id_post";

                //$result = ;
                if($link->query($sql) === true)
                {
                    header("location: index.php");
                    exit;
                }else{
                    echo "<script>alert(\"une erreur est survenue : $link->error\");</script>";
                }
            }
        }else if(isset($_POST["save"]))
        {
            require("../admin/config.php");
            $sql = "SELECT * FROM forum_post WHERE POST_ID = $post_id";
            echo "<script>echo(\"1\")</script>";
            $post_id = $_POST["POST_ID"];
            $NEW_POST = $_POST["NEW_POST"];
            echo "<script>echo(\"2\")</script>";
            $result = $link->query($sql);
            echo "<script>echo(\"3\")</script>";
            while($row = $result->fetch_assoc())
            {
                echo "<script>echo(\"4\")</script>";
                $CAN_POST_BE_CREATED = true;
                echo "<script>echo(\"5\")</script>";
                if(strlen($post_message) > 512)
                {
                    echo "<script>alert(\"votre poste doit faire entre 1 et 512 caractères. Merci de garder ça court\")</script>";
                    $CAN_POST_BE_CREATED = false;
                }
                echo "<script>echo(\"6\")</script>";
                // -- dirty fix done dirt cheap -- //
                $NEW_POST = str_replace("'", "\'", $NEW_POST);
                $NEW_POST = str_replace("-", "\-", $NEW_POST);
                echo "<script>echo(\"7\")</script>";
                if($row["POST_AUTHOR_ID"] == $_SESSION["id"] && $CAN_POST_BE_CREATED){
                    require("../admin/config.php");
                    echo "<script>echo(\"8\")</script>";
                    $sql = "UPDATE forum_post SET POST_MESSAGE='$NEW_POST' WHERE POST_ID=$post_id";
                    echo "<script>echo(\"9\")</script>";
                    if($link->query($sql) === true)
                    {
                        echo "<script>echo(\"10\")</script>";
                        header("location: post.php?id=$post_id");
                        exit;
                    }else{
                        echo "<script>echo(\"10\")</script>";
                        echo "<script>alert(\"une erreur est survenue : $link->error\");</script>";
                    }
                }
                echo "<script>echo(\"11\")</script>";
            }
        }else if(isset($_POST["comment"]))
        {
            
        }
    }
?>
<?php include("../entete.php");?>
<html>
<br><br><br><br>
    <head>
        <title>Postes du forum</title>
        <link rel="stylesheet" href="../index.css?rnd=132">
    </head>
    <body>
        <?php
            if(isset($_GET["id"])){
                require("../admin/config.php");
                $post_id = $_GET["id"];
                $sql = "SELECT * FROM forum_post WHERE POST_ID = $post_id";

                $result = $link->query($sql);
                while($row = $result->fetch_assoc()){
                    echo "<div id=\"text_zone_3\">";
                    echo "<textarea readonly id=\"forum_title_container\">" . $row["POST_TITLE"] . "</textarea>";
                    echo "<p>__________</p>";
                    echo "<p style=\"width: 75vw\"> créé par " . $row["POST_AUTHOR"] . " le " . $row["POST_CREATION_DATE"] . "</p>";
                    if($_SESSION["user_status"] === 1 OR $row["POST_AUTHOR_ID"] == $_SESSION["id"]){
                        echo "<form action=\"post.php\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"POST_ID\" value=\"$post_id\">";
                        echo "<input type=\"hidden\" name=\"USER_ID\" value=\"$post_id\">";
                        echo "<input type=\"hidden\" name=\"TYPE\" value=\"delete\">";
                        echo "<button type=\"submit\" name=\"delete\"><pr>supprimer</pr></button>";
                        echo "</form>";
                    }
                    if($row["POST_AUTHOR_ID"] == $_SESSION["id"]){
                        echo "<form action=\"post.php?id=$post_id\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"POST_ID\" value=\"$post_id\">";
                        echo "<input type=\"hidden\" name=\"USER_ID\" value=\"$post_id\">";
                        echo "<input type=\"hidden\" name=\"TYPE\" value=\"edit\">";
                        if(!isset($_POST["edit"]))
                        {
                            echo "<button type=\"submit\" name=\"edit\"><pr>modifier</pr></button>";
                        }
                        echo "</form>";
                    }
                    echo "</div>";

                    if(isset($_POST["edit"]))
                    {   
                        echo "<form action=\"post.php?id=$post_id\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"POST_ID\" value=\"$post_id\">";
                        echo "<textarea id=\"forum_text_container\" name=\"NEW_POST\" rows=\"14\">" . $row["POST_MESSAGE"] . "</textarea>";
                        echo "<button type=\"submit\" name=\"save\"><pr>sauvegarder</pr></button>";
                        echo "</form>";
                    }else
                    {
                        echo "<textarea readonly id=\"forum_text_container\" rows=\"14\">" . $row["POST_MESSAGE"] . "</textarea>";
                    }
                    echo "<center>
                    <form action=\"post.php\" method=\"post\">
                        <div>
                            <p>connecté en temps que $USERNAME </p>
                        </div>
                        <div>
                            <label for=\"message\"><p style=\"font-size: 24;\">votre réponse :</p></label>
                            <textarea class=\"msg\" name=\"message\" rows=\"2\" cols=\"25\" value=\"message\" required></textarea>
                        </div>
                        <div class=\"button\">
                            <button type=\"submit\" name=\"post_message\" value=\"post_comment\"><pr>répondre</pr></button>
                        </div>
                    </form></center>";
                }
                
            }   
        ?>
    </body>
</html>
<?php include("../footer.php"); ?>