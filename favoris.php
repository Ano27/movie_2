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
  $datas = voirFilmFavoris($id_user);
}else {
  die('403');
}
?>

<?php include('inc/header.php'); ?>
<table style="width:100%">
  <tr>
    <th>title</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($datas as $data) {
    echo '<tr>';
      echo '<td>' . $data['title'] . '</td>';
    echo '</tr>';
  } ?>
  </table>

<?php include('inc/footer.php');
