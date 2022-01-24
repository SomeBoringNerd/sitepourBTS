<?php
    session_start();
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {           // encore un fix de merde, celui ci empeche une méthode post random
                // de pouvoir supprimer un poste sans vérification
                // note : ne PAS utiliser POST pour vérifier l'authenticité
                // d'un utilisateur
        if($_SESSION["TYPE"] == "delete"){
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
        } else if($_SESSION["TYPE" == "edit"])
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
                        echo "<form action=\"post.php\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"POST_ID\" value=\"$post_id\">";
                        echo "<input type=\"hidden\" name=\"USER_ID\" value=\"$post_id\">";
                        echo "<input type=\"hidden\" name=\"TYPE\" value=\"edit\">";
                        echo "<button type=\"submit\" name=\"edit\"><pr>modifier</pr></button>";
                        echo "</form>";
                    }
                    echo "</div>";
                        // oui, utiliser <p> active une vulnérabilité. 
                        // oui, je pourrais chercher un moyen de contourner le problème
                        // et oui, ça rend mieux au final.
                    echo "<textarea readonly id=\"forum_text_container\" rows=\"14\">" . $row["POST_MESSAGE"] . "</textarea>";
                    }
                
            }   
        ?>
    </body>
</html>
<?php include("../footer.php"); ?>