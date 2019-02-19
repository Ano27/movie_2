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
<<<<<<< HEAD
<<<<<<< HEAD
      <?php echo '<li>'.'<a href="detail.php?id='.$movie['id'].'" >' .$movie['title'] . '</a></li>';?>
      <?php affiche($movie)?>
=======
    <h2><?php echo $movie['title']; ?></h2>
    <h2><a href="detail.php?id=<?php echo $movie['id']; ?>"></h2>
    <?php affiche($movie)?>
>>>>>>> 058d71c42b7a9f9d253bf868fb9f0189d667f1cf
=======
      <div class="affichefilm"><h2 id="titrefilm"><?= $movie['title']; ?></h2>
      <?php affiche($movie)?></div>
>>>>>>> 33123990ecd0aeab6759f1ea5a046f60d49c7d13
  <?php endforeach; ?>
  <a id="plusdefilm" href="index.php">« + de films ! »</a>

<?php include('inc/footer.php');
