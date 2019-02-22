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
    $writer = trim(strip_tags($_POST['writers']));
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

   } else {
      $error['title']='veuillez renseigner un titre';
   }

   // ----------------------------------------------------------verif note ---------------------------------------------

    if (!empty($writer)) {
      // email
      if (mb_strlen($writer)<15) {
        $error['writers']='min 15 caractere';
      } else if(mb_strlen($writer)> 1500) {
        $error['writers']='max 1500 caractere';
      }

    } else {
        $error['writers']='veuillez renseigner un resumer';
    }
// ----------------------------------------------------verif annee -------------------------------------------------
if (!empty($annee)) {
  if (mb_strlen($annee) != 4) {
    $error['year'] = 'L annee doit contenir 4 caractères';
  }
} else {
  $error['year'] = 'Veuillez renseigner une annee';
}
//-------------------------------------------------verif rating------------------------------------------------------
if (!empty($rating)) {
  if (mb_strlen($rating) != 2) {
    $error['rating'] = 'La note doit contenir 2 caractères';
  }
} else {
  $error['rating'] = 'Veuillez renseigner une note';
}
// ----------------------------------------------------verif auteur ---------------------------------------------------------------

    if (!empty($director)) {
      if (mb_strlen($director) < 6) {
        $error['directors'] = 'Auteur doit contenir au moins 6 caractères';
      }
    } else {
      $error['directors'] = 'Veuillez renseigner un auteur';
    }

    // validation poster



 if ($_FILES['poster']['error'] > 0)  {
          $errors['poster'] = 'problème !';
  }else {
        $file_name = $_FILES['poster']['name']; // Le nom du fichier
        $file_size = $_FILES['poster']['size']; // La taille (peu fiable depend du )
        $file_tmp = $_FILES['poster']['tmp_name']; // Le chemin du fichier temporaire
        $file_type = $_FILES['poster']['type']; // tyme MIME
        $sizeMax = 2000000;
      if ($file_size > $sizeMax || filesize($file_tmp) > $sizeMax) {
        $errors['poster'] = 'image trop volumineuse, max 2 Mo';
      }else {
        $goodExtension = array('image/gif', 'image/x-icon', 'image/jpeg', 'image/jpg', 'image/png');
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type
        $mime = finfo_file($finfo, $file_tmp);
        finfo_close($finfo);
      if (!in_array($mime,$goodExtension)) {
        $errors['poster'] = 'error mime type';
      }else {
        $fichierExtension = strtolower(strrchr($file_name, '.'));

    }
  }
}



    // error = 0
    // 4 => image pas obligatire
      // taille fichier
      // mime type



// ----------------------------------------------envoi requete ------------------------------------------------------------------
  if(count($error) == 0) {



          $slug= $titre .'-'.$annee;
          $slug = slugify($slug);

         //die ($token);
         $sql = "INSERT INTO movies_full (slug, title ,year ,genres , plot,directors, cast, writers, runtime, mpaa,rating,popularity,modified,created, poster_flag )
                  VALUES (:slug, :title, :year, :genres,:plot, :directors, :cast, :writers,:runtime,:mpaa,:rating,:popularity, NOW(), NOW(), 1)";
         // preparation de la requête
         $stmt = $pdo->prepare($sql);

         // Protection injections SQL
         $stmt->bindValue(':slug',$slug, PDO::PARAM_STR);
         $stmt->bindValue(':title',$titre, PDO::PARAM_STR);
         $stmt->bindValue(':year',$annee, PDO::PARAM_INT);
         $stmt->bindValue(':genres',$genre, PDO::PARAM_STR);
         $stmt->bindValue(':directors',$director, PDO::PARAM_STR);
         $stmt->bindValue(':cast',$casting, PDO::PARAM_STR);
         $stmt->bindValue(':writers',$writer, PDO::PARAM_STR);
         $stmt->bindValue(':rating',$rating, PDO::PARAM_INT);
         $stmt->bindValue(':popularity',$popularity, PDO::PARAM_INT);
         $stmt->bindValue(':mpaa',$mpaa, PDO::PARAM_STR);
         $stmt->bindValue(':runtime',$runtime, PDO::PARAM_INT);
         $stmt->bindValue(':plot',$plot, PDO::PARAM_STR);
         // execution de la requête preparé
         $stmt->execute();

         $newId = $pdo->lastInsertId();

         $newFichier = $newId.'.jpg';

         if (move_uploaded_file($file_tmp,'../posters/'.$newFichier)) {
             header("Location: index.php");

         }else {
           echo 'pas bravo';
         }






         // move upload


         die();

  }       // id du film

  }

         // header // login.php
        // header("Location: index.php");






