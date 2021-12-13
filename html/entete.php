<?php
    session_start();

    // nom d'utilisateur par défaut
    $USERNAME = "connexion";

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
        
        $link->query($sql);
    }
?>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
</head>

    <div id="topDuSite_Mobile">
        <div>
            <input type="checkbox" name="my-checkbox" type="hidden" id="toggle_menu">
            <img src="/rescources/tab.png" onclick="toggle()" name="bouton_toggle_mobile">
            </input>
        </div>
        <br>
        <div id="mobile_menu" name="topmobile_child">

            <?php
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                $ID = $_SESSION["id"];
                echo "<a href=\"javascript:void(0)\" onclick=\"location.href='/account/account.php?id=$ID'\">"; 
            }
            else{
                echo "<a href=\"javascript:void(0)\" onclick=\"location.href='/account/login.php'\">"; 
            }
            
            echo "<p>$USERNAME</p></a>";?>

            <p>Menu principal</p>
            <?php echo"<button onClick=\"location.href='/index.php'\"><pr>Page principale</pr></button><br>"; ?>
            <?php echo"<button onClick=\"location.href='/pages/Contributeur.php'\"><pr>liste des contributeurs</pr></button><br>"?>
            <?php echo"<button onClick=\"location.href='/pages/FAQ.php'\"><pr>Foire aux questions</pr></button><br>"?>

            <p>wiki</p>
            <?php echo"<button onClick=\"location.href='/wiki/index.php';\"><pr>Page principale</pr></button><br>"?>
            <?php echo"<button onClick=\"location.href='/wiki/index.php#MAIN';\"><pr>Personnages disponibles</pr></button><br>"?>
            <?php echo"<button onClick=\"location.href='/wiki/index.php#ITEM';\"><pr>Les Objets disponibles</pr></button><br>"?>
            <?php echo"<button onClick=\"location.href='/wiki/index.php#ZONE';\"><pr>Les Endroits</pr></button><br>"?>
            
            <p>mon compte</p>
            <?php
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                    
                    echo"<button onClick=\"location.href='/forum/index.php';\"><pr>Forum (beta)</pr></button><br>";

                    $USER_ID = $_SESSION["id"];
                    echo"<button onClick=\"location.href='/account/account.php?id=$USER_ID'\"><pr>mon compte</pr></button><br>";
                    echo "<button onClick=\"location.href='settings.php';\"><pr>Paramètres</pr></button><br>";
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

    <script>
        var togg1 = document.getElementById("bouton_toggle_mobile");
        var d1 = document.getElementById("mobile_menu");
        var d2 = document.getElementById("toggle_menu");

        d1.style.display = "none";
        d2.style.display = "none";

        function toggle() {
            d1.style.display = (getComputedStyle(d1).display != "none") ? d1.style.display = "none" : d1.style.display = "block";
            console.log("d1 est actuellement a " + d1.style.display.toString());
        }
    </script>

    <center>
        
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
                                $USER_ID = $_SESSION["id"];
                                echo"<button onClick=\"location.href='/account/account.php?id=$USER_ID'\"><pr>mon compte</pr></button><br>";
                                echo "<button onClick=\"location.href='settings.php';\"><pr>Paramètres</pr></button><br>";
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
