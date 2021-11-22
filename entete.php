<?php
    session_start();

    // variable pour simplifier le déploiment du site
    $NOM_DU_SITE = "localhost";

    // nom d'utilisateur par défaut
    $USERNAME = "not connected";

    // si une session existe
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        // infos de connexion a la base de donnée users
        require("admin/config.php");

        // quelques variables
        $USERNAME = $_SESSION["username"];
        

        $param_date = date("Y-m-d h:i:s", $_SERVER["REQUEST_TIME"]);
        $param_id = $_SESSION["id"];
        $user_status = $_SESSION["user_status"];
        
        // code MySQL pour update la dernière date de connexion au site
        $sql = "UPDATE users SET LAST_ONLINE='$param_date' WHERE id=$param_id";

        // pas de fallback, l'opération étant 
        // pas super importante, si elle échoue c'est pas grave
        if ($link->query($sql) === TRUE) {
        } 
        // ferme la connexion avec la base de donnée
        $link->close();
    }
?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <center>
        <div id="topDuSite">
            <top>
                <div class="dropdown">
                    <span>
                        <?php echo"<a href=\"javascript:void(0)\" onclick=\"location.href='http://$NOM_DU_SITE';\">";?>
                            <pb>Menu principal</pb>
                        </a>
                        <pb id="black">_________</pb>
                    </span>
                    <div class="dropdown-content" id="drop1">
                        <?php echo"<button onClick=\"location.href='http://$NOM_DU_SITE/'\"><pr>Page principale</pr></button><br>"; ?>
                        <?php echo"<button onClick=\"location.href='http://$NOM_DU_SITE/pages/Contributeur.php'\"><pr>liste des contributeurs</pr></button><br>"?>
                        <?php echo"<button onClick=\"location.href='http://$NOM_DU_SITE/pages/FAQ.php'\"><pr>Foire aux questions</pr></button><br>"?>
                    </div>
                </div>
            </top>
            <top>
                <div class="dropdown">
                    <pb id="black">_________</pb>
                    <?php echo"<a href=\"javascript:void(0)\" onclick=\"location.href='http://$NOM_DU_SITE/wiki/';\">";?>
                        <pb>Wiki</pb>
                    </a>
                    <pb id="black">_________</pb>
                    <div class="dropdown-content" id="drop2">

                        <?php echo"<button onClick=\"location.href='http://$NOM_DU_SITE/wiki/index.php';\"><pr>Page principale</pr></button><br>"?>
                        <?php echo"<button onClick=\"location.href='http://$NOM_DU_SITE/wiki/index.php#MAIN';\"><pr>Personnages disponibles</pr></button><br>"?>
                        <?php echo"<button onClick=\"location.href='http://$NOM_DU_SITE/wiki/index.php#ITEM';\"><pr>Les Objets disponibles</pr></button><br>"?>
                        <?php echo"<button onClick=\"location.href='http://$NOM_DU_SITE/wiki/index.php#ZONE';\"><pr>Les Endroits</pr></button><br>"?>
                    </div>
                </div>
            </top>
            <top>
                <div class="dropdown">
                    <pb id="black">_________</pb>
                    <?php echo "<a href=\"javascript:void(0)\" onclick=\"location.href='http://$NOM_DU_SITE/forum'\">"; ?>
                    <?php echo "<pb>compte ($USERNAME)</pb></a>";?>
                    <div class="dropdown-content" id="drop4">
                        <?php
                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                                echo"<button onClick=\"location.href='http://$NOM_DU_SITE/forum/index.php';\"><pr>Forum (beta)</pr></button><br>";
                            }
                        ?>
                        <button onClick="location.href='https://github.com/SomeBoringNerd/sitepourBTS'"><pr>Code source (github)</pr></button><br>
                        
                        <?php 
                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                                $USER_ID = $_SESSION["id"];
                                echo"<button onClick=\"location.href='http://$NOM_DU_SITE/account/account.php?id=$USER_ID'\"><pr>mon compte</pr></button><br>";
                                if($user_status === 1){
                                    echo"<button onClick=\"location.href='http://$NOM_DU_SITE/admin/messages.php'\"><pr>acceder aux messages</pr></button><br>";
                                    echo"<button onClick=\"location.href='http://$NOM_DU_SITE/admin/users.php'\"><pr>Gérer les utilisateurs</pr></button><br>";
                                    echo"<button onClick=\"location.href='http://$NOM_DU_SITE/phpmyadmin'\"><pr>PhPMyAdmin</pr></button><br>";
                                }else{
                                    echo"<button onClick=\"location.href='http://$NOM_DU_SITE/pages/contact.php'\"><pr>contacter le gérant</pr></button><br>";
                                }
                                echo"<button onClick=\"location.href='http://$NOM_DU_SITE/account/logout.php'\"><pr>Déconnexion</pr></button><br>";
                            } else{
                                echo"<button onClick=\"location.href='http://$NOM_DU_SITE/account/register.php'\"><pr>créer un compte</pr></button><br>";
                                echo"<button onClick=\"location.href='http://$NOM_DU_SITE/account/login.php'\"><pr>se connecter</pr></button><br>";
                            }
                        ?>
                    </div>
                </div>
            </top>
            </top>
            
        </div>
    </center>