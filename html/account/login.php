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

    function random_str(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
 
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
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;    
                            // 1 : admin, 2 : moderator, 3 : wiki editor                        
                            $_SESSION["user_status"] = $user_status;

                            // ce code sert a fetch un token de connexion qui
                            // pourrait exister dans la base de donnée.
                            // habituellement, conserver une donnée quelconque 
                            // dans les cookies est une mauvaise idée
                            // car il est possible de le falsifier (aka "dont trust the client").
                            // mais un identifiant unique de longueur 64 devrait être safe.

                            // @TODO : permettre de login quelqu'un avec son token.
                            //         une façon valide de faire ça serai de fetch
                            //         le token depuis $_COOKIE puis de regarder
                            //         quel row de la base de donnée contient ces 
                            //         données, puis d'associer les valeurs requises
                            //         dans le $_SESSION.
                            //         cependant, il serai plus utile et simple de 
                            //         mettre ça dans entete.php                                        

                            // premier cas : token dans le compte, token dans les cookies (on remplace si c'est pas le même)
                            if(isset($token) && isset($_COOKIE['token']))
                            {
                                if($token != $_COOKIE['token'])
                                {
                                    $_COOKIE['token'] = $token;
                                }
                            }
                            // si y'a un token ni dans le compte, ni dans les cookies, on le génère
                            else if(!isset($token) && !isset($_COOKIE['token']))
                            {

                                $rand_token = openssl_random_pseudo_bytes(128);
                                
                                $token = bin2hex($rand_token);

                                $gen_token = $token;
                                $sql = "UPDATE users SET TOKEN=$gen_token WHERE id=$id";

                                if ($link->query($sql) === TRUE) 
                                {
                                    echo "<script>console.log(\"Token généré : $gen_token\");</script>";
                                    setcookie("token", $token, time() + (86400 * 14), "/");
                                }
                                else
                                {
                                    echo "<script>console.log(\"Une erreur s'est produite : $link->error || token : $gen_token\");</script>";
                                }
                            }
                            // si un token existe dans le compte, mais pas dans les cookies
                            else if(isset($token) && !isset($_COOKIE['token']))
                            {
                                $sql = "SELECT * FROM users WHERE id=$id";

                                $result = $link->query($sql);

                                if ($result->num_rows > 0) 
                                {// logiquement, le résultat devrait retourner une seule valeur 
                                // donc utiliser une boucle est valide même si c'est une mauvaise idée
                                    while($row = $result->fetch_assoc()) 
                                    {                      // timestamp actuelle + 14 jours pour expirer le cookie
                                        setcookie("token", $row['token'], time() + (86400 * 14), "/", "troughthedark.ddns.net:50001/" ,false, true);
                                    }
                                }
                            }

                            // Redirect user to welcome page
                            //header("location: ../index.php");
                        } else
                        {
                            // Password is not valid, display a generic error message
                            $login_err = "<p>mot de passe incorrect</p>";
                        }
                    }
                } else
                {
                    // Username doesn't exist, display a generic error message
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
            <p>Pas de compte ? <a href="register.php">Créez en un!</a>.</p>
        </form>
    </center>
</body>
</html>