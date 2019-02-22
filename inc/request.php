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
	$movie = $query->fetch();
	return $movie;
}

function getAllUsers(){
	global $pdo;
	$sql = "SELECT * FROM users
					ORDER BY createdat DESC
					LIMIT 5";
	$query = $pdo->prepare($sql);
	$query->execute();
	$users = $query->fetchAll();
	return $users;
}
function getAllAdmin() {
	global $pdo;
	$sql = "SELECT * FROM movies_full
	        ORDER BY title	ASC
					LIMIT 100";
	$query = $pdo->prepare($sql);
	$query->execute();
	$movies = $query->fetchAll();
	  return $movies;
}
function getAlldscrition() {
	global $pdo;
	$sql = "SELECT * FROM movies_full
	        ORDER BY created	DESC
					LIMIT 30";
	$query = $pdo->prepare($sql);
	$query->execute();
	$movies = $query->fetchAll();
	  return $movies;
}
function countUser(){
	global $pdo;
	$sql = "SELECT COUNT(id) FROM users ";
	$query = $pdo->prepare($sql);
	$query->execute();
	$totalFilms = $query->fetchColumn();
	return $totalFilms;
}
// function statfilm() {
// 	global $pdo;
// 	$sql = "SELECT 	* FROM movies_full
// 	        ORDER BY created ASC
// 	        LIMIT 30";
// 	$query = $pdo->prepare($sql);
// 	$query->execute();
// 	$movies = $query->fetchAll();
// 	  return $movies;
// }

// function ajoutFilmFavoris() {
// 	global $pdo;
// 	$sql = "INSERT INTO 'movies_full' ()"
// }
