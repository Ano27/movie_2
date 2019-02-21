<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

  $movies = getdscrition();

$datas = array(
  'Drama',
  'Fantasy',
  'Romance',
  'Action',
  'Thriller',
  'Comedy',
  'Adventure',
  'Animation',
  'Family',
  'Sci-Fi',
  'Mystery',
  'Crime',
  'Horror',
  'Music',
  'War',
  'Biography',
  'History',
  'Documentary',
  'Musical',
  'Western',
  'Sport',
  'Short',
  'Film-Noir',
  'N/A',
  'News',
);
  include('inc/header.php');?>

  <?php foreach ($movies as $movie): ?>
    <div class="affichefilm">
      <h2><?php echo $movie['title']; ?></h2>
      <h2 id="titrefilm"><a class="blanco" href="detail.php?id=<?php echo $movie['id']; ?>"></h2>
      <?php affichdeft($movie)?>
    </div>
  <?php endforeach ?>
  <div class="clear"></div>
  <?php foreach ($datas as $data): ?>
    <label for=""><?php echo $data; ?></label>
    <input type="checkbox" name="" value="">
    <br>
  <?php endforeach; ?>
  <a id="plusdefilm" href="index.php">« + de films ! »</a>

<?php include('inc/footer.php');
