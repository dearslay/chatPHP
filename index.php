<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
  <title>Exercice</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500&display=swap" rel="stylesheet"> 
  <link rel="icon" href="favicon.png" />
</head>
<body>
<?php
	$username = '<script type="text/javascript">let user = prompt("Username:");</script>';
?>
<a href="index.php" style="text-decoration:none;text-transform:uppercase;color:white;">refresh</a>
<?php
if( isset($_POST["envoie"])){
	if ($_POST["message"]=='' || !isset($_POST["message"])){
		echo "<div class=\"block\">Veuiller ajouter un message !</div>";
	}
	else{
		$nom = "Admin";
		$message = $_POST['message'];
		echo "<div class=\"success\">Success !</div>";
		$db = new PDO('mysql:host=;dbname=;charset=utf8','', '');
		$result = $db->prepare('INSERT INTO general (nom, message) VALUES (:nom, :message)');
		$result->execute(array('nom' => $nom, 'message' => $message));
	}
}
?>
<?php
try
{
	$bdd = new PDO('mysql:host=;dbname=;charset=utf8','', '');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM general');

while ($donnees = $reponse->fetch())

	echo '<p class="message">' .$donnees['message']. '</p>' . '<a href="delete.php?name=' .$donnees['nom']. '"style="margin-left:5px;text-decoration:none;color:red;opacity:90%;font-size:16px;">Supprimer</a>';

$reponse->closeCursor();
?>
<form method="post"  action="#" name="add">
	<textarea name="message" placeholder="Message"></textarea><br>
	<input type="submit" value="Envoyer" name="envoie">
</form>
<style>
body{
	font-family: 'Roboto', sans-serif;
	background-color:#17202c;
}
.message{
	color:white;
}
</style>
</body>
</html>