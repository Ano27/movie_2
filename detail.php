<?php
include('inc/pdo.php');
include('inc/fonction.php');
include('inc/request.php');
// title year directors rating
// PROF =>  Faire avec le slug
if(!empty($_GET['slug'])) {
  $slug = $_GET['slug'];
  $movie = getMovieBySlug($slug);
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

  <?php
    if (isLogged()) { ?>
      <a class="blanc red centre" href="filmavoir.php?id=<?php echo $movie['id']; ?>" title="Ajouter aux favoris"><i class="fas fa-heart"></i></a>
    <?php } ?>
<?php include('inc/footer.php');
