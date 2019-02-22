<?php
require '../vendor/autoload.php';
use JasonGrimes\Paginator;
include('../inc/fonction.php');
// --------------------------------------------------------------------------------
//PDO => connexion base de donne
include('../inc/pdo.php');
include('../inc/request.php');

// $users = getAllUsers();





$totalItems = countUser();
$itemsPerPage = 10;
$currentPage = 1;
$offset = 0;
$urlPattern = '?page=(:num)';
if(!empty($_GET['page'])) {
 $currentPage = $_GET['page'];
 $offset = ($currentPage - 1) * $itemsPerPage;
}
$sql = "SELECT * FROM users
       LIMIT $itemsPerPage OFFSET $offset";
$query = $pdo->prepare($sql);
$query->execute();
$users = $query->fetchAll();
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);



if (isAdmin()) {
  //
}else {
  die('403');
}
//traitement php
 include('inc/header.php');
 ?>

<div class="count">
  <h1>Les nouveau compte</h1>
  <table>
   <tr>
      <th>Pseudo</th>
      <th>Email</th>
      <th>Date de creation</th>
      <th>roles</th>
      <th>Modifié/Supprimé</th>
   </tr>

  <?php
    echo $paginator;
    foreach ($users as $user):
  ?>
     <tr>

       <td><?php echo $user['pseudo']; ?></td>
       <td><?php echo $user['email']; ?></td>
       <td><?php echo $user['createdat']  ?></td>
       <td><?php echo $user['roles']  ?></td>

       <td>
         <a href="modifuseur.php?id=<?php echo $user['id']; ?>">Editer</a>
         <form  onsubmit="return confirm('Do you really want to submit the form?');" action="delete.php" method="post">
           <input type="hidden" name="michel" value="<?php echo $user['id']; ?>">
           <input type="submit" name="submitted" value="delete">
         </form>
       </td>
     </tr>
  <?php endforeach ?>
</table>
</div>
<?php
  include('inc/footer.php');
