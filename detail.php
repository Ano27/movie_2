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
  $film = array();
    if ($id == $movies['id']) {
      $film = $movies;
    }
  if (!empty($film)) {
  } else {
    die('404');
  }
} else {
    die('404');
 }
include('inc/header.php'); ?>
<div class="wrap">
  <h2>Titre : <?php echo $film['title'] ?></h2>
  <p><?php affiche($film)?></p>
  <h3>Année : <?php echo $film['year'] ?></h3>
  <h3>Réalisateur : <?php echo $film['directors'] ?></h3>
  <h3>Note : <?php echo $film['rating'] ?></h3>
  <a href="index.php">Home</a>
</div>
<?php include('inc/footer.php');
