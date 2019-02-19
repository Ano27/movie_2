<?php

include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

// --------------------------------------------------------------------------------
//PDO => connexion base de donne





$sql = "SELECT * FROM movies_full
        ORDER BY RAND()
        LIMIT 10";
$query = $pdo->prepare($sql);
$query->execute();
$arts = $query->fetchAll();

// print_r($arts);
// debug($arts);


//---------------------------------------------------------------------------------
//traitement php
//---------------------------------------------------------------------------------
  include('inc/header.php');?>

  <?php foreach ($arts as $art): ?>
      <h2><?= $art['title']; ?></h2>
      <p><?= $art['poster_flag']; ?></p>
  <?php endforeach; ?>

<?php include('inc/footer.php');
