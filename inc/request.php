<?php
function countFilms(){
	global $pdo;
	$sql = "SELECT COUNT(id) FROM movies_full";
	$query = $pdo->prepare($sql);
	$query->execute();
	$totalFilms = $query->fetchColumn();
	return $totalFilms;
}

function searchArticles($search){
  global $pdo;
  $sql = "SELECT * FROM movies_full WHERE title, cast, directors LIKE :search title AND cast AND directors LIKE :search";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':search','%'.$search.'%', PDO::PARAM_STR);
  $stmt->execute();
  return $stmt->fetchAll();
}
