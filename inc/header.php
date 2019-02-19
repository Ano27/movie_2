<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Movies_2</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/style.css">
  </head>
  <body>
    <header>


      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Movies_2</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <?php if (!isLogged()) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">• S'identifier</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="register.php">• Créer un compte</a>
                </li>
              <?php } else { ?>
                <li class="nav-item">
                  <a class="nav-link" href="deconnexion.php">• Déconnexion</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="profil.php">• Profil</a>
                </li>
                <?php echo 'Bonjour'.' '. $_SESSION['user']['pseudo']; ?>
              <?php } ?>
              <?php if (isAdmin()) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="admin/index.php">• Go au Back</a>
                </li>
              <?php } ?>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
          </form>
        </div>
      </nav>


    </header>
    <div class="wrap">
