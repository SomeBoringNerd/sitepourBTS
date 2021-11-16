<?php
    $NOM_DU_SITE = "localhost";
?>


<center>
    <div id="topDuSite">
        <top>
            <div class="dropdown">
            <span>
                <pb id="black">_______</pb>
                <?php echo"<a href=\"javascript:void(0)\" onclick=\"location.href='http://$NOM_DU_SITE';\">";?>
                    <pb>Menu principal</pb>
                </a>
                <pb id="black">____________</pb>
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
                <pb id="black">____________</pb>
                <?php echo"<a href=\"javascript:void(0)\" onclick=\"location.href='http://$NOM_DU_SITE/wiki/';\">";?>
                    <pb>Wiki</pb>
                </a>
                <pb id="black">____________</pb>
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
                <pb id="black">____________</pb>
                    <pb>Meta</pb>
                </a>
                <pb id="black">____________</pb>
                <div class="dropdown-content" id="drop3">

                    <?php echo"<button onClick=\"location.href='http://$NOM_DU_SITE/pages/propos_site.php';\"><pr>A propos du site</pr></button><br>"?>
                    <button onClick="location.href='https://github.com/SomeBoringNerd/sitepourBTS'"><pr>Code source (github)</pr></button><br>
                    <?php echo"<button onClick=\"location.href='http://$NOM_DU_SITE/pages/contact.php'\"><pr>contacter le gérant</pr></button><br>"?>
                    <?php echo"<button onClick=\"location.href='http://$NOM_DU_SITE/pages/mention_legale.php'\"><pr>Mentions légales</pr></button><br>"?>
                </div>
            </div>
        </top>
        <top>
        <div class="dropdown">
                <pb id="black">____________</pb>
                <?php echo "<a href=\"javascript:void(0)\" onclick=\"location.href='http://$NOM_DU_SITE/forum'\">"; ?>
                <pb>Forum (beta)</pb>
                </a>
                <pb id="black">____________</pb>
            </div>
        </top>
    </div>
</center>