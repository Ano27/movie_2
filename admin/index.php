<?php
include('../inc/fonction.php');
// --------------------------------------------------------------------------------
//PDO => connexion base de donne
include('../inc/pdo.php');
if (isAdmin()) {
  //
}else {
  die('403');
}
//---------------------------------------------------------------------------------
//traitement php
 include('inc/header.php'); ?>

<div class="count">
  <h3>Les nouveau compte</h3>
</div>

<?php
// --------------------------------------------------------------------------------
  include('inc/footer.php');