include('inc/header.php'); ?>


<form id="formulaire" class="" action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label id="label" for="titre">Titre</label>
    <input class="form-control" type="text" name="title" value="<?php if(!empty($_POST['title'])) { echo $_POST['title']; } ?>" placeholder="Ex: Le film">
    <span class="error" style="color:red"><?php if(!empty($error['title'])) { echo $error['title']; } ?></span>
    </div>

    <label id="label" for="year">Annee</label>
    <input class="form-control" type="number" name="year" value="<?php if(!empty($_POST['year'])) { echo $_POST['year']; } ?>" placeholder="ex: 1994">
      <span class="error" style="color:red"><?php if(!empty($error['year'])) { echo $error['year']; } ?></span><br>

    <label id="label" for="writers">Resumer</label>
    <input class="form-control" type="text" name="writers" value="<?php if(!empty($_POST['writers'])) { echo $_POST['writers']; } ?>" placeholder="Ex: Le Resumer">
    <span class="error" style="color:red"><?php if(!empty($error['writers'])) { echo $error['writers']; } ?></span><br>


    <label id="label" for="genres">genre</label>
    <input class="form-control" type="text" name="genres" value="<?php if(!empty($_POST['genres'])) { echo $_POST['genres']; } ?>" placeholder="Ex: Le genre">

    <label id="label" for="directors">Auteur</label>
    <input class="form-control" type="text" name="directors" value="<?php if(!empty($_POST['directors'])) { echo $_POST['directors']; } ?>" placeholder="Ex: L auteur">
    <span class="error" style="color:red"><?php if(!empty($error['directors'])) { echo $error['directors']; } ?></span><br>

    <label id="label" for="cast">casting</label>
    <input class="form-control" type="text" name="cast" value="<?php if(!empty($_POST['cast'])) { echo $_POST['cast']; } ?>" placeholder="Ex: Le casting">

    <label id="label" for="rating">Note</label>
    <input class="form-control" type="number" name="rating" value="<?php if(!empty($_POST['rating'])) { echo $_POST['rating']; } ?>" placeholder="ex :19">
    <span class="error" style="color:red"><?php if(!empty($error['rating'])) { echo $error['rating']; } ?></span><br>

    <label id="label" for="popularity">Populariter</label>
    <input class="form-control" type="number" name="popularity" value="<?php if(!empty($_POST['popularity'])) { echo $_POST['popularity']; } ?>" placeholder="ex :19">

    <label id="label" for="runtime">Dureer</label>
    <input class="form-control" type="number" name="runtime" value="<?php if(!empty($_POST['runtime'])) { echo $_POST['runtime']; } ?>" placeholder="ex :190">

    <label id="label" for="mpaa">mpaa</label>
    <input class="form-control" type="text" name="mpaa" value="<?php if(!empty($_POST['mpaa'])) { echo $_POST['mpaa']; } ?>" placeholder="Ex: L auteur">

    <label id="label" for="plot">plot</label>
    <input class="form-control" type="text" name="plot" value="<?php if(!empty($_POST['plot'])) { echo $_POST['plot']; } ?>" placeholder="Ex: L auteur">



      <input type="file" name="poster" value="">
      <span class="error" style="color:red"><?php if (!empty($errors['poster'])) { echo $errors['poster']; } ?></span>

    <input id="boutoninscription" class="btn btn-primary" type="submit" name="submitidee" value="S'inscrire">




    $stmt->bindValue(':plot',$plot, PDO::PARAM_STR);

</form>

<?php
 include('inc/footer.php');
