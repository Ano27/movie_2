<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

  $movies = getdscrition();
  include('inc/header.php');?>

  <?php foreach ($movies as $movie): ?>


    <!-- <div class="affichefilm"><h2><?php echo $movie['title']; ?></h2>
    <h2 id="titrefilm"><a href="detail.php?id=<?php echo $movie['id']; ?>"></h2>
    <?php affiche($movie)?></div> -->

    <?php
    // PROF 
      // ici c'est le slug et non id du film a faire passer
      // penser dans le fichier detail d'aller chercher le film à partir du slug et non de id
     ?>

      <?php echo '<li class="affichefilm">'.'<a id="titrefilm" href="detail.php?id='.$movie['id'].'" >' .$movie['title'] . '</a></li>';?>
      <?php echo  affiche($movie)?>

  <?php endforeach; ?>
  <a id="plusdefilm" href="index.php">« + de films ! »</a>

<?php include('inc/footer.php');
