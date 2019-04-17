<?php

// demarrage de la session PHP
session_start();

/*
    Nous pourrons définir ici toutes les fonctions utiles a notre projet et utilisable sur toutes les pages
*/
/*
    Permet de rediriger un utilisateur sur une nouvelle page
*/
function redirection($page) {
    header('location: ' . $page);
}

/*
    Permet de verifier si un auteur est connecte en session
*/
function isOnline() {
    return isset($_SESSION['auteur']) ? $_SESSION['auteur'] : false;
}

/*
    Permet de générer une accroche
*/

function summarize($text) {
    
    // Suppression des balises HTML
    $string = strip_tags($text);

    // Si mon $string est supérieur à 150, je continue
    if (strlen($string) > 150) {

        // je coupe ma chaine à 150
        $stringCut = substr($string, 0, 150);

        // je m'assure de ne pas couper un mot
        // en recherchant la position du dernier espace
        $string = substr($stringCut, 0, strrpos($stringCut, ' '));
    }

    return $string . '...';

}

function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

