<?php
include('../inc/pdo.php');
include('../inc/fonction.php');
include('../inc/request.php');
$error=array();
// -------------------------------------------------------action bouton----------------------------------------------
if ( !empty($_POST['submitidee']) )
 {
    // Protection XSS
    $titre = trim(strip_tags($_POST['title']));
    $annee = trim(strip_tags($_POST['year']));

    $genre=trim(strip_tags($_POST['genres']));
    $director = trim(strip_tags($_POST['directors']));
    $casting = trim(strip_tags($_POST['cast']));
    $rating = trim(strip_tags($_POST['rating']));
    $note = trim(strip_tags($_POST['writers']));
    $popularity = trim(strip_tags($_POST['popularity']));
    $mpaa = trim(strip_tags($_POST['mpaa']));
    $runtime= trim(strip_tags($_POST['runtime']));
    $plot = trim(strip_tags($_POST['plot']));







// ----------------------------------------------------------verif title----------------------------------------------
   if (!empty($titre))
   {
     if (mb_strlen($titre)<3)
     {
       $error['title']='min 3 caractere';
     }
     else if(mb_strlen($titre)> 80)
     {
       $error['title']='max 80 caractere';
     }
     else
     {
       $sqlpseudo="SELECT title FROM movies_full WHERE title = :title";
       $smtp=$pdo->prepare($sqlpseudo);
       $smtp->bindValue(':title',$titre);
       $smtp->execute();
       $titleexist=$smtp->fetch();
       if(!empty($pseudoexist))
       {
         $errors['title']= 'veuiller renseigner ce champ';
       }
     }

   }

   // ----------------------------------------------------------verif note ---------------------------------------------

    if (!empty($note)) {
      // email
      if (mb_strlen($note)<15) {
        $error['writers']='min 15 caractere';
      } else if(mb_strlen($note)> 1500) {
        $error['writers']='max 1500 caractere';
      } else {
        $sqlemail="SELECT writers FROM movies_full WHERE writers= :writers";
        $smtp=$pdo->prepare($sqlemail);
        $smtp->bindValue(':writers',$note);
        $smtp->execute();
        $noteexist=$smtp->fetch();
        if(!empty($noteexist))
        {
          $errors['writers']= 'cette adrese email existe dèjà';
        }
      }

    }
// ----------------------------------------------------verif auteur ---------------------------------------------------------------

    if (!empty($director)) {
      if (mb_strlen($director) < 6) {
        $error['directors'] = 'Auteur doit contenir au moins 6 caractères';
      }
    } else {
      $error['directors'] = 'Veuillez renseigner un auteur';
    }
// ----------------------------------------------envoi requete ------------------------------------------------------------------
          $slug= $titre .'-'.$year;
          $slug = slugify($slug);

         //die ($token);
         $sql = "INSERT INTO movies_full (slug, title ,year ,genres ,directors, cast, writers, rating, modified, poster_flag, popularity, mpaa,	runtime, plot)
                  VALUES ('$slug', :title, :year, :genres, :directors, :cast, :writers,:rating, NOW(),1, :popularity, :mpaa, :runtime, :plot)";
         // preparation de la requête
         $stmt = $pdo->prepare($sql);

         // Protection injections SQL
         $stmt->bindValue(':slug',$slug, PDO::PARAM_STR);
         $stmt->bindValue(':title',$titre, PDO::PARAM_STR);
         $stmt->bindValue(':year',$annee, PDO::PARAM_INT);
         $stmt->bindValue(':genres',$genre, PDO::PARAM_STR);
         $stmt->bindValue(':directors',$director, PDO::PARAM_STR);
         $stmt->bindValue(':cast',$casting, PDO::PARAM_STR);
         $stmt->bindValue(':writers',$note, PDO::PARAM_STR);
         $stmt->bindValue(':rating',$rating, PDO::PARAM_INT);
         $stmt->bindValue(':popularity',$popularity, PDO::PARAM_INT);
         $stmt->bindValue(':mpaa',$mpaa, PDO::PARAM_STR);
         $stmt->bindValue(':runtime',$runtime, PDO::PARAM_INT);
         $stmt->bindValue(':plot',$plot, PDO::PARAM_STR);
         // execution de la requête preparé
         $stmt->execute();

         // id du film

        echo '';

         // header // login.php
        // header("Location: index.php");
       }



include('inc/header.php'); ?>


<form id="formulaire" class="" action="" method="post">
    <div class="form-group">
    <label id="label" for="titre">Titre</label>
    <input class="form-control" type="text" name="titre" value="<?php if(!empty($_POST['title'])) { echo $_POST['title']; } ?>" placeholder="Ex: Le film">
    <span class="error" style="color:red"><?php if(!empty($error['title'])) { echo $error['title']; } ?></span>
    </div>

    <label id="label" for="annee">Annee</label>
    <input class="form-control" type="number" name="annee" value="<?php if(!empty($_POST['year'])) { echo $_POST['year']; } ?>" placeholder="1994">


    <label id="label" for="note">Resumer</label>
    <input class="form-control" type="text" name="titre" value="<?php if(!empty($_POST['writers'])) { echo $_POST['writers']; } ?>" placeholder="Ex: Le Resumer">
    <span class="error" style="color:red"><?php if(!empty($error['writers'])) { echo $error['writers']; } ?></span><br>


    <label id="label" for="genre">genre</label>
    <input class="form-control" type="text" name="genre" value="<?php if(!empty($_POST['genres'])) { echo $_POST['genres']; } ?>" placeholder="Ex: Le genre">

    <label id="label" for="auteur">Auteur</label>
    <input class="form-control" type="text" name="auteur" value="<?php if(!empty($_POST['directors'])) { echo $_POST['directors']; } ?>" placeholder="Ex: L auteur">
    <span class="error" style="color:red"><?php if(!empty($error['directors'])) { echo $error['directors']; } ?></span><br>

    <label id="label" for="casting">casting</label>
    <input class="form-control" type="text" name="genre" value="<?php if(!empty($_POST['cast'])) { echo $_POST['cast']; } ?>" placeholder="Ex: Le casting">

    <label id="label" for="note">Note</label>
    <input class="form-control" type="number" name="note" value="<?php if(!empty($_POST['rating'])) { echo $_POST['rating']; } ?>" placeholder="19">

    <label id="label" for="popu">Populariter</label>
    <input class="form-control" type="number" name="popu" value="<?php if(!empty($_POST['popularity'])) { echo $_POST['popularity']; } ?>" placeholder="19">

    <label id="label" for="runtime">Dureer</label>
    <input class="form-control" type="number" name="popu" value="<?php if(!empty($_POST['runtime'])) { echo $_POST['runtime']; } ?>" placeholder="190">

    <label id="label" for="mpaa">mpaa</label>
    <input class="form-control" type="text" name="mpaa" value="<?php if(!empty($_POST['mpaa'])) { echo $_POST['mpaa']; } ?>" placeholder="Ex: L auteur">

    <label id="label" for="plot">plot</label>
    <input class="form-control" type="text" name="plot" value="<?php if(!empty($_POST['plot'])) { echo $_POST['plot']; } ?>" placeholder="Ex: L auteur">

    <input id="boutoninscription" class="btn btn-primary" type="submit" name="submitidee" value="S'inscrire">




    $stmt->bindValue(':plot',$plot, PDO::PARAM_STR);

</form>

<?php
 include('inc/footer.php');
