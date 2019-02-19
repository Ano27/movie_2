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
function getdscrition() {
	global $pdo;
	$sql = "SELECT * FROM movies_full
	        ORDER BY RAND()
	        LIMIT 6";
	$query = $pdo->prepare($sql);
	$query->execute();
	$movies = $query->fetchAll();
	  return $movies;
}

function searchMovies($search){
  global $pdo;
  $sql = "SELECT * FROM movies_full WHERE title LIKE :search OR cast LIKE :search OR directors LIKE :search";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':search','%'.$search.'%', PDO::PARAM_STR);
  $stmt->execute();
  return $stmt->fetchAll();
}
