<?php
require'Config.php';

$articlesParPage = 10;
$articlesTotalesReq = $bdd->query('SELECT id FROM articles');
$articlesTotales = $articlesTotalesReq->rowCount();
$pagesTotales = ceil($articlesTotales/$articlesParPage);
if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
   $_GET['page'] = intval($_GET['page']);
   $pageCourante = $_GET['page'];
} else {
   $pageCourante = 1;
}
$depart = ($pageCourante-1)*$articlesParPage;
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
   </head>
   <body>
      <?php
      $articles = $bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT '.$depart.','.$articlesParPage);
      while($art = $articles->fetch()) {
      ?>
      <b>N°<?php echo $art['id']; ?> - <?php echo $art['titre']; ?></b><br />
      <i><?php echo $art['contenu']; ?></i>
      <br /><br />
      <?php
      }
      ?>
      <?php
      for($i=1;$i<=$pagesTotales;$i++) {
         if($i == $pageCourante) {
            echo $i.' ';
         } else {
            echo '<a href="index.php?page='.$i.'">'.$i.'</a> ';
         }
      }
      ?>
   </body>
</html>