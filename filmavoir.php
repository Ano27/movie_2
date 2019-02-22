<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');?>
<?php
// debug($_SESSION);
if (isLogged()) {
  $id_user = $_SESSION['user']['id'];
  if (!empty($_GET['id'])) {
    $id_movie = $_GET['id'];
    $movie = getMovieById($id_movie);
    if (!empty($movie)) {
      ajoutFilmFavoris($id_user,$id_movie);
    }else {
      die('404');
    }
  }else {
    die('404');
  }
}else {
  die('403');
}

header('Location: favoris.php');
