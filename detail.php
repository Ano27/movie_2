<?php
include('inc/pdo.php');
include('inc/fonction.php');
// title year directors rating
// PROF =>  Faire avec le slug
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  ///////////////////////////
  //    PROF
  // Mettre request dans request.php
  // en faire une en cherchant film à partir de id et une autre à par du slug
  // ex: getMovieById() , getMovieBySlug() !!!!
  //////////////////////
  $sql = "SELECT * FROM movies_full
          WHERE id = :id";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id',$id,PDO::PARAM_INT);
  $query->execute();
  $movies = $query->fetch();
  $movie = array();
    if ($id == $movies['id']) {
      $movie = $movies;
    }
  if (!empty($movie)) {
  } else {
    die('404');
  }
} else {
    die('404');
 }
include('inc/header.php'); ?>
<div class="wrap">
<<<<<<< HEAD
  <h2>Titre : <?php echo $film['title'] ?></h2>
  <p><?php affichdeft($film)?></p>
  <h3>Année : <?php echo $film['year'] ?></h3>
  <h3>Réalisateur : <?php echo $film['directors'] ?></h3>
  <h3>Note : <?php echo $film['rating'] ?></h3>
  <a href="index.php">Home</a>
=======
  <a id="Retourhome" href="index.php">← Retour en arrière</a>
  <h2 class="detailinfos">Titre : <?php echo $movie['title'] ?></h2>
  <p id="affichedefilm"><?php affichdeft($movie)?></p>
  <h3 class="detailinfos">Année : <?php echo $movie['year'] ?></h3>
  <h3 class="detailinfos">Réalisateur : <?php echo $movie['directors'] ?></h3>
  <h3 class="detailinfos">Note : <?php echo $movie['rating'] ?></h3>
>>>>>>> b4559cb2d129aa1183fa01be9f63c7b5424daffc
</div>
<?php include('inc/footer.php');
