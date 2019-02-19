<?php
include('inc/pdo.php');
require('inc/fonction.php');




$recupid= $_GET['id'];

include('inc/header.php');



echo '<div class="wrap">'.$movie['id']."<br>".$movie['title']."<br>".$movie['year']."<br>".$movie['directors']."<br>".$movie['rating']."<br>".$movie['imdb_id'].'</div>';




  include('inc/footer.php');
