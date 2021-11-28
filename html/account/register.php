<?php
// Include config file
require_once "../admin/config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$TEST = $_SERVER["PHP_SELF"];
echo "<script>console.log('$TEST');</script>";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $CAN_ACCOUNT_BE_CREATED = true;
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
        $CAN_ACCOUNT_BE_CREATED = false;
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        echo "<script>alert(\"Username can only contain letters, numbers, and underscores.\");</script>";
        $CAN_ACCOUNT_BE_CREATED = false;
    } elseif(strlen(trim($_POST["password"])) > 16 OR strlen(trim($_POST["password"])) < 4){
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
                echo "<script>alert(\"Ce nom d'utilisateur est déjà pris\");</script>";
                $CAN_ACCOUNT_BE_CREATED = false;
            }
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        echo "<script>alert(\"Veuillez entrer un mot de passe\");</script>";
        $CAN_ACCOUNT_BE_CREATED = false;
    } elseif(strlen(trim($_POST["password"])) < 8)
    {
        echo "<script>alert(\"Votre mot de passe doit faire au moins 8 charactères\");</script>";
        $CAN_ACCOUNT_BE_CREATED = false;
    }else
    {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        echo "<script>alert(\"Please confirm password\");</script>";
        $CAN_ACCOUNT_BE_CREATED = false;
    }else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            echo "<script>alert(\"Password did not match\");</script>";
            $CAN_ACCOUNT_BE_CREATED = false;
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        $USER_STATUS = 0;

        $sql = "INSERT INTO users (username, user_password, USER_STATUS) VALUES ('$username_trimmed', '$param_password', '$USER_STATUS')";
        if($CAN_ACCOUNT_BE_CREATED === true)
        {
            if ($link->query($sql) === TRUE)
            {
                header("location: login.php");
            }else{
                echo "<script>alert('une erreur s'est produite : $link->error');</script>";
            }
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="fr">
    <?php include("../entete.php")?>
    <head>
        <meta charset="UTF-8">
        <title>Créer un compte</title>
        <link rel="stylesheet" href="../index.css">
        <style>
            body{ font: 14px sans-serif; }
            .wrapper{ width: 360px; padding: 20px; }
        </style>
    </head>
    <body><br><br><br><br>
        <center>
            <megaTitle>Créer un compte</megaTitle>
            <p>Remplissez ce formulaire pour créer un compte.</p>

                <form action="register.php" method="post">
                    <label><p>nom d'utilisateur</p></label>
                    <input type="text" name="username"value="<?php echo $username; ?>" required>

                    <label><p>mot de passe</p></label>
                    <input type="password" name="password" value="<?php echo $password; ?>" required>

                    <label><p>confirmez le mot de passe</p></label>
                    <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>" required>
                    <br><br>
                    <button id="button_register" type="submit" value="Submit"><pr>Valider</pr></button>
                    <button id="button_register" type="reset" value="Reset"><pr>réinitialiser</pr></button>
                    <p>vous avez déjà un compte? <a href="login.php">connectez vous ici</a>.</p>
            </form>
        <center>
    </body>
</html>