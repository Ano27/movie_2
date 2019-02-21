<?php
include('../inc/fonction.php');
// --------------------------------------------------------------------------------
//PDO => connexion base de donne
include('../inc/pdo.php');
include('../inc/request.php');
 $users = getAllUsers();
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

  <?php foreach ($users as $user): ?>
    <div class="afficheuti">
      <h2><?php echo $user['pseudo']; ?></h2>
      <h2><?php echo $user['email']; ?></h2>
      <h2><?php echo $user['createdat']  ?></h2>
      <h2><?php echo $user['roles']  ?></h2>
    </div>
  <?php endforeach ?>



<?php
// --------------------------------------------------------------------------------
  include('inc/footer.php');
  // On affiche chaque entrée une à une
