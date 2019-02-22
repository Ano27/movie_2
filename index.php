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
      <h2 id="titrefilm"><?php echo $movie['title']; ?></h2>
      <h2><a class="blanco" href="detail.php?slug=<?php echo $movie['slug']; ?>"></h2>
      <?php affichdeft($movie)?>
    </div>
  <?php endforeach ?>
  <div class="clear"></div>
  <a id="plusdefilm" href="index.php">« + de films ! »</a>
  <div class="clear"></div>
    <form class="" method="post" action="">

      <select name="popularity">
        <option value="">--Popularity--</option>
        <option value="0-20">0-20</option>
        <option value="21-40">21-40</option>
        <option value="41-60">41-60</option>
        <option value="61-80">61-80</option>
        <option value="81-100">81-100</option>
      </select>
      <br>
      <select name="year">
        <option value="">--Year--</option>
        <option value="1801-1900">1801-1900</option>
        <option value="1901-1950">1901-1950</option>
        <option value="1951-2000">1951-2000</option>
        <option value="2001-2019">2001-2019</option>
      </select>
  <?php foreach ($datas as $data): ?>
      <label for="" style="color:white;"><?php echo $data ?></label>
      <input type="checkbox" name="cat[]" value="<?php echo $data ?>">
      <br>
  <?php endforeach; ?>
  <?php //debug($datas); ?>
      <input type="submit" name="submitted" value="Filtre">
    </form>

<?php include('inc/footer.php');
