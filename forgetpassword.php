<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');
if (!empty($_POST['submitted'])) {
  // Protection faille XSS
  $email = trim(strip_tags($_POST['email']));
  if (empty($email) || (filter_var($email,FILTER_VALIDATE_EMAIL) === FALSE)) {
    $error['email'] = 'Adresse email invalide';
  } else {
    //verifier si user existe
    $sql = "SELECT * FROM users WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();
    if (!empty($user)) {
      $tokenEncode = urlencode($user['token']);
      $emailEncode = urlencode($user['email']);
      $url = 'http://localhost/movie/movie_2/modifiedpassword.php?email='.$emailEncode . '&token='.$tokenEncode;
      $html = '<p>Veuillez cliquer sur le lien ci-dessous</p>';
      $html .= '<p><a href="'.$url.'">Click ici pour modifier ton mot de passe</a></p>';
      echo $html;
      die('Attention');
    } else {
      $error['email'] = 'Ne marche pas';
    }
  }
}





include_once('inc/header.php'); ?>
<a id="Retourhome" href="index.php">← Retour en arrière</a>
<form id="formulaire" class="" method="post">
  <div class="form-group">
    <label id="label" for="email">• Email *</label>
    <input type="text" class="form-control" name="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>"placeholder="Ex: bob@gmail.com">
    <span class="error" style="color:red"><?php if(!empty($error['email'])) { echo $error['email']; } ?></span>
  </div>
  <input class="btn btn-primary" type="submit" name="submitted" value="Envoyer">
</form>
<?php include_once('inc/footer.php');
