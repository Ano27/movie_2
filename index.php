<?php

include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

$sql = "SELECT * FROM movies_full
        ORDER BY RAND()
        LIMIT 10";
$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();
//---------------------------------------------------------------------------------
//traitement php
//---------------------------------------------------------------------------------
=======

  include('inc/header.php');?>

  <?php foreach ($movies as $movie): ?>
      <h2><?= $movie['title']; ?></h2>
      <p><?= $movie['poster_flag']; ?></p>
  <?php endforeach; ?>

<?php include('inc/footer.php');
