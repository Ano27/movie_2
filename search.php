<?php
include('inc/pdo.php');
include('inc/fonction.php');
include('inc/request.php');
if(!empty($_GET['search']) && empty($_GET['submitted'])) {
  $search = $_GET['search'];
  $movies = searchMovies($search);
}else {
  die('404');
}
include('inc/header.php'); ?>
<a id="Retourhome" href="index.php">← Retour en arrière</a>
<?php
foreach ($movies as $movie) { ?>
  <h1 id=titrefilm><?php echo $movie['title'] ?></h1>
  <a id="afficherecherche" href="detail.php?slug=<?php echo $movie['slug']; ?>"><?php echo affichdeft($movie) ?></a>
<?php
}
include('inc/footer.php');
