<?php
include('inc/pdo.php');
include('inc/request.php');
require('inc/fonction.php');?>
<?php
if (isLogged()) {
  if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    // id_user
    $edit = selectsupprimerlisteavoir($id);
    if (!empty($edit)) {
      supprimerlisteavoir($id);

    }
  } else {
    die('404');
  }
} else {
  die('403');
}
header('Location: favoris.php');
die;
