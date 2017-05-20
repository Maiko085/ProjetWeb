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

        header('Location: http://127.0.0.1/index.php');
        $message = 'Votre article à bien été posté';

      }else {
        $update = $bdd->prepare('UPDATE articles SET titre = ?, contenu = ?, date_time_publication = NOW() WHERE id = ?');
        $update->execute(array($article_titre, $article_contenu, $edit_id));
        header('Location: http://127.0.0.1/article.php?id='.$edit_id);
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
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="body.css" rel="stylesheet">
    <link href="js/bootstrap.min" rel="stylesheet">
      <link href="jquery.min" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Vie Associative</title>
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


  <h1 align="center">Bienvenue dans la galerie photos du BDE !<br /></h1>

<div class="c-wrapper" align="center">
  <div id="my_carousel2" class="carousel slide" data-ride="carousel">
  <!-- Bulles -->
  <ol class="carousel-indicators">
  <li data-target="#my_carousel2" data-slide-to="0" class="active"></li>
  <li data-target="#my_carousel2" data-slide-to="1"></li>
  <li data-target="#my_carousel2" data-slide-to="2"></li>
  <li data-target="#my_carousel2" data-slide-to="3"></li>
  <li data-target="#my_carousel2" data-slide-to="4"></li>
  </ol>
  <!-- Slides -->
  <div class="carousel-inner">
  <!-- Page 1 -->
  <div class="item active">  
  <div class="carousel-page">
  <img src="ressources/PhotoClasse (1).jpg" class="img-responsive img-rounded" style="margin:0px auto;" />
  </div> 
  </div>   
  <!-- Page 2 -->
  <div class="item"> 
  <div class="carousel-page"><img src="ressources/PhotoClasse (2).jpg" class="img-responsive img-rounded" 
  style="margin:0px auto;"  /></div> 
  </div>  
  <!-- Page 3 -->
  <div class="item">  
  <div class="carousel-page"><img src="ressources/PhotoClasse (3).jpg" class="img-responsive img-rounded" 
  style="margin:0px auto;"  />
  </div>  
  </div>     
   <!-- Page 4 -->
  <div class="item"> 
  <div class="carousel-page"><img src="ressources/PhotoClasse (4).jpg" class="img-responsive img-rounded" 
  style="margin:0px auto;"  /></div> 
  </div> 
   <!-- Page 5 -->
  <div class="item"> 
  <div class="carousel-page"><img src="ressources/PhotoClasse (5).jpg" class="img-responsive img-rounded" 
  style="margin:0px auto;"  /></div> 
  </div> 
  </div>
  <!-- Contrôles -->
  <a class="left carousel-control" href="#my_carousel2" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#my_carousel2" data-slide="next">
  <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
  </div>
</div>



<div class="container">

  <section class="row">

     <div class="col-xs-4 col-sm-3 col-md-2"><a href="ressources/PhotoClasse (1).jpg"><img src="ressources/PhotoClasse (1)1.jpg" alt="Photo de classe"></a></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><a href="ressources/PhotoClasse (2).jpg"><img src="ressources/PhotoClasse (2)2.jpg" alt="Photo de classe"></a></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><a href="ressources/PhotoClasse (3).jpg"><img src="ressources/PhotoClasse (3)3.jpg" alt="Photo de classe"></a></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><a href="ressources/PhotoClasse (4).jpg"><img src="ressources/PhotoClasse (4)4.jpg" alt="Photo de classe"></a></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><a href="ressources/PhotoClasse (5).jpg"><img src="ressources/PhotoClasse (5)5.jpg" alt="Photo de classe"></a></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><img src="ressources/PhotoClasse (6).jpg" alt="Photo de classe"></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><img src="ressources/PhotoClasse (7).jpg" alt="Photo de classe"></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><img src="ressources/PhotoClasse (8).jpg" alt="Photo de classe"></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><img src="ressources/PhotoClasse (9).jpg" alt="Photo de classe"></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><img src="ressources/PhotoClasse (10).jpg" alt="Photo de classe"></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><img src="ressources/PhotoClasse (11).jpg" alt="Photo de classe"></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><img src="ressources/PhotoClasse (12).jpg" alt="Photo de classe"></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><img src="ressources/PhotoClasse (13).jpg" alt="Photo de classe"></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><img src="ressources/PhotoClasse (14).jpg" alt="Photo de classe"></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><img src="ressources/PhotoClasse (15).jpg" alt="Photo de classe"></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><a href="ressources/PhotoClasse (16).jpg"><img src="ressources/PhotoClasse (16)16.jpg" alt="Photo de classe"></a> </div>

    <div class="col-xs-4 col-sm-3 col-md-2"><a href="ressources/PhotoClasse (3).jpg"><img src="ressources/PhotoClasse (3)3.jpg" alt="Photo de classe"></a></div>

    <div class="col-xs-4 col-sm-3 col-md-2"><a href="ressources/PhotoClasse (4).jpg"><img src="ressources/PhotoClasse (4)4.jpg" alt="Photo de classe"></a></div>
  </section>

</div>

<div class="container">
      <div class="row">
        <div class="col-sm-1">
          <form method="POST" enctype="multipart/form-data">
    <input type="text" name="article_titre" placeholder="Name"<?php if($mode_edition == 1) { ?> value="<?= $edit_article['titre'] ?>"<?php } ?>/><br />
    <?php if($mode_edition == 0) { ?>
    <input type="file" name="miniature" />
    <?php } ?>
    <input type="submit" value="Send Picture" />
  </form>
  <br />
  <?php if(isset($message)) { echo $message; } ?>
        </div>
      </div>
    </div>

<footer class="footer">

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


<script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="jquery.min.js"></script>
  <script type="text/css" src="css/bootstrap.min.css"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>

