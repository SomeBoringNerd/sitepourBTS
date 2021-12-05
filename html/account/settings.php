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
                $USER_ID = $row["id"];
                $USER_BIO = $row["USER_BIO"];

                include("../entete.php");
                echo "
                <br><br><br><br>
                <html>
                    <head>
                        <title>Settings</title>
                        <link rel=\"stylesheet\" href=\"../index.css?rnd=132\">
                    </head>
                    <body>
                        <center>
                            <megaTitle>Paramètres</megaTitle>
                        </center>
                        <br>
                        <div id=\"border_pic\" name=\"Nom d'utilisateur\">
                            <img src=\"../rescources/ProfilePic/$USER_ID.png\" height=\"256\" width=\"256\" id=\"img_settings\">
                        </div>
                        <center>
                        <form action=\"settings.php\" method=\"post\">
                            <div>
                                <p>connecté en temps que $USERNAME </p>
                            </div>
                            <div>
                                <label for=\"msg\"><p style=\"font-size: 40;\">Pseudo :</p></label>
                                <textarea id=\"msg\" name=\"USERNAME\" rows=\"1\" cols=\"16\" class=\"msg\" value=\"user_message\" required>$USERNAME</textarea>
                            </div><br>
                            <div>
                                <label for=\"msg\"><p style=\"font-size: 40;\">Bio :</p></label>
                                <textarea id=\"msg\" name=\"USER_BIO\" rows=\"7\" cols=\"50\" class=\"msg\" value=\"user_message\" required>$USER_BIO</textarea>
                            </div><br>
                            <div class=\"button\">
                            <p>Envoyer le message</p>
                            <button id=\"button_register\" type=\"submit\" value=\"Submit\"><pr>Mettre a jour le profil</pr></button>
                                    
                            </div>
                        </form>
                        </center>
                    ";
            }

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $USERNAME = $_POST['USERNAME'];
                $NEW_BIO = $_POST['USER_BIO'];

                $CAN_ACCOUNT_BE_CREATED = true;
 
                // Validate username
                if(empty(trim($_POST["USERNAME"]))){
                    $username_err = "Please enter a username.";
                    $CAN_ACCOUNT_BE_CREATED = false;
                } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["USERNAME"]))){
                    echo "<script>alert(\"Username can only contain letters, numbers, and underscores.\");</script>";
                    $CAN_ACCOUNT_BE_CREATED = false;
                } elseif(strlen(trim($_POST["USERNAME"])) > 16 OR strlen(trim($_POST["USERNAME"])) < 4){
                    echo "<script>alert(\"votre nom d'utilisateur doit faire entre 4 et 16 charactères\");</script>";
                    $CAN_ACCOUNT_BE_CREATED = false;
                }
                
                if($CAN_ACCOUNT_BE_CREATED === true){
                    //@TODO : permettre de changer le mot de passe
                    if(isset($_POST['PASSWORD'])){

                    }


                    $sql = "UPDATE users SET username='$USERNAME', USER_BIO='$NEW_BIO' WHERE id=$USER_ID_TO_LOAD";

                    if ($link->query($sql) === TRUE){
                        $_SESSION['username'] = $USERNAME;

                        header("location: settings.php");
                    }else{
                        echo $link->error;
                    }
                }
            }   
        }
        else{
            header("location: login.php");
        } 
    }
?>

    </body>
</html>