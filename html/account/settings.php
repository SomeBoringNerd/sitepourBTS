<?php
    // Initialize the session
    session_start();
    
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
        header("location: ../index.php");
        exit;

    }else{
        require "../admin/config.php";
    
        echo "
        
        <!DOCTYPE html>
        <html lang=\"fr\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Login</title>
            <link rel=\"stylesheet\" href=\"../index.css\">
        </head>
            <body>";
        
        include("../entete.php");
        echo "<br><br><br><br>
            <center>
            <megaTitle>Paramètres du compte</megaTitle>";

        $USER_ID_TO_LOAD = $_SESSION["id"];

        echo  "<br><p>" . $USER_ID_TO_LOAD . "<br>";
        echo $_SESSION["id"] . "<br></p>";

        $requete = mysql_query("SELECT * FROM users WHERE id = $USER_ID_TO_LOAD");
        
        echo "test";
        
        mysql_close(); 
        while($resultat = mysql_fetch_assoc($requete)) 
        {
            $USER_NAME = $resultat['username'];
            $LAST_ONLINE = $resultat['LAST_ONLINE'];
            echo "<form action=\"settings.php\" method=\"post\">
                <p>pseudo :</p>
                <textarea value=\"user_message\">$USER_NAME</textarea>

                <p>pseudo :</p>
                <textarea value=\"user_message\" rows=\"1\" cols=\"16\" class=\"msg\">$USER_NAME</textarea>
            </form>";
        }
    }
        ?>
        </center>
    </body>
</html>