<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=titi&guigui;charset=utf8', 'titi&guigui', 'titi&guigui');
}
catch(Exception $e)

{
	die('Erreur : '.$e->getMessage());
}
// On définit les variables a envoyer a la database

// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT username, message FROM minichat ORDER BY ID DESC LIMIT 0, 10');
// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
?>
				<td>
					The 10 last messages
				</td>
<!-- THE LOOP -->
<td>
<ul>
<?php
while ($donnees = $reponse->fetch()) {
	echo '<li><strong>' . $donnees['username'] . ':~#</strong> : ' . $donnees['message'] . '</li>';

}

$reponse->closeCursor();
?>
<h1>Poster un message</h1>
<form id="chat" action="minichat_post.php" method="post">
<label for="message">Type your message here</label><br>
<textarea type="text" name="message" maxlength=140></textarea><br>
<label for="username">Your pseudo</label><br>
<input type="text" name="username"><br>
<input type="submit" value="New Message"><br>
</form>
<h1>Modifier un message</h1>
<form id="modif" action="minichat_post.php" method="post">
<label for="msgid">Message Id</label><br>
<input type="text" name="msgid"><br>
<label for="modmsg">Message a remplacer</label><br>
<input type="text" name="modmsg"><br>
<input type="submit" name="update" value="Modifier Message">
</form>
<h1>Supprimer un message</h1>
<form id="modif" action="minichat_post.php" method="post">
<label for="msgid">Message Id</label><br>
<input type="text" name="eraseid"><br>
<input type="submit" name="delete" value="Supprimer Message">
</form>
<h1>Tout démolir</h1>
<form id="destroy" action="minichat_post.php" method="post">
<input type="hidden" name="destroy" value="touniké"> 
<input type="submit" value="Supprimer la BDD">
</form>

