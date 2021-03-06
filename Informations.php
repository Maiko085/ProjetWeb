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
      <div class="col-lg-12">

  <h1 align="center">Vous trouverez ici toutes les informations sur le CESI <br /></h1>

<div class="row">
        <div class="col-lg-4"><p><h3>Le CESI : enseignement supérieur et formation professionnelle</h3>

Le Cesi accompagne chaque année plus de 20 000 étudiants et salariés dans leur développement professionnel. Du Bac au Bac+6, du Niveau III au Niveau I, vous trouverez ici une large gamme de formations courtes ou longues par la formation initiale, l'alternance, l'apprentissage, la VAE ou la formation continue</p></div>
        <div class="col-lg-8"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2782.3920046208736!2d4.763392778550205!3d45.783373756108055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4ecebacc7c719%3A0x785ad7577670e9c7!2s19+Avenue+Guy+de+Collongue%2C+69130+%C3%89cully!5e0!3m2!1sfr!2sfr!4v1492586084256" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>
      </div>
    </div>
  </div>
</div>

<footer>

<div class="row2">
        <div class="col-lg-12">

 <div class="container">
      
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