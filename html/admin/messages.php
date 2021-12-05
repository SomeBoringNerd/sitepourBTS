<?php
    session_start();
    require_once("config.php");
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
		header("location: ../account/login.php");
		exit;
	}else if($_SESSION["user_status"]  !== 1)
    {
        header("location: ../admin/");
        exit;
    }
    else{
        $sql = "SELECT * FROM contact_messages";
        $result = $link->query($sql);

        // marche pas encore
        
        echo "<script>console.log(\"test\");</script>";
        if (isset($_POST["delete"])) {
            
            $ID_DU_MESSAGE_A_SUPPRIMER = $_POST["MESSAGE_ID"];
            echo "<script>console.log(\"test 2 : $ID_DU_MESSAGE_A_SUPPRIMER\");</script>";

            $sql2 = "DELETE FROM contact_messages WHERE MESSAGE_ID = $ID_DU_MESSAGE_A_SUPPRIMER";
            
            if ($link->query($sql2) === TRUE)
            {
                header("location: messages.php");
            }else{
                echo "<script>alert('une erreur s'est produite : $link->error');</script>";
            }
            
        }
    }
?>


<html>
    <head>
        <link rel="stylesheet" href="../index.css?rnd=132">
        <title>Messages</title>
        <center>
        <?php
            include("../entete.php");
            echo "<br><br><br><br>";
            echo "<center><megaTitle>Messages reçus<megaTitle></center><br>";
            // print l'entièreté des messages enregistrés dans la DB
            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table border=\"1\">";
                echo "<tr>
                            <td><center><p>Envoyé par : <br></center></p></td>
                            <td><center><p>contenu du message : <br></center></p></td>
                            <td><center><p>date d'envoi du message: <br></center></p></td>
                            <td><center><p>options supplémentaires <br></center></p></td>
                        </tr>";
                while($row = $result->fetch_assoc()) {
                    $ID = $row["MESSAGE_ID"];
                    $USERNAME_TO_GRAB = $row["MESSAGE_AUTHOR"];
                    
                    $USER_ID = $row["MESSAGE_AUTHOR_ID"];
                    echo "<script>console.log($ID);</script>";
                    echo "<tr>
                            <td>
                            <center>
                                <p><a href=\"../account/account.php?id=$USER_ID\">"
                            . $row["MESSAGE_AUTHOR"]. 
                                "</p></a>
                            </center>
                            </td>
                        <td>
                            <center>
                                <textarea readonly id=\"forum_title_container\">" . 
                                    $row["MESSAGE_CONTENT"]. 
                                "</textarea>
                            </center>
                        </td>
                        <td>
                            <center>
                                <p>" . 
                                    $row["MESSAGE_CREATION_DATE"] . 
                                "</p>
                            </center>
                        </td>
                            <td>
                                <form action='' method='POST'>
                                    <center>
                                        <input type=\"hidden\" name=\"MESSAGE_ID\" value=\"$ID\">
                                        
                                        <button type='submit' name='delete'>
                                            <pr>supprimer</pr>
                                        </button>
                                    </center>
                                </form>
                            </td>
                        </tr>";
                }
                echo "</table>";
            } else {
            echo "<p>la base de donnée \"contact_messages\" ne possède aucune entrée</p>";
            }
        ?>
        </center>
    </head>
</html>