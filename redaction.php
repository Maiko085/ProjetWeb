<?php
session_start();
require 'Config.php';


$mode_edition = 0;

if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
	$mode_edition = 1;
	$edit_id = htmlspecialchars($_GET['edit']);
	$edit_article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
	$edit_article->execute(array($edit_id));

	if($edit_article->rowCount() == 1) {

		$edit_article = $edit_article->fetch();
	} else {
		die('Erreur : l\'article n\'existe pas...');
	}
}

if(isset($_POST['article_titre'], $_POST['article_contenu'])) {
	if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu'])) {
			$article_titre = htmlspecialchars($_POST['article_titre']);
			$article_contenu = htmlspecialchars($_POST['article_contenu']);

			if($mode_edition == 0) {

				var_dump($_FILES);
				var_dump(exif_imagetype($_FILES['miniature']['tmp_name']));

				$ins = $bdd->prepare('INSERT INTO articles (titre, contenu, date_time_publication) VALUES (?, ?, NOW())');
				$ins->execute(array($article_titre, $article_contenu));
				$lastid = $bdd->lastInsertId();

				if(isset($_FILES['miniature']) AND !empty($_FILES['miniature']['name'])) 
				{
					if(exif_imagetype($_FILES['miniature']['tmp_name']) == 2) 
					{
						$chemin = 'miniatures/'.$lastid.'.jpg';
						move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
					}
					else 
					{
						$message = 'Le type de fichier n\'est pas bon';
					}
				}

				header('Location: http://127.0.0.1/public/index.php');
				$message = 'Votre article à bien été posté';

			}else {
				$update = $bdd->prepare('UPDATE articles SET titre = ?, contenu = ?, date_time_publication = NOW() WHERE id = ?');
				$update->execute(array($article_titre, $article_contenu, $edit_id));
				header('Location: http://127.0.0.1/public/article.php?id='.$edit_id);
							$message = 'Votre article à bien été mis a jour';
			}

	} else {
		$erreur = 'Veuillez remplir tous les champs';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="Style.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="body.css" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title>Accueil</title>
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
        <a href="profil.php?id=<?php echo $_SESSION['id']?>" class="box">Profil</a> /
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


	<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1>Proposez la prochaine activité du BDE</h1>
        </div>
      </div>
    </div>

	<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <form method="POST" enctype="multipart/form-data">
		<input type="text" name="article_titre" placeholder="Titre"<?php if($mode_edition == 1) { ?> value="<?= $edit_article['titre'] ?>"<?php } ?>/><br />
		<textarea name="article_contenu" placeholder="Contenu de l'article"><?php if($mode_edition == 1) { ?><?= $edit_article['contenu'] ?><?php } ?></textarea><br />
		<?php if($mode_edition == 0) { ?>
		<input type="file" name="miniature" />
		<?php } ?>
		<input type="submit" value="Envoyer l'article" />
	</form>
	<br />
	<?php if(isset($message)) { echo $message; } ?>
        </div>
      </div>
    </div>

	

</body>
</html>