<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="body.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
        <link href="js/bootstrap.min" rel="stylesheet">
    <link href="body.css" rel="stylesheet">
      <link href="jquery.min" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <title>Carousel / Slider</title>
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


   <h1 align="center">Bienvenu dans la boutique du BDE !</h1>
   <div class="c-wrapper" align="center">
  <div  id="my_carousel" class="carousel slide" data-ride="carousel">
  <!-- Bulles -->
  <ol class="carousel-indicators">
  <li data-target="#my_carousel" data-slide-to="0" class="active"></li>
  <li data-target="#my_carousel" data-slide-to="1"></li>
  <li data-target="#my_carousel" data-slide-to="2"></li>
  <li data-target="#my_carousel" data-slide-to="3"></li>
  <li data-target="#my_carousel" data-slide-to="4"></li>
  <li data-target="#my_carousel" data-slide-to="5"></li>
  </ol>
  <!-- Slides -->
  <div class="carousel-inner">
  <!-- Page 1 -->
  <div class="item active">  
  <div class="carousel-page">
  <img src="ressources/Pull.jpg" class="img-responsive" style="margin:0px auto;" />
  </div> 
  <div class="carousel-caption"><font color="#ffe291"><B><h4>Sweat BDE : 35€</h4></B></font></div>
  </div>   
  <!-- Page 2 -->
  <div class="item"> 
  <div class="carousel-page"><img src="ressources/Handspinner.jpg" class="img-responsive img-rounded" 
  style="margin:0px auto;"  /></div> 
  <div class="carousel-caption"><font color="#ffe291"><B><h4>HandSpinner : 5€</h4></B></font></div>
  </div>  
  <!-- Page 3 -->
  <div class="item">  
  <div class="carousel-page">
  <img src="ressources/PhotoClasse (11).jpg" class="img-responsive img-rounded" 
  style="margin:0px auto;"  />
  </div>  
  <div class="carousel-caption"><font color="#ffe291"><B><h4>Photo de classe : 4€</h4></B></font></div>
  </div>     
   <!-- Page 4 -->
  <div class="item"> 
  <div class="carousel-page"><img src="ressources/Double.png" class="img-responsive img-rounded" 
  style="margin:0px auto;"  /></div> 
  <div class="carousel-caption"><font color="#ffe291"><B><h4>Pack 2 photos : 7€</h4></B></font></div>
  </div> 
   <!-- Page 5 -->
  <div class="item"> 
  <div class="carousel-page"><img src="ressources/Gobelet.jpg" class="img-responsive img-rounded" 
  style="margin:0px auto;"  /></div> 
  <div class="carousel-caption"><font color="#ffe291"><B><h4>Gobelet BDE : 1.5€</h4></B></font></div>
  </div> 
   <!-- Page 6 -->
  <div class="item"> 
  <div class="carousel-page"><img src="ressources/Menu.jpg" class="img-responsive img-rounded" 
  style="margin:0px auto;"  /></div> 
  <div class="carousel-caption"><font color="#ffe291"><B><h4>Commande tous les jours avant 10h45</h4></B></font></div>
  </div> 
  </div>
  <!-- Contrôles -->
  <a class="left carousel-control" href="#my_carousel" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#my_carousel" data-slide="next">
  <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
  </div>
</div>

      <table align="center">
           
<h4 align="center">Horaires d'ouverture du point de vente BDE : <br />.</h4>

   <tr>
       <th align="center" style="width:300px; height:100px;"></th>
       <th align="center" style="width:300px; height:100px;"></th>
       <th align="center" style="width:300px; height:100px;"></th>
   </tr>


   <tr>

       <td>Lundi</td>
       <td>10h15-10h45</td>
       <td>15h15-15h45</td>

   </tr>

    <tr>

       <td>Mardi</td>
       <td>10h15-10h45</td>
       <td>15h15-15h45</td>

   </tr>   

   <tr>

       <td>Mercredi</td>
       <td>10h15-10h45</td>
       <td>15h15-15h45</td>

   </tr>  

   <tr>

       <td>Jeudi</td>
       <td>10h15-10h45</td>
       <td> / </td>

   </tr>  

   <tr>

       <td>Vendredi</td>
       <td>10h15-10h45</td>
       <td>15h15-15h45</td>

   </tr>  

</table>

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

</body>
</html>