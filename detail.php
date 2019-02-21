<?php
include('inc/pdo.php');
include('inc/fonction.php');
include('inc/request.php');
// title year directors rating
// PROF =>  Faire avec le slug
if(!empty($_GET['slug'])) {
  $slug = $_GET['slug'];

  ///////////////////////////
  //    PROF
  // Mettre request dans request.php
  // en faire une en cherchant film à partir de id et une autre à par du slug
  // ex: getMovieById() , getMovieBySlug() !!!!
  //////////////////////
  $movie = getMovieBySlug($slug);
  // $sql = "SELECT * FROM movies_full
  //         WHERE slug = :slug";
  // $query = $pdo->prepare($sql);
  // $query->bindValue(':slug',$slug,PDO::PARAM_STR);
  // $query->execute();
	// $movie = $query->fetch();
  if (!empty($movie)) {

  } else {
    die('404');
  }
} else {
    die('404');
 }
include('inc/header.php'); ?>
  <a id="Retourhome" href="index.php">← Retour en arrière</a>

  <h2 class="detailinfos">Titre : <?php echo $movie['title'] ?></h2>
  <p id="affichedefilm"><?php affichdeft($movie)?></p>
  <h3 class="detailinfos">Année : <?php echo $movie['year'] ?></h3>
  <h3 class="detailinfos">Réalisateur : <?php echo $movie['directors'] ?></h3>
  <h3 class="detailinfos">Note : <?php echo $movie['rating'] ?></h3>

  <a class="blanc red filmavoirdetail" href="filmavoir.php?slug=<?php echo $movie['slug']; ?>" title="Ajouter aux favoris"><i class="fas fa-heart"></i></a>
<?php include('inc/footer.php');
