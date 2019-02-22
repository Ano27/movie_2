<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');?>
<?php
// is Logged ????
  //403
  //id user => SESSION
// REQUEST
if (isLogged()) {
  $id_user = $_SESSION['user']['id'];
  $aVoirs = voirFilmFavoris($id_user);

}else {
  die('403');
}
?>

<?php include('inc/header.php'); ?>
<a id="Retourhome" href="index.php">← Retour en arrière</a>
<table style="width:80%">
  <tr>
    <th>Titre</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($aVoirs as $aVoir) {
    echo '<tr>';
      echo '<td>' . $aVoir['titre'] . '</td>';
      echo '<td>'. '<a id="supprimerlisteavoir" href="supprimerlisteavoir.php?id='.$aVoir['idnote'].'">'. '<i title="Supprimer de ma liste" class="fas fa-times"></i>' .'</a>'.'</td>';
    echo '</tr>'; ?>
    <!-- <form class="" action="" method="post">
      <select class="" name="note">

      </select>
      <input type="hidden" name="movieid" value="<?php echo $aVoir['id'] ?>">
      <input type="submit" name="submitted" value="Notez">
    </form> -->
  <?php } ?>
</table>

<?php include('inc/footer.php');
