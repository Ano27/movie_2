<?php
function countFilms(){
	global $pdo;
	$sql = "SELECT COUNT(id) FROM movies_full";
	$query = $pdo->prepare($sql);
	$query->execute();
	$totalFilms = $query->fetchColumn();
	return $totalFilms;
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

function getMovieById($id) {
	global $pdo;
	$sql = "SELECT * FROM movies_full
					WHERE id = :id";
	$query = $pdo->prepare($sql);
	$query->bindValue(':id',$id,PDO::PARAM_INT);
	$query->execute();
	$movie = $query->fetch();
	return $movie;

}
function getMovieBySlug($slug){
	global $pdo;
	$sql = "SELECT * FROM movies_full
          WHERE slug = :slug";
  $query = $pdo->prepare($sql);
  $query->bindValue(':slug',$slug,PDO::PARAM_STR);
  $query->execute();
	return $query->fetch();
}
function leslog(){
	$sql = 'SELECT pseudo, email ,createdat FROM famille_tbl';
}
