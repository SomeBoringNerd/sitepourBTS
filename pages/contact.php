<html>
	<head>
		<title>Contact.wtf</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="../index.css">
	</head>
	<script>
		function send_mail()
		{
			var name = document.getElementById('name');
			var message = document.getElementById('msg');

			let body = "J'aimerai vous contacter";

			let name_properly_formated = name.value.replace("/\s+g", "")
			let message_properly_formated = message.value.replace("/\s+g", "")
			if(name_properly_formated === "" || message_properly_formated == "")
			{
				alert("merci de ne pas laisser la case \"nom\" ou \"message\" vide ou avec uniquement des espaces")
			}
			else{
				window.location.href = "mailto:pro.corentynsauvage@gmail.com?subject=[" + name.value + "] >> " + body + "&body=" + message.value;
			}
			
		}
	</script>
	<body>
	<?php include("../entete.php"); ?>
		<center>
			
			<br><br><br><br><br>

			<megaTitle>Page de contact</megaTitle><br><br>
			<lesserTitle>vous pouvez venir me contacter ici</lesserTitle>
			
			<p>______________________________________________________________________________</p>
			<p>Note : si vous utilisez une boite mail dans le navigateur, 
			<a href="javascript:void(0)" onclick="alert('mon adresse mail est \'pro.corentynsauvage@gmail.com\', faites en bon usage :-)');" 
			title="ceci est un lien cliquable">cliquez ici</a> pour obtenir mon adresse mail</p><br>
			
		</center>
			<img src="../rescources/img/kill_me.png" width="750" height="300" id="end_my_sufferings" 
			title="tuez moi j'ai perdu 3h de ma vie a placer ce truc au bon endroit">
			
			<center>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<div id="contact_border">
                <form>
					<div>
						<label for="name"><p style="font-size: 40;">Nom :</p></label>
						<input type="text" id="name" name="user_name" class="msg">
					</div>
					<div>
						<label for="msg"><p style="font-size: 40;">Message :</p></label>
						<textarea id="msg" name="user_message" rows="7" cols="50" class="msg"></textarea>
					</div><br><br>
					<div class="button">
						<button onclick="send_mail();" title="cliquer sur ce bouton va ouvrir votre boite mail si vous en avez une d'installée">
							<pr>Envoyer le message</pr></button>
					</div>
				</form>
            </div>
		</center>
	</body>
	
</html>