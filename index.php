<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');
// --------------------------------------------------------------------------------
//PDO => connexion base de donne




//---------------------------------------------------------------------------------
//traitement php
//---------------------------------------------------------------------------------
  include('inc/header.php');?>
// --------------------------------------------------------------------------------
<h1>Salut</h1>
<h2>ca va</h2>
<h3>c'est bon on maitrise le push pull </h3>
<?php if (!isLogged()) { ?>
  <a href="register.php">Compte</a>
  <br>
  <a href="login.php">Login</a>
<?php } else { ?>
  <a href="deconnexion.php">Deconnexion</a>
  <br>
  <a href="profil.php">Profil</a>
  <br>
  <?php echo 'Bonjour'.' '. $_SESSION['user']['pseudo']; ?>
<?php } ?>
<?php if (isAdmin()) { ?>
  <a href="admin/index.php">Go au Back</a>
<?php } ?>
// --------------------------------------------------------------------------------
<?php include('inc/footer.php');
