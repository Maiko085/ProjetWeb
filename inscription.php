<?php
session_start();
require 'Config.php';


#try{
#   $bdd = new PDO('mysql:host=localhost;dbname=member_space', 'root', 'root');
#}catch(PDOException $e){
#   die('Erreur : '.$e->getMessage());
#}


if(isset($_POST['forminscription']))
{
      $mail = htmlspecialchars($_POST['mail']);
      $mail2 = htmlspecialchars($_POST['mail2']);
      $nom = htmlspecialchars($_POST['nom']);
      $prenom = htmlspecialchars($_POST['prenom']);
      $pseudo = htmlspecialchars($_POST['pseudo']);
      $pass = sha1($_POST['pass']);
      $pass2 = sha1($_POST['pass2']);
      $promo = htmlspecialchars($_POST['promo']);

  if(!empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['pseudo']) AND !empty($_POST['pass']) AND !empty($_POST['pass2']) AND !empty($_POST['promo']))
    {
      $nomlenght = strlen($nom);
      if($nomlenght <=64)
      {
        $prenomlenght = strlen($prenom);
        if($prenomlenght <=64)
          {
            $pseudolenght = strlen($pseudo);
            if($pseudolenght <=32)
              {

                if($mail = $mail2)
                  {
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                      {
                        if($pass = $pass2)
                          {

                            $insertmbr = $bdd->prepare("INSERT INTO members(firstname,lastname, mail, password, promo, pseudo) VALUES(?, ?, ?, ?, ?, ?)");
                            $insertmbr->execute(array($prenom, $nom, $mail, $pass, $promo, $pseudo));
                            $erreur = "Your account as been set. <br/> <a href=\"connexion.php\">Sign in</a>";

                          }
                        else
                          {
                            $erreur = "Your passwords doesn't match !";
                          }
                      }
                    else
                      {
                        $erreur = "Your email adresse cannot exist !";
                      }
                  }
                else
                  {
                    $erreur = "Your email adresses doesn't match !";
                  }
              }
            else
              {
                $erreur = "Your pseudo is too long ! (max 32)";
              }
          }
         else
          {
            $erreur = "Your firstname is too long ! (max 64)";
          }
      }
      else
      {
        $erreur = "Your lastname is too long ! (max 64)";
      }


    }
    else
    {
      $erreur = "You need to fill all * cases !";
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
  <title>Signing Up</title>
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
      <h2>Sign up</h2>
      <br/>
      <form method="POST" action="">


             <label for="mail">Email :*</label>
             <br/>

             <input type="mail" name="mail" id="mail"  placeholder="mail@viacesi.fr" value="<?php if (isset($mail)) { echo $mail; } ?>"/>
             <br/>
 
             <label for="mail2">Repeat Email :*</label>
             <br/>

             <input type="mail" name="mail2" id="mail2"  placeholder="mail@viacesi.fr" value="<?php if (isset($mail2)) { echo $mail2; } ?>"/>
              <br/>

             <label for="nom">Lastname :*</label>
             <br/>

             <input type="text" name="nom" id="nom" minlength="1" placeholder="Lastname" value="<?php if (isset($nom)) { echo $nom; } ?>"/>
             <br/>

             <label for="prenom">Firstname :*</label>
             <br/>

             <input type="text" name="prenom" id="prenom" placeholder="Firstname" value="<?php if (isset($prenom)) { echo $prenom; } ?>"/>
             <br/>

             <label for="pseudo">Pseudo :*</label>
             <br/>
 
             <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php if (isset($pseudo)) { echo $pseudo; } ?>" />
             <br/>
 
             <label for="pass">Password :*</label>
             <br/>
 
             <input type="password" name="pass" id="pass" placeholder="Password" />
             <br/>

             <label for="pass2">Repeat password :*</label>
             <br/>

             <input type="password" name="pass2" id="pass2" placeholder="Repeat Password" />
             <br/>
 
             <label for="promo">Promo :*</label>
             <br/>

             <select name="promo" id="promo">
                      <optgroup label="Exia">
                 <option value="Exia A1">Exia A1</option>
                 <option value="Exia A2">Exia A2</option>
                 <option value="Exia A3">Exia A3</option>
                 <option value="Exia A4">Exia A4</option>
                 <option value="Exia A5">Exia A5</option>
               </optgroup>
                      <optgroup label="EI">
                 <option value="Ei A1">Ei A1</option>
                 <option value="Ei A2">Ei A2</option>
                 <option value="Ei A3">Ei A3</option>
                 <option value="Ei A4">Ei A4</option>
                 <option value="Ei A5">Ei A5</option>
                 </optgroup>
             </select>


             <br/><br/>


            <input type="submit" name="forminscription" value="Valider">

      </form>
        <?php
          if(isset($erreur))
          {
            echo '<font color="red">' .$erreur."</font>";
          }
        ?>
    </div>

  </body>
</html>