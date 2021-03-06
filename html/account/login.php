<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}
 
// Include config file
require_once "../admin/config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Entrez un nom d'utilisateur.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, user_password, USER_STATUS, TOKEN FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $user_status, $token);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            // mot de passe valide, let's go
                            session_start();

                            // on stocke les donn??es dans la session 
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;    
                            // 1 : admin, 2 : moderator, 3 : wiki editor                        
                            $_SESSION["user_status"] = $user_status;

                            
                            echo "<script>console.log('fini');</script>";
                            // Redirect user to welcome page
                            header("location: ../index.php");
                        } else
                        {
                            // Erreur g??n??rique
                            $login_err = "<p>mot de passe incorrect</p>";
                        }
                    }
                } else
                {
                    // Erreur g??n??rique
                    $login_err = "<p>nom d'utilisateur incorrect</p>";
                }
            } else
            {
                echo "<p>Une erreur s'est produite, veuillez re-essayer plus tard</p>";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../index.css?rnd=132">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body><?php include("../entete.php");?><br><br><br><br>
    <center>
        <megaTitle>Connexion</megaTitle>
        <p>Connectez vous ici.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label><p>nom d'utilisateur</p></label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <label><p>mot de passe</p></label>
            <input type="password" name="password">
            <br>
            <br>
            <button type="submit" value="Login"><pr>valider</pr></button>
            <p>Pas de compte ? <a href="register.php">Cr??ez en un!</a>.</p>
        </form>
    </center>
</body>
</html>
<?php include("../footer.php"); ?>