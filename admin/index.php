<?php

include('../inc/fonction.php');
// --------------------------------------------------------------------------------
//PDO => connexion base de donne
include('../inc/pdo.php');
include('../inc/request.php');

$users = countUser();
$movies= countFilms();
$statfilms= getAlldscrition();
$statusers=getAllUsers();

if (isAdmin()) {
  //
}else {
  die('403');
}


//---------------------------------------------------------------------------------
//traitement php
 include('inc/header.php');
 ?>
   <a href="lesuser.php">Gestion des utilisateur</a>
   <a href="gestfilm.php">Gestion des film</a>

   <h2>Les Statistique</h2>

   <table>
      <tr>
        <th>Nombre Utilisateur</th>
        <th>Nombre Film</th>
      </tr>
      <tr>
        <td><?php echo $users; ?></td>
        <td><?php echo $movies; ?></td>
      </tr>
   </table>

   <h2>Les dernier film</h2>

   <table>
    <tr>
       <th>Le titre</th>
       <th>La date d ajouts</th>
    </tr>
    <?php
    foreach ($statfilms as $statfilm):

       ?>
       <tr>
         <td><?php echo $statfilm['title']; ?></td>
          <td><?php echo $statfilm['created']; ?></td>
       </tr>
    <?php endforeach ?>
    </table>

    <h2>Les dernier utilisateur</h2>

    <table>
     <tr>
        <th>Les dernier inscrit</th>
        <th>La date d'inscription'</th>
     </tr>
     <?php
     foreach ($statusers as $statuser):

        ?>
        <tr>
          <td><?php echo $statuser['pseudo']; ?></td>
           <td><?php echo $statuser['createdat']; ?></td>
        </tr>
     <?php endforeach ?>
     </table>

<?php
// --------------------------------------------------------------------------------
  include('inc/footer.php');
  // On affiche chaque entrée une à une
