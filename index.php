<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

// PROF =>  mettre la requete dans les request.php ++++
  $movies = getdscrition();
  include('inc/header.php');?>

  <?php foreach ($movies as $movie): ?>



      <?php echo '<li class="affichefilm">'.'<a id="titrefilm" href="detail.php?id='.$movie['id'].'" >' .$movie['title'] . '</a></li>';?>
      <?php echo  affiche($movie)?>

  <?php endforeach; ?>
  <a id="plusdefilm" href="index.php">« + de films ! »</a>

<?php include('inc/footer.php');
