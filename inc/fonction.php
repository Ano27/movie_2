<?php
function debug($a)
{
  echo '<pre>';
  print_r($a);
  echo '</pre>';
}
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
function emailvalidation($error,$value,$key) {
  if (!empty($value)) {
    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
      echo 'VALID';
    } else {
        $error[$key] = 'Veuillez entrer votre email';
      }
  }
}
function randomString() {
  $length = 16;
  $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $str = "";

  for ($i = 0; $i < $length; $i++) {
      $str .= $chars[mt_rand(0, strlen($chars) - 1)];
      }

      return $str;
}
 ?>
