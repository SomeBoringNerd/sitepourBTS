<html>
	<head>
		<title>Calculator-3000 PHP Edition</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="index.css?rnd=132">
	</head>
    
	<body>
		<center>
			<h1> Résultat du Multiplicator-4000</h1>
			
		</center>
	</body>
</html>
<?php
    
	
    $display_errors = ini_get('display_errors');
    ini_set('display_errors', 0);
	
	$intForLoop = 1;
	
	echo "<center><h2>les tables de 1 a 9</h2>";
	
	echo "<table border=\"1\">";
	
	for($x = 0; $x < 3; $x++)
	{
		echo "<tr>";
		for($y = 0; $y < 3; $y++)
		{
			echo "<td>";
			echo "<center><p>$intForLoop<p><center>";
			echo "<table border=\"1\">";		
			for($z = 1; $z < 10; $z++)
			{
				echo "<tr>";
					echo "<td>";
						echo "<p> $intForLoop x $z </p>";
					echo "</td>";
					echo "<td>";
						echo "<p>";
						echo $intForLoop * $z;
						echo "</p>";
					echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			$intForLoop++;
			echo "</td>";
		}
		echo "</tr>";
	}
	
	echo "</table>";
	
	echo "</h3></center>";
?>

