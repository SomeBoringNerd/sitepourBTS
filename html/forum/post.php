<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST" or isset($_POST["delete"]))
    {
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
                    echo "</div>";
                        // oui, utiliser <p> active une vulnérabilité. 
                        // oui, je pourrais chercher un moyen de contourner le problème
                        // et oui, ça rend mieux au final.
                    echo "<textarea readonly id=\"forum_text_container\" rows=\"14\">" . $row["POST_MESSAGE"] . "</textarea>";
                    /*echo $row["POST_AUTHOR_ID"];
                    echo "<br>";
                    echo $_SESSION["id"];       troubleshooting du mendiant
                    echo "<br>";
                    echo $_SESSION["id"] == $row["POST_AUTHOR_ID"]; utiliser === empêche le check de se faire*/
                    if($_SESSION["user_status"] === 1 OR $row["POST_AUTHOR_ID"] == $_SESSION["id"]){
                        echo "<form action=\"post.php\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"POST_ID\" value=\"$post_id\">";
                        echo "<input type=\"hidden\" name=\"USER_ID\" value=\"$post_id\">";
                        echo "<button id=\"forum_delete_button\" type=\"submit\" name=\"delete\"><pr>supprimer</pr></button>";
                        echo "</form>";
                    }
                }
                
            }   
        ?>
    </body>
</html>
<?php include("../footer.php"); ?>