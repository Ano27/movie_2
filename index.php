<?php

include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

$sql = "SELECT * FROM movies_full
        ORDER BY RAND()
        LIMIT 4";
$query = $pdo->prepare($sql);
$query->execute();

$movies = $query->fetchAll();




//---------------------------------------------------------------------------------
//traitement php
//---------------------------------------------------------------------------------



  include('inc/header.php');?>

  <?php foreach ($movies as $movie): ?>
      <div class="affichefilm"><h2 id="titrefilm"><?= $movie['title']; ?></h2>
      <?php affiche($movie)?></div>
  <?php endforeach; ?>
  <a id="plusdefilm" href="index.php">« + de films ! »</a>

<?php include('inc/footer.php');
