<?php
include('inc/pdo.php');
include('inc/fonction.php');
include('inc/request.php');
$error=array();
// -------------------------------------------------------action bouton----------------------------------------------
if ( !empty($_POST['submitidee']) )
 {
    // Protection XSS
    $pseudo = trim(strip_tags($_POST['pseudo']));
    $email = trim(strip_tags($_POST['email']));

    $password2=trim(strip_tags($_POST['password2']));
    $password = trim(strip_tags($_POST['password']));
// ----------------------------------------------------------verif erreur pseudo----------------------------------------------
   if (!empty($pseudo))
   {
     if (mb_strlen($pseudo)<3)
     {
       $error['pseudo']='min 3 caractere';
     }
     else if(mb_strlen($pseudo)> 80)
     {
       $error['pseudo']='max 80 caractere';
     }
     else
     {
       $sqlpseudo="SELECT pseudo FROM users WHERE pseudo = :pseudo";
       $smtp=$pdo->prepare($sqlpseudo);
       $smtp->bindValue(':pseudo',$pseudo);
       $smtp->execute();
       $pseudoexist=$smtp->fetch();
       if(!empty($pseudoexist))
       {
         $errors['pseudo']= 'veuiller renseigner ce champ';
       }
     }

   }
   // ----------------------------------------------------------verif erreur email ---------------------------------------------
   if (!empty($email)) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error['email'] = 'Adresse email invalide';
    } else {
      $sql = "SELECT email FROM users WHERE email = :email";
    	$query = $pdo->prepare($sql);
      $query->bindValue(':email',$email,PDO::PARAM_STR);
    	$query->execute();
    	$emailexist = $query->fetch();
      if (!empty($emailexist)) {
        $error['email'] = 'Cette adresse e-mail existe déjà';
      }
    }
  } else {
      $error['email'] = 'Veuillez entrer votre email';
    }
    if (!empty($email)) {
      // email
      if (mb_strlen($email)<15) {
        $error['email']='min 15 caractere';
      } else if(mb_strlen($email)> 80) {
        $error['email']='max 80 caractere';
      } else {
        $sqlemail="SELECT email FROM users WHERE email= :email";
        $smtp=$pdo->prepare($sqlemail);
        $smtp->bindValue(':email',$email);
        $smtp->execute();
        $emailexist=$smtp->fetch();
        if(!empty($emailexist))
        {
          $errors['email']= 'cette adrese email existe dèjà';
        }
      }

    }
// ----------------------------------------------------verif mdp ---------------------------------------------------------------

    if (!empty($password) OR !empty($password2)) {
      if($password != $password2) {
        $error['password'] = 'Les deux mots de passe ne sont pas identique';
      } elseif (mb_strlen($password) < 6) {
        $error['password'] = 'mot de passe doit contenir au moins 6 caractères';
      }
    } else {
      $error['password'] = 'Veuillez renseigner un mot de passe';
    }
// ----------------------------------------------envoi requete ------------------------------------------------------------------

   if (count($error) == 0) {
        $hashedPAssword= password_hash($password, PASSWORD_DEFAULT);
        $role='user';
        $token= randomString();
         //die ($token);
         $sql = "INSERT INTO users ( pseudo, email ,password ,createdat ,token, roles ) VALUES ( :pseudo, :email, :password,NOW(),'$token', '$role')";
         // preparation de la requête
         $stmt = $pdo->prepare($sql);

         // Protection injections SQL
         $stmt->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
         $stmt->bindValue(':email',$email, PDO::PARAM_STR);
         $stmt->bindValue(':password',$hashedPAssword, PDO::PARAM_STR);

         // execution de la requête preparé
         $stmt->execute();

         // header // login.php
        header("Location: index.php");
       }

  }

include('inc/header.php'); ?>


<form id="formulaire" class="" action="" method="post">
    <div class="form-group">
    <label id="label" for="pseudo">• Pseudo *</label>
    <input class="form-control" type="text" name="pseudo" value="<?php if(!empty($_POST['pseudo'])) { echo $_POST['pseudo']; } ?>" placeholder="Ex: Bob">
    <span class="error" style="color:red"><?php if(!empty($error['pseudo'])) { echo $error['pseudo']; } ?></span>
    </div>

    <label id="label" for="email">• Email *</label>
    <input class="form-control" type="text" name="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>" placeholder="Ex: bob@gmail.com">
    <span class="error" style="color:red"><?php if(!empty($error['email'])) { echo $error['email']; } ?></span><br>

    <label id="label" for="password">• Mot de passe *</label>
    <input class="form-control" type="password" name="password" value="" placeholder="Le mot de passe">
    <span class="error" style="color:red"><?php if(!empty($error['password'])) { echo $error['password']; } ?></span><br>

    <label id="label" for="password2">• Verifier votre mot de passe *</label>
    <input class="form-control" type="password" name="password2" value="" placeholder="Retappe le mot de passe">

    <input id="boutoninscription" class="btn btn-primary" type="submit" name="submitidee" value="S'inscrire">



</form>

<?php
 include('inc/footer.php');
