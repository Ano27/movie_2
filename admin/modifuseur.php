<?php
include('../inc/fonction.php');

include("../inc/pdo.php");

$error = array();

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM users
          WHERE id = :id";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id',$id,PDO::PARAM_INT);
  $query->execute();
  $modif = $query->fetch();
  // debug($article);
 if(!empty($modif)) {
   // if form soumis

   if(!empty($_POST['submitted'])) {
     // faille xss
		 // Protection XSS
     $pseudo = trim(strip_tags($_POST['pseudo']));
     $email = trim(strip_tags($_POST['email']));

     $roles = trim(strip_tags($_POST['roles']));


		 // validzation de chaque champ
		 $error = createart($error,$pseudo,'pseudo',3,50,'titre');
     $error = createart($error,$email,'email',5,50,'content');

     $error = createart($error,$roles,'roles',3,50,'auteur');

     if(count($error)==0) {
			 		$sql = "UPDATE users SET pseudo = :pseudo, email = :email, roles = :roles, modate = NOW() WHERE id = :id";
					$query = $pdo->prepare($sql);
					$query->bindValue(':id',$id, PDO::PARAM_INT);
					$query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
          $query->bindValue(':email',$email, PDO::PARAM_STR);
					$query->bindValue(':roles',$roles, PDO::PARAM_STR);
					$query->execute();
					// edirection
					header('Location: index.php');
							exit();
     }
   }

  }
  else {
    die('404');
  }
}else {
  die('404');
}
 include('inc/header.php'); ?>



<h1>modifierl'utilisateur</h1>
<form class="modifuser" action="" method="post">
    <div class="form-group">
      	<label for="title">Nouveau pseudo</label>
      	<span class="error"><?php if(!empty($error['pseudo'])) { echo $error['pseudo']; } ?></span>
        <br>
        <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?php  if(!empty($_POST['pseudo'])) { echo $_POST['pseudo']; } else { echo $modif['pseudo']; } ?>" />
    </div>

    <div class="form-group">
        <label for="email">nouvel email</label>
        <span class="error"><?php if(!empty($error['email'])) { echo $error['email']; } ?></span>
        <br>
        <input type="text" name="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } else { echo $modif['email']; } ?>">
    </div>

    <div class="form-group">
      <label for="roles">choisiser un role</label>
      <span class="error"><?php if(!empty($error['password'])) { echo $error['password']; } ?></span>
      <br>
      <?php $rollles = array(
        'user' => 'User',
        'SuperUser' => 'Super user'
      ); ?>
      <select class="" name="roles">

        <?php foreach($rollles as $key => $value) { ?>
            <option <?php if($key == $modif['roles']) {echo 'selected="selected" ';} ?>value="<?= $key; ?>"><?= $value; ?></option>
        <?php } ?>
      </select>

    </div>
    <input type="submit" name="submitted" class="btn btn-primary" value="Envoyer !" />

</form>
<?php
// --------------------------------------------------------------------------------
  include('inc/footer.php');
