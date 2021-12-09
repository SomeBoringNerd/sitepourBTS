<?php
// ce code sert a fetch un token de connexion qui
// pourrait exister dans la base de donnée.
// habituellement, conserver une donnée quelconque 
// dans les cookies est une mauvaise idée
// car il est possible de le falsifier (aka "dont trust the client").
// mais un identifiant unique de longueur 128 devrait être safe.

// @TODO : permettre de login quelqu'un avec son token.
//         une façon valide de faire ça serai de fetch
//         le token depuis $_COOKIE puis de regarder
//         quel row de la base de donnée contient ces 
//         données, puis d'associer les valeurs requises
//         dans le $_SESSION.
//         cependant, il serai plus utile et simple de 
//         mettre ça dans entete.php    

// lors du register, le token n'a aucun problème a se générer, 


// premier cas : token dans le compte, token dans les cookies (on remplace si c'est pas le même)
if(isset($token) && isset($_COOKIE['token']))
{
    if($token != $_COOKIE['token'])
    {
        $_COOKIE['token'] = $token;
        echo "<script>console.log('cas 1');</script>";
    }
}
// si y'a un token ni dans le compte, ni dans les cookies, on le génère
else if(!isset($token) && !isset($_COOKIE['token']))
{
    echo "<script>console.log('cas 2');</script>";
    $rand_token = openssl_random_pseudo_bytes(128);
    
    $token = bin2hex($rand_token);

    $gen_token = $token;
    $sql = "UPDATE users SET TOKEN=$gen_token WHERE id=$id";

    if ($link->query($sql) === TRUE) 
    {
        $final_token = $row['token'];
        setcookie("token", $final_token, time() + (86400 * 14), "/", "troughthedark.ddns.net:50001/" ,false, true);

        $_COOKIE["token"] = $final_token;
    }
    else
    {
        echo "<script>console.log(\"Une erreur s'est produite : $link->error || token : $gen_token\");</script>";
    }
}
// si un token existe dans le compte, mais pas dans les cookies
else if(isset($token) && !isset($_COOKIE['token']))
{
    echo "<script>console.log('cas 3');</script>";
    $sql = "SELECT * FROM users WHERE id=$id";

    $result = $link->query($sql);

    if ($result->num_rows > 0) 
    {// logiquement, le résultat devrait retourner une seule valeur 
    // donc utiliser une boucle est valide même si c'est une mauvaise idée
        while($row = $result->fetch_assoc()) 
        {                     
            $final_token = $row['TOKEN'];

            $cookie_param = array(
                'samesite' => 'Strict' // None || Lax  || Strict
            );
                                // timestamp actuelle + 14 jours pour expirer le cookie
            setcookie("token", $final_token , time() + (86400 * 14), "/", ".troughthedark.ddns.net" ,false, true, $cookie_param);
            echo "<script>console.log('test :". $row['token']."');</script>";
            echo "<script>console.log('test + $final_token');</script>";
            $_COOKIE["token"] = $final_token;
        }
    }
}





/*

            ENTETE.PHP

    sous menu "blog"
*/
?>

<pb id="black">_________</pb>
<top>
    <div class="dropdown">
        
        <?php echo"<a href=\"javascript:void(0)\" onclick=\"location.href='/wiki/';\">";?>
            <pb>Blog</pb>
        </a>
        <div class="dropdown-content" id="drop2" style="left: -11vw;">

            <?php echo"<button onClick=\"location.href='/wiki/index.php';\"><pr>Page principale</pr></button><br>"?>
            <?php echo"<button onClick=\"location.href='/wiki/index.php#MAIN';\"><pr>Personnages disponibles</pr></button><br>"?>
            <?php echo"<button onClick=\"location.href='/wiki/index.php#ITEM';\"><pr>Les Objets disponibles</pr></button><br>"?>
            <?php echo"<button onClick=\"location.href='/wiki/index.php#ZONE';\"><pr>Les Endroits</pr></button><br>"?>
        </div>
    </div>
</top>
            



<?php































?>