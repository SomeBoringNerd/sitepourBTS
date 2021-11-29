<?php
    session_start();

    // nom d'utilisateur par défaut
    $USERNAME = "déconnecté";

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
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
</head>
    <center>
        <div id="topDuSite">
            <img src="/resources/tab.png">
        </div>
        <div id="topDuSite">
            <top>
                <div class="dropdown">
                    <span>
                        <?php echo"<a href=\"javascript:void(0)\" onclick=\"location.href='/index.php';\">";?>
                            <pb>Menu principal</pb>
                        </a>
                    </span>
                    <div class="dropdown-content" id="drop1" style="right: 0.5vw;">
                        <?php echo"<button onClick=\"location.href='/index.php'\"><pr>Page principale</pr></button><br>"; ?>
                        <?php echo"<button onClick=\"location.href='/pages/Contributeur.php'\"><pr>liste des contributeurs</pr></button><br>"?>
                        <?php echo"<button onClick=\"location.href='/pages/FAQ.php'\"><pr>Foire aux questions</pr></button><br>"?>
                    </div>
                </div>
            </top>
            <pb id="black">_________</pb>
            <top>
                <div class="dropdown">
                    <?php echo"<a href=\"javascript:void(0)\" onclick=\"location.href='/wiki/';\">";?>
                        <pb>Wiki</pb>
                    </a>
                    <div class="dropdown-content" id="drop2" style="left: -11vw;">

                        <?php echo"<button onClick=\"location.href='/wiki/index.php';\"><pr>Page principale</pr></button><br>"?>
                        <?php echo"<button onClick=\"location.href='/wiki/index.php#MAIN';\"><pr>Personnages disponibles</pr></button><br>"?>
                        <?php echo"<button onClick=\"location.href='/wiki/index.php#ITEM';\"><pr>Les Objets disponibles</pr></button><br>"?>
                        <?php echo"<button onClick=\"location.href='/wiki/index.php#ZONE';\"><pr>Les Endroits</pr></button><br>"?>
                    </div>
                </div>
            </top>
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
            <pb id="black">_________</pb>
            <top>
                <div class="dropdown">
                    <?php
                    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                        $ID = $_SESSION["id"];
                        echo "<a href=\"javascript:void(0)\" onclick=\"location.href='/account/account.php?id=$ID'\">"; 
                    }
                    else{
                        echo "<a href=\"javascript:void(0)\" onclick=\"location.href='/account/login.php'\">"; 
                    }
                    
                    echo "<pb>$USERNAME</pb></a>";?>

                    <div class="dropdown-content" id="drop4" style="left: -8vw;">
                        <?php
                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                                echo"<button onClick=\"location.href='/forum/index.php';\"><pr>Forum (beta)</pr></button><br>";
                            }
                        ?>
                        
                        
                        <?php 
                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                                $USER_ID = $_SESSION["id"];
                                echo"<button onClick=\"location.href='/account/account.php?id=$USER_ID'\"><pr>mon compte</pr></button><br>";
                                if($user_status === 1){
                                    echo"<button onClick=\"location.href='/admin/messages.php'\"><pr>acceder aux messages</pr></button><br>";
                                    echo"<button onClick=\"location.href='/admin/users.php'\"><pr>Gérer les utilisateurs</pr></button><br>";
                                    echo"<button onClick=\"location.href='/phpmyadmin'\"><pr>PhPMyAdmin</pr></button><br>";
                                }else{
                                    echo"<button onClick=\"location.href='/pages/contact.php'\"><pr>contacter le gérant</pr></button><br>";
                                    echo "<button onClick=\"location.href='https://github.com/SomeBoringNerd/sitepourBTS'\"><pr>Code source (github)</pr></button><br>";
                                }
                                echo"<button onClick=\"location.href='/account/logout.php'\"><pr>Déconnexion</pr></button><br>";
                            } 
                            else{
                                echo "<button onClick=\"location.href='https://github.com/SomeBoringNerd/sitepourBTS'\"><pr>Code source (github)</pr></button><br>";
                                echo"<button onClick=\"location.href='/account/register.php'\"><pr>créer un compte</pr></button><br>";
                                echo"<button onClick=\"location.href='/account/login.php'\"><pr>se connecter</pr></button><br>";
                            }
                        ?>
                    </div>
                </div>
            </top>            
        </div>
    </center>