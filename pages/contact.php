<?php
	session_start();

	// check si une session existe
	if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
		header("location: ../account/login.php");
		exit;
	}
	// on récup le nom d'utilisateur et les settings de connexion de la db
	$USERNAME = $_SESSION["username"];
	require_once("../admin/config.php");
	
	// dans ce cas, une requete POST EXISTE
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// on récupère le message
		$MESSAGE = $_POST["user_message"];
        
		// quelques variables
        $param_date = "" + date_timestamp_get(date_create());
        $param_id = $_SESSION["id"];
        $user_status = $_SESSION["user_status"];
		$false = false;

		// requete MySQL pour ajouter une entrée dans la base de donnée de contact
        $sql = "INSERT INTO contact_messages (MESSAGE_AUTHOR, MESSAGE_CONTENT, MESSAGE_AUTHOR_ID) VALUES ('$USERNAME', '$MESSAGE', '$param_id')";

		// si ça marche
        if ($link->query($sql) === TRUE) {
			echo "<script>alert('votre message a bien été envoyé')</script>";
        } 
		else { //sinon on print une alerte et la raison de l'erreur
            echo "<script>alert('une erreur s'est produite : $link->error');</script>";
        }
		// on ferme la connexion avec la base de donnée
        $link->close();
	}
?>

<html>
	<head>
		<title>Contact.wtf</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="../index.css">
	</head>
	<body>
	<?php include("../entete.php"); ?>
		<center>
			
			<br><br><br><br><br>

			<megaTitle>Page de contact</megaTitle><br><br>
			<lesserTitle>vous pouvez venir me contacter ici</lesserTitle>
			
			<p>______________________________________________________________________________</p>
			
		</center>
			<img src="../rescources/img/kill_me.png" width="750" height="300" id="end_my_sufferings" 
			title="tuez moi j'ai perdu 3h de ma vie a placer ce truc au bon endroit">
			
			<center>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<div id="contact_border">
                <form action="contact.php" method="post">
					<div>
						<?php echo"<p>connecté en temps que $USERNAME </p>" ?>
					</div>
					<div>
						<label for="msg"><p style="font-size: 40;">Message :</p></label>
						<textarea id="msg" name="user_message" rows="7" cols="50" class="msg" value="user_message"></textarea>
					</div><br>
					<div class="button">
					<p>Envoyer le message</p>
					<button id="button_register" type="submit" class="btn btn-primary" value="Submit"><pr>envoyer le message</pr></button>
							
					</div>
				</form>
            </div>
		</center>
	</body>
	
</html>