<?php

include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');
include('inc/header.php');?>

<?php if (!isLogged()) { ?>
  <a href="register.php">Compte</a>
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


<?php include('inc/footer.php');
