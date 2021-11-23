<?php?>

<html>
	<head>
		<title>template.html</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="../index.css">
	</head>
	
	<body>
	<?php include("../entete.php"); ?>
		<br>
		<br><br><br>
		<center>
			<megaTitle>Forum.php</megaTitle><br><br>
			<lesserTitle>En cours de construction</lesserTitle>
			<a href="create.php"><p>créer un poste</p></a>
			<p>______________________________________________________________________________</p><br>
			<p>Postes publiés :</p>
			<?php
				require("../admin/config.php");
				$sql = "SELECT * FROM forum_post";

				$result = $link->query($sql);

				if ($result->num_rows > 0) 
				{// logiquement, le résultat devrait retourner une seule valeur 
				// donc utiliser une boucle est valide même si c'est une mauvaise idée
					while($row = $result->fetch_assoc()) 
					{
						$post_title = $row["POST_TITLE"];
						$post_id = $row["POST_ID"];
						echo "<a href=\"post.php?id=$post_id\"><p>$post_title</p></a>";
					}
				}else{
					echo "<center><p>Aucun poste n'a encore été publié.</p></center>";
				}

			?>
		</center>
	</body>
</html>