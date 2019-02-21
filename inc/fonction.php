<?php
session_start();
//------------------------------------------------------------------------------Fonction debug-------------------------------------------------------------------------------
function debug($a)
{
  echo '<pre>';
  print_r($a);
  echo '</pre>';
}
//------------------------------------------------------------------------------Creation Compte a dbb------------------------------------------------------------------------
function createart($error,$value,$key,$min,$max,$text)
{
  if (!empty($value))
  {
          if(mb_strlen($value) < $min )
          {
  		      $error[$key] = 'Votre '.$text.' est trop court. (minimum '.$min.' caractères)';
    			}
           elseif(mb_strlen($key) >$max)
          {
    				$error[$key] = 'Votre '.$text.'est trop long.';
    			}
  } else
    {
      	$error[$key] = 'Veuillez entrer votre '.$text;
    }

    return $error;
}
//------------------------------------------------------------------------------Verification de compte email----------------------------------------------------------------
function emailvalidation($error,$value,$key) {
  if (!empty($value)) {
    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
      echo 'VALID';
    } else {
        $error[$key] = 'Veuillez entrer votre email';
      }
  }
}
// -----------------------------------------------------------------------------Generateur de Token-------------------------------------------------------------------------
function randomString() {
  $length = 16;
  $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $str = "";

  for ($i = 0; $i < $length; $i++) {
      $str .= $chars[mt_rand(0, strlen($chars) - 1)];
      }

      return $str;
}
//------------------------------------------------------------------------------Fonction de connexion compte---------------------------------------------------------------
function isLogged() {
  if (!empty($_SESSION['user']['id'])) {
    if (is_numeric($_SESSION['user']['id'])) {
      if (!empty($_SESSION['user']['pseudo'])) {
        if (!empty($_SESSION['user']['email'])) {
          if (!empty($_SESSION['user']['roles'])) {
            if (!empty($_SESSION['user']['ip'])) {
              if ($_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
                return true;
              }
            }
          }
        }
      }
    }
  }
  return false;
}
//------------------------------------------------------------------------------Fonction administrateur--------------------------------------------------------------------
function isAdmin() {
  if (isLogged()) {
    if ($_SESSION['user']['roles'] == 'SuperUser') {
      return true;
    }
  }
  return false;
}
//------------------------------------------------------------------------------de coter mais a garder, ancienne affichage ------------------------------------------------
// function affiche($movie){
//
// 	echo '<img class="image" src="posters/' . $movie['id'] . '.jpg" alt="' . $movie['title'] . '">';
//
// }
// -----------------------------------------------------------------------------affichage Image + filtre d'image-----------------------------------------------------------
function affichdeft($movie){
  $filename = 'posters/' . $movie['id'] . '.jpg';

  if (file_exists($filename)) {
      echo '<img class="image" src="posters/' . $movie['id'] . '.jpg" alt="' . $movie['title'] . '">';
  } else {
      echo '<img src="asset/img/téléchargement.jpg" alt="">';
  }
}
