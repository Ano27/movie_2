<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

if(!empty($_POST['submitted'])) {

  $movies = array();



  $sql = "SELECT * FROM movies_full WHERE 1 = 1";

  if(!empty($_POST['cat'])) {
    $searchGenres = $_POST['cat'];
    $i = 1;
    // genres
    foreach ($searchGenres as $searchGenre) {
      $s = '%'.$searchGenre . '%';
      if($i == 1) {
        $sql .= " AND genres LIKE '$s'";
      } else {
        $sql .= " OR genres LIKE '$s'";
      }
      $i++;
    }
  }

// popularity
if(!empty($_POST['popularity'])) {
  $tests = explode("-",$_POST['popularity']);
  $sql .= " AND popularity BETWEEN $tests[0] AND $tests[1]";
}
// Year
if(!empty($_POST['year'])) {
  $annee = explode("-",$_POST['year']);
  $sql .= " AND year BETWEEN $annee[0] AND $annee[1]";
}
// sql betweeen


  $sql .= " LIMIT 10";


  $query = $pdo->prepare($sql);
  $query->execute();
  $movies = $query->fetchAll();

} else {
  $movies = getdscrition();
}

  include('inc/header.php');?>
  <?php foreach ($movies as $movie): ?>
    <div class="affichefilm">
      <h2 id="titrefilm"><?php echo $movie['title']; ?></h2>
      <h2><a class="blanco" href="detail.php?slug=<?php echo $movie['slug']; ?>"></h2>
      <div class="afficheposter"><?php affichdeft($movie)?></div>
    </div>
  <?php endforeach ?>
  <div class="clear"></div>
  <a id="plusdefilm" href="index.php">« + de films ! »</a>


<?php include('inc/footer.php');
