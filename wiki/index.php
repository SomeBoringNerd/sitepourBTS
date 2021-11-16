<html>
	<head>
		<title>template.php</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="../index.css">
        <link rel="stylesheet" href="wiki-specific.css">
        
	</head>

	<body>
    <?php include("../entete.php"); ?>
		<br><br><br><br><br>
		<center>
			<megaTitle>Wiki du jeu</megaTitle><br><br>
			<p>______________________________________________________________________________</p><br>
            <div id="title">
                <p>
                    <a href="index.php#RULE">lisez les règles du wiki ici</a><br><br>
                    afin d'aider les petits nouveaux dans ce jeu, un wiki est disponible, possèdant 
                    un nombre d'informations suffisant pour vous permettre de jouer dans les meilleures conditions
                </p>
            </div>
            <p>______________________________________________________________________________</p><br>
			
			<lesserTitle id="MAIN">Personnages principaux</lesserTitle>
			<p><a href="characters/M_mc.php" target="_parent">Personnage principal || protagoniste</a></p>
            <p><a href="characters/B_bob.php" target="_parent">Bob || antagoniste</a></p>
            <p><a href="characters/PF_Sauelsuesor.php" target="_parent"><i style="color:rgb(0, 217, 255);">Sauelsuesor</i> || personnage secondaire</a></p>

            <lesserTitle id="SECO">Personnages Secondaires</lesserTitle>
			<p><a href="characters/PS_JackBright.php" target="_parent">Dr.Jack Bright || Directeur du site 19</a></p>

            <lesserTitle id="BOSS">Boss de zone</lesserTitle>
			<p><a href="characters/B_SCP-682.php" target="_parent">SCP-682 || Boss de zone</a></p>
            <p><a href="characters/B_bob.php" target="_parent">Bob || antagoniste</a></p>

            <lesserTitle id="FACT">Faction</lesserTitle>
			<p><a href="characters/F_chaos_insurgency.php" target="_parent">L'Insurrection du Chaos || Les méchants</a></p>

            <lesserTitle id="ZONE">Zones du jeu</lesserTitle>
			<p><a href="places/END_GodDomain.php" target="_parent">Domaine des dieux</a></p>
            <p><a href="places/site-19.php" target="_parent">Site 19</a></p>
            <p><a href="../pages/404.php" target="_parent">La bibliothèque des Wanderers</a></p>

            <lesserTitle id="ITEM">Objets</lesserTitle>
			<p><a href="items/IS_SCP-963.php" target="_parent">SCP-693 || L'Immortalité</a></p>

            <p>______________________________________________________________________________</p><br>
            <lesserTitle id="RULE">Lisez les règles avant de contribuer</lesserTitle>
            <p>Les briser de façon répétée menera a une interdiction de contribuer</p>
			<p>______________________________________________________________________________</p><br>
			
			
			<p>Les règles sont extremement simples, n'importe qui peut les suivres : </p><br>
            <ol>
                <li><p>>> ne pas diffuser de désinformation volontairement</p></li>
                <ol>
                    <li><smallerParagraph>Cela signifie que chaque information doit venir avec des sources</smallerParagraph></li>
                    <li><smallerParagraph>Des sources fiables bien sûr. <a href="https://archive.org/web/" target="_blank">des liens permantents de la waybackmachine sont mieux</a> que des captures d'écran</smallerParagraph></li>
                </ol>
                <li><p>>> lire et se relire afin de faire le moins d'erreur</p></li>
                <li><p>>> ne pas modifier les pages afin d'y ajouter des données malicieuses</p></li>
                <ol>
                    <li><smallerParagraph>comprend mais n'est pas limité a :</smallerParagraph></li>
                    <ol>
                        <li><smallerParagraph>Informations éronnées</smallerParagraph></li>
                        <li><smallerParagraph>Informations volontairement trompeuses</smallerParagraph></li>
                        <li><smallerParagraph>Hors sujet</smallerParagraph></li>
                        <li><smallerParagraph>Redirections vers du contenu tier</smallerParagraph></li>
                        <li><smallerParagraph>Contenu NSFW (pornographique ou extremement violents)</smallerParagraph></li>
                        <li><smallerParagraph>le Contenu illegal (ne respectant pas la loi française), sera reporté aux autoritées compétentes</smallerParagraph></li>
                    </ol>
                </ol>
            </ol>

		</center>
	</body>
</html>

<!--
    template d'entrée
    
    <p><a href="lien">nom de l'entrée || statut de l'entrée</a></p>


-->