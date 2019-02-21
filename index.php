<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

  $movies = getdscrition();
  include('inc/header.php');?>

  <?php foreach ($movies as $movie): ?>

    <div class="affichefilm"><h2 id="titrefilm"><?php echo $movie['title']; ?></h2>
    <h2><a class="blanco" href="detail.php?id=<?php echo $movie['id']; ?>"></h2>
    <?php affiche($movie)?></div>


  <?php endforeach; ?>
  <a id="plusdefilm" href="index.php">« + de films ! »</a>

<?php include('inc/footer.php');
