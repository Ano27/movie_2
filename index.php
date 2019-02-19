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
<<<<<<< HEAD
      <?php echo '<li>'.'<a href="detail.php?id='.$movie['id'].'" >' .$movie['title'] . '</a></li>';?>
      <?php affiche($movie)?>
=======
      <div class="affichefilm"><h2 id="titrefilm"><?= $movie['title']; ?></h2>
      <?php affiche($movie)?></div>
>>>>>>> 33123990ecd0aeab6759f1ea5a046f60d49c7d13
  <?php endforeach; ?>
  <a id="plusdefilm" href="index.php">« + de films ! »</a>

<?php include('inc/footer.php');
