<?php
include('../inc/fonction.php');
// --------------------------------------------------------------------------------
//PDO => connexion base de donne
include('../inc/pdo.php');
include('../inc/request.php');
 $users = getAllUsers();
if (isAdmin()) {
  //
}else {
  die('403');
}


//---------------------------------------------------------------------------------
//traitement php
 include('inc/header.php'); ?>

<div class="count">
  <h3>Les nouveau compte</h3>
  <table>
   <tr>
      <th>Pseudo</th>
      <th>Email</th>
      <th>Date de creation</th>
      <th>roles</th>
      <th>Modifié/Supprimé</th>
   </tr>

  <?php foreach ($users as $user): ?>
     <tr>

       <td><?php echo $user['pseudo']; ?></td>
       <td><?php echo $user['email']; ?></td>
       <td><?php echo $user['createdat']  ?></td>
       <td><?php echo $user['roles']  ?></td>
       <td><a href="modifuseur.php?id=<?php echo $user['id']; ?>">Editer</a><a onclick="return confirm('voulez vous sup l utilisateur')" href="delete.php?id=<?php echo $user['id']; ?>">Delete</a></td>
     </tr>
  <?php endforeach ?>
</table>
</div>

<?php
// --------------------------------------------------------------------------------
  include('inc/footer.php');
  // On affiche chaque entrée une à une
