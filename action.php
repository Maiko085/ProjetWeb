<?php 
session_start();
$bdd = new PDO("mysql:host=127.0.0.1;dbname=projetweb;charset=utf8", "root", "root");

if(isset($_GET['t'],$_GET['id']) AND !empty($_GET['t']) AND !empty($_GET['id'])) 
{
	$getid = (int) $_GET['id'];
	$gett = (int) $_GET['t'];

	//$ip = $_SERVER['REMOTE_ADDR'];
	$sessionid = 4;

	$check = $bdd->prepare ('SELECT id FROM articles WHERE id = ?');
	$check->execute(array($getid));

	if($check->rowCount() == 1)
	{
		if($gett == 1)
		{
				$check_like = $bdd->prepare('SELECT id FROM likes WHERE id_article = ? AND id_membre = ?');
				$check_like->execute(array($getid,$sessionid));

				$del = $bdd->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
				$del->execute(array($getid,$sessionid));

				if($check_like->rowCount() == 1)
				{
					$del = $bdd->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
					$del->execute(array($getid,$sessionid));
				}

				$ins = $bdd->prepare('INSERT INTO likes (id_article, id_membre) VALUES (?, ?)');
				$ins->execute(array($getid, $sessionid));
		}
		if($gett == 2) 
		{
				$check_like = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ? AND id_membre = ?');
				$check_like->execute(array($getid,$sessionid));

				$del = $bdd->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
				$del->execute(array($getid,$sessionid));

				if($check_like->rowCount() == 1)
				{
					$del = $bdd->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
					$del->execute(array($getid,$sessionid));
				}

				$ins = $bdd->prepare('INSERT INTO dislikes (id_article, id_membre) VALUES (?, ?)');
				$ins->execute(array($getid, $sessionid));
		}
		header('Location: http://localhost/public/article.php?id='.$getid);
	}
	else 
	{
		exit('Erreur fatale. <a href="http://localhost/public/index.php">Revenir à l\accueil</a>');
	}

}
else 
{
		exit('Erreur fatale. <a href="http://localhost/public/index.php">Revenir à l\accueil</a>');
}
?>