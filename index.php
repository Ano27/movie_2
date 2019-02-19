<?php
include('inc/fonction.php');
// --------------------------------------------------------------------------------
//PDO => connexion base de donne
include('inc/pdo.php');
//---------------------------------------------------------------------------------
//traitement php
$sql="SELECT * FROM reves
      ORDER BY createdate DESC
      LIMIT 10";
  $query =$pdo->prepare($sql);
  $query->execute();
  $reves =$query->fetchAll();
//---------------------------------------------------------------------------------
  include('inc/header.php');
// --------------------------------------------------------------------------------

 ?>
<?php


    // foreach ($reves as $reve) {
    //   echo '<p>'.$reve["reve"].'<br>'.$reve["auteur"].'<br>'.date("d/m/Y à h/i ",strtotime($reve["createdate"])). '<br><a href="likes.php?id='.$reve['id'].'">likes'.$reve['likes'] .'</a><br><a href="dislikes.php?id='.$reve['id'] .'">dislikes'.$reve['dislikes'].'</a></p>';
    // }
    ?>
    <?php foreach ($reves as $reve): ?>
        <h2><?= $reve['reve']; ?></h2>
        <p>date <?= date("d/m/Y à h/i ",strtotime($reve["createdate"])); ?></p>
        <p><?= $reve["auteur"] ?></p>
        <p><?= '<a href="likes.php?id='.$reve['id'].'">likes'.$reve['likes']  .'</a>'?></p>
        <p><?= '<a href="dislikes.php?id='.$reve['id'].'">dislikes'.$reve['dislikes'] .'</a>' ?></p>
    <?php endforeach; ?>

<!-- html -->
<a href="add.php">cliquer ici</a>
<?php
// --------------------------------------------------------------------------------
  include('inc/footer.php');
