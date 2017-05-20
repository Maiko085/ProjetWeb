<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="Style.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="body.css" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title>BDE CESI LYON</title>
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
      


<div class="container">
      <header class="row">
        <div class="col-lg-12">
          <h1>Bienvenue sur le site du BDE CESI Lyon</h1>
        </div>
      </header>
      <div class="row">
        <nav class="col-lg-8">
          <p>Les BDE sont présents dans les universités et dans les écoles et fonctionnent par filières ou pour tout un établissement. Leur rôle est particulièrement important, en effet, c'est le BDE qui organise toute la vie festive de l'école comme les soirées, les grands repas ou qui est un point de rencontre entre les différentes associations de l'école1. L'association est en général élue tous les ans par les étudiants de l'école ainsi que par les étudiants étrangers en échange dans certaines écoles.
        </p>
        </nav>
        <section class="col-lg-4">
          <div class="logo"><img id="logo" src="ressources/logo.jpg" width="300" height="300"></div>
        </section>
        
    </div>
					</div>
          <h3 align="center">Prochain evenement :</h3>
<p align="center"><img id="logoRouen" src="ressources/Cesillades.png" width="600" height="200"></p>


<footer>

 <div class="container">
<div class="row2">
        <div class="col-lg-12">
          
      <div class="row">
        <div class="col-lg-4">Adresse : 19 Avenue Guy de Collongue, 69130 Écully</div>
        <div class="col-lg-4">BDE-Lyon@viacesi.fr</div>
        <div class="col-lg-4">Téléphone : 04 72 18 89 89</div>
      </div>
</div>
</div>
</div>
</footer>
</body>
</html>