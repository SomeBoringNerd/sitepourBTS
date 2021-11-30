

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
					echo "<table border=\"1\"><tr>
							<td><center><p>créateur du post </p>e</center></td>
							<td><center><p>Titre du post </p>e<c/enter></td>
							<td><center><p>date de création </p>e<c/enter></td>
						</tr>";
					while($row = $result->fetch_assoc()) 
					{
						echo "<tr>";
						$post_title = $row["POST_TITLE"];
						$post_id = $row["POST_ID"];
						$post_author = $row["POST_AUTHOR"];
						$post_creation_date = $row["POST_CREATION_DATE"];
						echo "<td><center><p style=\"padding-left: 1vw;padding-right: 1vw;\">$post_author</p></center></td>";
						echo "<td><center><p style=\"padding-left: 1vw;padding-right: 1vw;\"><a href=\"post.php?id=$post_id\">$post_title</a></p></center></td>";
						echo "<td><center><p style=\"padding-left: 1vw;padding-right: 1vw;\">$post_creation_date</p></center></td>";

						echo "</tr>";
					}
						echo "</table>";
				}else{
					echo "<center><p>Aucun poste n'a encore été publié.</p></center>";
				}

			?>
		</center>
	</body>
</html>