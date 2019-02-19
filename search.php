<?php
include('inc/pdo.php');
include('inc/fonctions.php');
include('inc/request.php');
if(!empty($_GET['search']) && !empty($_GET['submitted'])) {
  $search = $_GET['search'];
  $movies = searchArticles($search);
}else {
  die('404');
}
include('inc/header.php');

include('inc/footer.php');
