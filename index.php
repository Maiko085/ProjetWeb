<?php
session_start();
require'Config.php';

$articles = $bdd->query('SELECT * FROM articles ORDER BY date_time_publication DESC');
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
          <h1>Bienvenue sur les activités à venir au CESI Lyon !</h1>
        </div>
      </div>
    </div>
	
	<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <ul>
		<?php while($a = $articles->fetch()) { ?>
		<li><a href="article.php?id=<?= $a['id'] ?>"><?=$a['titre'] ?></a> | 
			<a href="redaction.php?edit=<?= $a['id'] ?>">Modifier</a> | 
			<a href="supprimer.php?id=<?= $a['id'] ?>">Supprimer</a></li>
		<?php } ?>
	<ul>
        </div>
      </div>

	<div class="container">
	      <div class="row">
	        <div class="col-sm-12">
	          <input type="button" name="new" value="New" onclick="self.location.href='redaction.php'"/>
	        </div>
	      </div>
	    </div>
	

</body>
</html>