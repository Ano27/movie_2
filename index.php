<?php

include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

// --------------------------------------------------------------------------------
//PDO => connexion base de donne
$sql = "SELECT * FROM movies_full
        ORDER BY RAND()
        LIMIT 4";
$query = $pdo->prepare($sql);
$query->execute();
$arts = $query->fetch();
//---------------------------------------------------------------------------------
//traitement php
//---------------------------------------------------------------------------------
  include('inc/header.php');?>
// --------------------------------------------------------------------------------

<?php include('inc/footer.php');
