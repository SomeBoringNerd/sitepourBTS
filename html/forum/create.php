<?php
    session_start();

    require("../admin/config.php");

    // check si une session existe
	if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
		header("location: ../account/login.php");
		exit;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        $post_author = $_SESSION["username"];
        $post_author_id = $_SESSION["id"];
        $post_title = $_POST["title"];
        $post_message = $_POST["message"];
        $post_image = $_POST["image_url"];

        if(isset($post_image))
        {
            $post_image = "https://i.stack.imgur.com/ajwm5.png";
        }

        $sql = "INSERT INTO forum_post (POST_AUTHOR, POST_TITLE, POST_MESSAGE, POST_IMAGE_URL, POST_AUTHOR_ID) values ('$post_author', '$post_title', '$post_message', '$post_image', '$post_author_id')";

        if ($link->query($sql) === TRUE)
        {
            header("location: index.php");
        }else
        {
            echo "<script>alert('une erreur s'est produite : $link->error');</script>";
        }

    }
?>

<html>

    <head>
        <title>Créer un poste</title>
        <link rel="stylesheet" href="../index.css?rnd=132">
    </head>
    <body>
        <?php include("../entete.php") ?><br><br><br><br>
        <center>
            <form action="create.php" method="post">
                <div>
                    <?php echo"<p>connecté en temps que $USERNAME </p>" ?>
                </div>
                <div>
                    <label for="title"><p style="font-size: 32;">Titre :</p></label>
                    <textarea class="msg" name="title" rows="1" cols="25" value="title" required></textarea>
                </div>
                <div>
                    <label for="image_url"><p style="font-size: 32;">url d'image (facultatif) :</p></label>
                    <textarea class="msg" name="image_url" rows="1" cols="25" value="image_url" ></textarea>
                </div>
                <div>
                    <label for="message"><p style="font-size: 32;">Message :</p></label>
                    <textarea class="msg" name="message" rows="7" cols="50" value="message" required></textarea>
                </div><br>
                <div class="button">
                    <p>Envoyer le message</p>
                    <button type="submit" name="post_message" value="post_message"><pr>Créer le post</pr></button>
                        
                </div>
            </form>
        </center>
   
    </body>
</html>
<?php include("/footer.php"); ?>