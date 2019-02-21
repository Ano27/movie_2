<?php
include('../inc/pdo.php');
include('../inc/fonction.php');
include('../inc/request.php');
$error = array();
if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
 $id = $_GET['id'];
 $user = getAllUsers();
 // if articles existe
 if(!empty($user)) {
   if($user['id'] == 1){
     $sql = "UPDATE articles SET status = 0 WHERE id = :id";
   } else {
     $sql = "UPDATE articles SET status = 1 WHERE id = :id";
   }
   $stmt = $pdo->prepare($sql);
   $stmt->bindValue(':id',$id, PDO::PARAM_INT);
   $stmt->execute();
   // header("Location: index.php");
   // die;
 }else {
   abort404();
 }

}else {
 abort404();
}
