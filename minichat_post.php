<?php
// On vérifie que le message n'est pas vide
// Connexion à la base de données
try {
	$bdd = new PDO('mysql:host=localhost;dbname=titi&guigui;charset=utf8', 'titi&guigui', 'titi&guigui');
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());

//VARIABLES



// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO minichat (username, message) VALUES(?, ?)');
// On execute la requete
$req->execute(array(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['message'])));
header('Location: index.php');
}
//Modif message
if (isset($_POST['msgid']) AND isset($_POST['modmsg'])) {
$modif = $bdd->prepare('UPDATE minichat SET message = :message WHERE id = :id');
$modif->bindValue(':id', $_POST['msgid']);
$modif->bindValue(':message', $_POST['modmsg']);
$modif->execute();
header('Location: index.php'); 
}
//Suppression message
if(isset($_POST['eraseid'])) {
	$delete = $bdd->prepare('DELETE FROM minichat WHERE id = :id');
	$delete->bindValue(':id', $_POST['eraseid']);
	$delete->execute();
	header('location: index.php');
	exit;
}
//Suppression BDD
if ($_POST['destroy'] === 'touniké') {
	$destroy = $bdd->prepare('DELETE FROM minichat');
	$destroy->execute();
	header('location: index.php');
}
?>
