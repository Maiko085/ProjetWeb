<?php
session_start();
require 'Config.php';

$_SESSION['id'];
$_SESSION['pseudo'];

if(isset($_POST['formconnexion'])) 
{
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);

   if(!empty($mailconnect) AND !empty($mdpconnect)) 
   {
      $requser = $bdd->prepare("SELECT * FROM members WHERE mail = ? AND password = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();

      if($userexist == 1)
        {
           $userinfo = $requser->fetch();
           $_SESSION['id'] = $userinfo['id'];
           $_SESSION['pseudo'] = $userinfo['pseudo'];
           $_SESSION['mail'] = $userinfo['mail'];
           header('Location: profil.php?id='.$_SESSION['id']);
           $erreur = "Ok";

        } 
      else 
        {
         $erreur = "Email or password wrong !";
        }
   } else {
      $erreur = "Email and Password are both required";
   }
}



?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
    <link href="css/bootstrap.css" rel="stylesheet">
        <link href="js/bootstrap.min" rel="stylesheet">
    <link href="body.CSS" rel="stylesheet">
      <link href="jquery.min" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <title>Sign in</title>
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

    <div align="center">
      <h2>Sign in</h2>
      <br/><br/>

      <form method="POST" action="">
        <input type="email" name="mailconnect" placeholder="Mail"><br/><br/>
        <input type="password" name="mdpconnect" placeholder="Mot de passe">
        <br/><br/>
        <input type="submit" name="formconnexion" value="Se Connecter">

      </form>
        <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
    </div>
  </body>
</html>