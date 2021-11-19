<?php
    session_start();
    require_once("config.php");

    
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
		header("location: ../account/login.php");
		exit;
	}else if($_SESSION["user_status"] !== 1)
    {
        header("location: ../admin");
		exit;
    }
    else{
        $sql = "SELECT * FROM users";
        $result = $link->query($sql);

        // marche pas encore
        
        echo "<script>console.log(\"test\");</script>";
        if (isset($_POST["delete"])) {
            
            $ID_USER = $_POST["USER_ID"];
            echo "<script>console.log(\"test 2 : $ID_USER\");</script>";

            $sql2 = "DELETE FROM users WHERE id = $ID_USER";
            
            if ($link->query($sql2) === TRUE)
            {
                header("location: users.php");
            }else{
                echo "<script>alert('une erreur s'est produite : $link->error');</script>";
            }
            
        }
    }
?>

<html>
    <head>
        <title>gestion des utilisateurs</title>
        <link rel="stylesheet" href="../index.css">
    </head>
    <?php include("../entete.php"); 

    echo "<br><br><br><br>";
            echo "<center><megaTitle>Gérer les utilisateurs<megaTitle></center><br>";
            // print l'entièreté des messages enregistrés dans la DB
            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table border=\"1\">";
                echo "<tr>
                            <td><center><p>Nom d'utilisateur: <br></center></p></td>
                            <td><center><p>Date de création du compte: <br></center></p></td>
                            <td><center><p>Dernière fois vu en ligne: <br></center></p></td>
                            <td><center><p>options supplémentaires <br></center></p></td>
                        </tr>";
                while($row = $result->fetch_assoc()) {
                    $ID = $row["id"];
                    echo "<script>console.log($ID);</script>";
                    echo "<tr>
                            <td>
                                <center>
                                    <p>"
                                        . $row["username"]. 
                                    "</p>
                                </center>
                            </td>
                        <td>
                            <center>
                                <p>" . 
                                    $row["created_at"]. 
                                "</p>
                            </center>
                        </td>
                        <td>
                            <center>
                                <p>".
                                    $row["LAST_ONLINE"]
                                ."</p>
                            </center>
                        </td>
                            <td>";
                            if($_SESSION["id"] !== $ID)
                            {
                                echo"<form action='' method='POST'>
                                        <input type=\"hidden\" name=\"USER_ID\" value=\"$ID\">
                                        <center>   
                                        <button type='submit' name='delete'>
                                            <pr>Supprimer le compte</pr>
                                        </button>
                                        </center>
                                    </form>";
                            }
                            echo "
                            </td>
                        </tr>";
                }
                echo "</table>";
            } else {
            echo "<p>la base de donnée \"contact_messages\" ne possède aucune entrée</p>";
            }
        ?>
        </center>
</html>
