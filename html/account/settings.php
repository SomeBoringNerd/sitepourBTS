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
        echo "test<br>";
        $sql = "SELECT * FROM users WHERE id = $USER_ID_TO_LOAD";
        echo "test<br>";
        $answer = $mysqli->query($sql);
        echo "test<br>";
        while ($row = $answer->fetch_assoc()) {
            echo "<p> id = " . $row['id'] . "<p><br>";
            echo "<p> username = " . $row['username'] . "<p>";
        }
        echo "test<br>";
    }
        ?>
        </center>
    </body>
</html>