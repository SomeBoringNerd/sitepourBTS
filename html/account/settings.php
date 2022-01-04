<?php
    echo "test ";
    session_start();
    echo "test 1";
    require("../admin/config.php");
    echo "test 2";
    $USER_ID_TO_LOAD = $_SESSION["id"];
    echo "test 3";
    include("../entete.php");

    echo" <head>
    <title>Settings</title>
    <link rel=\"stylesheet\" href=\"../index.css?rnd=132\">
</head>";

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
                //$PFP_URL = $row["PFP_URL"];
                
                echo "
                <br><br><br><br>
                <html>
                    <body>
                        <center>
                            <megaTitle>Paramètres</megaTitle>
                        </center>
                        
                        <center>
                        <form action=\"settings.php\" enctype=\"multipart/form-data\" method=\"post\">
                            <div>
                                <p>connecté en temps que $USERNAME</p>
                            </div>
                            <br>
                            
                            <div>
                                <label for=\"msg\"><p style=\"font-size: 40;\">Pseudo :</p></label>
                                <textarea id=\"msg\" name=\"USERNAME\" rows=\"1\" cols=\"16\" class=\"msg\" value=\"user_message\" required>$USERNAME</textarea>
                            </div><br>
                            <div>
                                <label for=\"msg\"><p style=\"font-size: 40;\">URL de votre photo de profile :</p></label>
                                <textarea id=\"msg\" name=\"PFP_URL\" rows=\"1\" cols=\"20\" class=\"msg\" value=\"user_message\" required>$PFP_URL</textarea>
                            </div><br>
                            <div>
                                <label for=\"msg\"><p style=\"font-size: 40;\">Bio :</p></label>
                                <textarea id=\"msg\" name=\"USER_BIO\" rows=\"7\" cols=\"20\" class=\"msg\" value=\"user_message\" required>$USER_BIO</textarea>
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
                
                // dirty fix done dirt cheap.
                // Dojyaaa~~n et ça marche !
                $NEW_BIO = str_replace("'", "\'", $NEW_BIO);
                $NEW_BIO = str_replace("-", "\-", $NEW_BIO);

                $CAN_ACCOUNT_BE_CREATED = true;
                /*
                $filename = $_FILES["choosefile"]["$USER_ID_TO_LOAD"];

                $tempname = $_FILES["choosefile"]["tmp_name"];  

                $folder = "//rescources//ProfilePic//".$filename;   

                if (move_uploaded_file($tempname, $folder)) {

                    $msg = "Image uploaded successfully";
        
                }else{
        
                    $msg = "Failed to upload image";
        
                }
                */
                if(strlen(trim($NEW_BIO)) > 512)
                {
                    echo "<script>alert(\"Votre bio ne peut contenir plus de 512 caractères.\");</script>";
                    $CAN_ACCOUNT_BE_CREATED = false;
                }
 
                // Validate username
                if(empty(trim($_POST["USERNAME"]))){
                    echo "<script>alert(\"Veuillez entrer un nom d'utilisateur.\");</script>";
                    $CAN_ACCOUNT_BE_CREATED = false;
                } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["USERNAME"]))){
                    echo "<script>alert(\"Le nom d'utilisateur peut seulement contenir des chiffres, des lettres et des underscores.\");</script>";
                    $CAN_ACCOUNT_BE_CREATED = false;
                } elseif(strlen(trim($_POST["USERNAME"])) > 16 OR strlen(trim($_POST["USERNAME"])) < 4){
                    echo "<script>alert(\"votre nom d'utilisateur doit faire entre 4 et 16 charactères\");</script>";
                    $CAN_ACCOUNT_BE_CREATED = false;
                }
                else{
            
                    $username_trimmed = trim($_POST["username"]);
            
                    // Prepare a select statement
                    $sql = "SELECT id FROM users WHERE username = $username_trimmed";
            
                    if ($link->query($sql) === TRUE)
                    {
                        $result = $link->query($sql);
            
                        if ($result->num_rows === 0)
                        {
                            $username = trim($_POST["username"]);
                        }
                        else
                        {
                            while($row = $result->fetch_assoc()) {
                                $ID = $row["id"];

                                if($ID === $USER_ID){
                                    $username = trim($_POST["username"]);
                                }else{
                                    echo "<script>alert(\"Ce nom d'utilisateur est déjà pris\");</script>";
                                    $CAN_ACCOUNT_BE_CREATED = false;
                                }
                            }
                        }
                    }
                }
                
                if($CAN_ACCOUNT_BE_CREATED === true){
                    //@TODO : permettre de changer le mot de passe
                    if(isset($_POST['PASSWORD'])){}

                    $sql = "UPDATE users SET username='$USERNAME', USER_BIO='$NEW_BIO' /*, PP_NAME='$filename'*/ WHERE id=$USER_ID_TO_LOAD";

                    if ($link->query($sql) === TRUE){
                        $_SESSION['username'] = $USERNAME;
   
                    }else{
                        echo $link->error;
                    }

                    header("location: account.php");
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
<?php include("../footer.php"); ?>