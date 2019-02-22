<?php
require '../vendor/autoload.php';
use JasonGrimes\Paginator;
include('../inc/fonction.php');
// --------------------------------------------------------------------------------
//PDO => connexion base de donne
include('../inc/pdo.php');
include('../inc/request.php');


//$movies= getAllAdmin();



$totalItems = countFilms();
$itemsPerPage = 30;
$currentPage = 1;
$offset = 0;
$urlPattern = '?page=(:num)';
if(!empty($_GET['page'])) {
 $currentPage = $_GET['page'];
 $offset = ($currentPage - 1) * $itemsPerPage;
}
$sql = "SELECT * FROM movies_full
       LIMIT $itemsPerPage OFFSET $offset";
$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

if (isAdmin()) {
  //
}else {
  die('403');
}
//---------------------------------------------------------------------------------
//traitement php
 include('inc/header.php');
 ?>
 <div class="count">
<a href="ajoutmovie.php">Ajouter un film</a>
   <h1>Les film</h1>
   <table>
    <tr>
      <th>Numero pour affiche</th>
       <th>Film</th>
       <th>Auteur</th>
       <th>Date de production</th>
       <th>genre</th>
       <th>ajouter le</th>
    </tr>

   <?php
   echo $paginator;
   foreach ($movies as $movie):
      ?>
      <tr>
        <td><?php echo $movie['id']; ?></td>
        <td><?php echo $movie['title']; ?></td>
        <td><?php echo $movie['directors']; ?></td>
        <td><?php echo $movie['year']  ?></td>
        <td><?php echo $movie['genres']  ?></td>
        <td><?php echo $movie['created']  ?></td>




      </tr>

   <?php  endforeach  ?>
 </table>
 <a href="ajoutmovie.php">Ajouter un film</a><a href="ajoutmovie.php">Ajouter un film</a>
 </div>
 <?php
 // --------------------------------------------------------------------------------
   include('inc/footer.php');
