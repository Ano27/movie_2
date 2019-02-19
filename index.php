<?php
include('inc/fonction.php');
// --------------------------------------------------------------------------------
//PDO => connexion base de donne
include('inc/pdo.php');

if (!empty($_GET['page'])){
    $page = $_GET['page'];
    $offset = $page * $num - $num;
}


$sql = "SELECT * FROM articles
            ORDER BY created_at DESC
            LIMIT $offset,$num";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $arts = $stmt->fetchAll();

//---------------------------------------------------------------------------------
//traitement php
//---------------------------------------------------------------------------------
  include('inc/header.php');?>
// --------------------------------------------------------------------------------
<h1>Salut</h1>
<h2>ca va</h2>
<h3>c'est bon on maitrise le push pull </h3>

<a href="login.php">Login</a>

<a href="register.php"> cree Compte</a>

// --------------------------------------------------------------------------------
<?php include('inc/footer.php');
