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
foreach ($movies as $movie) {
  echo '<h1>' . $movie['title'] . '</h1>';
  echo affiche($movie);
}
include('inc/footer.php');
