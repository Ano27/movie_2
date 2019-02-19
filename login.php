<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');
// print_r($_SESSION);
$error = array();
//Form est soumis
if (!empty($_POST['submitted'])) {
  //Faille XSS
  $login = trim(strip_tags($_POST['login']));
  $password = trim(strip_tags($_POST['password']));
  if (empty($login) OR empty($password)) {
    $error['login'] = 'Veuillez renseigner les deux champs';
  }
  if(count($error) == 0) {
    //Verifier si il existe un user avec ce mail ou ce pseudo => login
    $sql = "SELECT * FROM users WHERE pseudo = :login OR email = :login";
    $query = $pdo->prepare($sql);
    $query->bindValue(':login',$login,PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();
    if (!empty($user)) {
      // debug($user);
      // die();
      if (password_verify($password,$user['password'])) {
        // ok tout est verifié, creation de la session user
        $_SESSION['user'] = array(
          'id'     => $user['id'],
          'email'  => $user['email'],
          'pseudo' => $user['pseudo'],
          'roles'  => $user['roles'],
          'ip'     => $_SERVER['REMOTE_ADDR'],
        );
        header('Location: index.php');
        die();
      } else {
        $error['login'] = 'Erreur de connexion';
      }
    } else {
      $error['login'] = 'Erreur de connexion';
    }
  }
}

include_once('inc/header.php');
?>
<form class="" method="post">

  <label for="login">Pseudo / Email</label>
  <span class="error"><?php if(!empty($error['login'])) { echo $error['login']; } ?></span>
  <input type="text" name="login" value="">
  <br>
  <label for="password">Mot de passe</label>
  <input type="password" name="password" value="">
  <input class="" type="submit" name="submitted" value="Connexion">

</form>

<a href="forgetpassword.php">Mot de passe oublié</a>

<?php include_once('inc/footer.php');
