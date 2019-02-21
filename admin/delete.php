<?php
include('../inc/pdo.php');
include('../inc/fonction.php');
include('../inc/request.php');

// isAdmin()
if (isAdmin()) {
  //
}else {
  die('403');
}

$error = array();
if(!empty($_POST['submitted'])) {

  if(!empty($_POST['michel'])) {

    $iduser = $_POST['michel'];
    // SELECT user where id = $iduser
    $sql = "SELECT * FROM users
            WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$iduser,PDO::PARAM_INT);
    $query->execute();
    $supuser = $query->fetch();

    // if !emp^ty($user)
    if(!empty($supuser)) {
    // if articles existe
       $sql = "DELETE FROM users WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id',$iduser, PDO::PARAM_INT);
      $stmt->execute();
      header("Location: index.php");
      die;

  }else {
     die('404');


  }



}else {
   die('404');


}}
