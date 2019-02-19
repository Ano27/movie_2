<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');

$error = array();
if (!empty($_GET['email']) && !empty($_GET['token'])) {
  $email = $_GET['email'];
  $token = $_GET['token'];
  $sql = "SELECT * FROM users
          WHERE email = :email
          AND token = :token";
  $query = $pdo->prepare($sql);
  $query->bindValue(':email',$email,PDO::PARAM_STR);
  $query->bindValue(':token',$token,PDO::PARAM_STR);
  $query->execute();
  $user = $query->fetch();
  if (!empty($user)) {
    if (!empty($_POST['submitted'])) {
      $password  = trim(strip_tags($_POST['password']));
      $password2 = trim(strip_tags($_POST['password2']));
      // Validation password
      if (!empty($password) OR !empty($password2)) {
        if($password != $password2) {
          $error['password'] = 'Les deux mots de passe ne sont pas identique';
        } elseif (mb_strlen($password) < 6) {
          $error['password'] = 'mot de passe doit contenir au moins 6 caractères';
        }
      } else {
        $error['password'] = 'Veuillez renseigner un mot de passe';
      }
      //if no error
      if (count($error) == 0) {
        // update de user avec nouveau mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // regeneration d'un nouveau token
        $token = randomString(100);
        $sql = "UPDATE users
                SET password = :password, token = :token
                WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':password',$hashedPassword,PDO::PARAM_STR);
        $query->bindValue(':token',$token,PDO::PARAM_STR);
        $query->bindValue(':id',$user['id'],PDO::PARAM_INT);
        $query->execute();
        header('Location: login.php');
        die();
      }
    }
  } else {
    die('404');
  }
} else {
  die('404');
}

include_once('inc/header.php'); ?>

<h1><a href="index.php"></a> Modifier votre mot de passe</h1>
<form class="" method="post">
  <label for="password">Mot de passe *</label>
  <span class="error"><?php if(!empty($error['password'])) { echo $error['password']; } ?></span>
  <input type="password" name="password" value="">
  <br>
  <label for="password2">Mot de passe *</label>
  <input type="password" name="password2" value="">

  <input class="" type="submit" name="submitted" value="Go">
</form>

<?php include_once('inc/footer.php');
