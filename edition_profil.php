<?php

session_start();
require'Config.php';


   if(isset($_SESSION['id'])) 
   { 
      $requser = $bdd->prepare("SELECT * FROM members WHERE id = ?");
      $requser->execute(array($_SESSION['id']));
      $user = $requser->fetch();

      if(isset($_POST['newpseudo']) AND !empty ($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
         {
            $newpseudo = htmlspecialchars($_POST['newpseudo']);
            $insertpseudo = $bdd->prepare("UPDATE members SET pseudo = ? WHERE id = ?");
            $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
            header ('Location: profil.php?id='.$_SESSION['id']);
         } 

      if(isset($_POST['newmail']) AND !empty ($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
         {
            $newmail = htmlspecialchars($_POST['newmail']);
            $insertmail = $bdd->prepare("UPDATE members SET mail = ? WHERE id = ?");
            $insertmail->execute(array($newmail,$_SESSION['id']));
            header ('Location: profil.php?id='.$_SESSION['id']);
         } 

      if(isset($_POST['newpassword']) AND !empty ($_POST['newpassword']) AND ($_POST['newpassword2']) AND !empty ($_POST['newpassword2']))
         {
            $password = sha1($_POST['newpassword']);
            $password2 = sha1($_POST['newpassword2']);

            if($password == $password2)
               {
                  $insertpassword = $bdd->prepare ("UPDATE members SET password = ? WHERE id = ?");
                  $insertpassword->execute(array($password, $_SESSION['id']));
                  header ('Location: profil.php?id='.$_SESSION['id']);
               }
            else
               {
                  $message = "Your passwords doesn't match!";
               }

         } 

#         if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
#         {
#            $tailleMax = 2097152;
#            $extensionValide = array('jpg', 'jpeg', 'gif', 'png');
#            if($_FILES['avatar']['size'] <= $tailleMax)
#              {
#               $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 0));
#                  if(in_array($extensionUpload, $extensionValide))
#                  {
#                    $directory = 'member/avatar/'.$_SESSION['id'].".".$extensionUpload;
#                     $result = move_uploaded_file($_FILES['avatar']['tmp_name'],  $directory);
 #                    if($result)
 #                    {
 #                       $updateAvatar = $bdd->prepare('UPDATE members SET avatar = :avatar WHERE id = :id');
 #                       $updateAvatar->execute(array('avatar' => $_SESSION['id'].".".$extensionUpload, 'id' => $_SESSION['id']));
  #                      Header ('Location: profil.php?id='.$_SESSION['id']);
  #                   }
  #                   else
  #                   {
  #                      $message = "Upload Failled, please contact support.";
  #                   }
  #                }
  #               else
  #                {
  #                   $message = "Your picture need to be in : jpg, jpeg, gif or png.";
  #                }
  #          }
  #          else
   #         {
   #            $message = "Your profil picture is too big or is not taken in charge (<2Mo).";
  #          }
   #      }


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
  <title>Edit profil</title>
</head>
   <body>

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

      <div align="center">
         <h2>This is the profil page of <?php echo $userinfo['pseudo']; ?></h2>
         <br /><br />
         <form method="POST" action="" enctype="multipart/form-data">

        <tr align="Center">
          <td >
             <label for="mail">Email :</label>
          </td>
          <td>
             <input type="mail" name="newmail" placeholder="mail"value= "<?php echo $user['mail'];?>"" /><br/>
          </td>
        </tr>

          <tr align="Center">
          <td>
             <label for="pseudo">Pseudo :</label>
          </td>
          <td>
             <input type="text" name="newpseudo" placeholder="pseudo" value= "<?php echo $user['pseudo'];?>"/><br/>
          </td>
        </tr>

        <tr align="Center">
          <td>
             <label for="pass">Password :</label>
          </td>
          <td>
             <input type="password" name="newpassword" placeholder="Password"/><br/>
          </td>
        </tr>

        <tr align="Center">
          <td>
             <label for="pass2">Repeat password :</label>
          </td>
          <td>
             <input type="password" name="newpassword2" placeholder="Password"/><br/>
          </td>
        </tr>

         <tr align="Center">
          <td>
             <label>Avatar :</label>
          </td>
          <td>
             <input type="file" name="avatar" /><br/>
          </td>
        </tr>

         <tr align="Center">
          <td>
          </td>
          <td>
             <input type="submit" value="Update informations"/><br/>
          </td>
        </tr>

         <tr align="Center">
          <td>
          </td>
          <td>
             <a href="profil.php?id=<?php echo $_SESSION['id']; ?>"/>Back to profil</a><br/>
          </td>
        </tr>

      </div>
      <?php if (isset($message)) { echo $message;} ?>
   </body>
</html>
<?php } ?>