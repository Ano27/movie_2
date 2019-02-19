<?php

include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

$sql = "SELECT * FROM movies_full
        ORDER BY RAND()
        LIMIT 6";
$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();

  include('inc/header.php');?>

  <?php foreach ($movies as $movie): ?>


    <!-- <div class="affichefilm"><h2><?php echo $movie['title']; ?></h2>
    <h2 id="titrefilm"><a href="detail.php?id=<?php echo $movie['id']; ?>"></h2>
    <?php affiche($movie)?></div> -->

      <?php echo '<li class="affichefilm">'.'<a id="titrefilm" href="detail.php?id='.$movie['id'].'" >' .$movie['title'] . '</a></li>';?>
      <?php  affiche($movie)?>

  <?php endforeach; ?>
  <a id="plusdefilm" href="index.php">« + de films ! »</a>

<?php include('inc/footer.php');
