<?php
function countFilms(){
	global $pdo;
	$sql = "SELECT COUNT(id) FROM movies_full";
	$query = $pdo->prepare($sql);
	$query->execute();
	$totalFilms = $query->fetchColumn();
	return $totalFilms;
}
function getArticleById($id) {
  global $pdo;
    $sql = "SELECT * FROM articles WHERE id = :id";
    $query = $pdo->prepare($sql);
  $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
    return $data;
}
