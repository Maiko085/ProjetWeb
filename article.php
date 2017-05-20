<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=projetweb;charset=utf8", "root", "root");

if(isset($_GET['id']) AND !empty($_GET['id'])) 
{
	$getid = htmlspecialchars($_GET['id']);

	$article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
	$article->execute(array($getid));

	if($article->rowCount() == 1) 
	{
		$article = $article->fetch();
		$id = $article['id'];
		$titre = $article['titre'];
		$contenu = $article['contenu'];

		$likes = $bdd->prepare('SELECT id FROM likes WHERE id_article = ?');
		$likes->execute(array($id));
		$likes = $likes->rowCount();

		$dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ?');
		$dislikes->execute(array($id));
		$dislikes = $dislikes->rowCount();

	} else 
		{
		die('Cet article n\'existe pas !');
		}

	if (isset($_POST['submit_commentaire']))
	{
		if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) 
		{
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$commentaire = htmlspecialchars($_POST['commentaire']);

			if(strlen($pseudo) < 25) 
			{
				$ins = $bdd->prepare('INSERT INTO commentaires (pseudo, commentaire, id_article) VALUES (?,?,?)');
				$ins->execute(array($pseudo,$commentaire,$getid));
				$c_msg = "<span style='color:green'>Votre commentaire à bien été posté.</span>";

			} else 
				{
				$c_msg = "Erreur: .Le pseudo doit faire moins de 25 caractères";
				}

		} else 
			{
			$c_msg = "Erreur: .Tous les champs doivent êtres complétés";
			}
	}
} else {
	die('Erreur');
}

	$commentaires = $bdd->prepare('SELECT * FROM commentaires WHERE id_article = ? ORDER BY id DESC');
	$commentaires->execute(array($getid));
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="Style.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="body.css" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title>Article</title>
</head>

<body>
<header>
<?php
if($_SESSION)
  {
?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
     <a href="Acceuille.php"><div class="logo"><img id="logo" src="ressources/logo.jpg" width="70" height="70"></div></a> 
    </div>
    <ul class="nav navbar-nav">
      <li> <a href="Phototech.php">Pictures</a> </li>
      <li> <a href="index.php">Actualities</a> </li>
      <li> <a href="Boutique.php">Shop</a> </li>
      <li> <a href="Informations.php">Informations</a> </li>
            <li> <a href="contact.php">Contact us</a> </li>

    </ul>
    <form class="navbar-form navbar-right inline-form">
      <div class="form-group">
        <a href="profil.php" class="box">Profil</a> /
        <a href="deconnexion.php" class="box">Disconnect</a> </p>
      </div>
    </form>
  </div>
</nav>
<?php
}
else
{ ?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
     <a href="Acceuille.php"><div class="logo"><img id="logo" src="ressources/logo.jpg" width="70" height="70"></div></a> 
    </div>
    <ul class="nav navbar-nav">
      <li> <a href="Phototech.php">Pictures</a> </li>
      <li> <a href="index.php">Actualities</a> </li>
      <li> <a href="Boutique.php">Shop</a> </li>
      <li> <a href="Informations.php">Informations</a> </li>
            <li> <a href="contact.php">Contact us</a> </li>

    </ul>
    <form class="navbar-form navbar-right inline-form">
      <div class="form-group">
        <p> <br /><a href="inscription.php" class="box">Sign up</a> /
        <a href="connexion.php" class="box">Sign in</a> </p>
      </div>
    </form>
  </div>
</nav>
<?php 
} ?>
</header>

<body>

	<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1 align="center"><?= $titre ?></h1>
		  <p align="center"><?= $contenu ?></p>
        </div>
      </div>
    </div>
	

	<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <br />
          <a href="action.php?t=1&id=<?= $id ?>">Likes</a> (<?= $likes ?>)
		  <br />
		  <a href="action.php?t=2&id=<?= $id ?>">Dislikes</a> (<?= $dislikes ?>)
		  <br />
          <input type="button" name="retour" value="Retour" onclick="self.location.href='index.php'"/>
        </div>
      </div>
    </div>

    	<div class="container">
      <div class="row">
        <div class="col-sm-6">
        	<br />
        	<h2>Commentaires:</h2>
        	<form method="POST">
        		<input type="texte" name="pseudo" placeholder="Votre pseudo" /><br />
        		<textarea name="commentaire" placeholder="Votre commentaire.."></textarea><br />
        		<input type="button" name="retour" value="Retour" onclick="self.location.href='index.php'"/>
        		<input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
        	</form>
        	<?php if(isset($c_msg)) {echo $c_msg; } ?>
        </div>
        	<div class="col-sm-6">
        		<br />
        		<h2>Espace commentaires:</h2>
			<?php while($c = $commentaires->fetch()) { ?>
			<b><?= $c['pseudo'] ?>:</b> <?= $c['commentaire'] ?><br />
			<?php } ?>
        </div>
      </div>
    </div>



</body>
</html>