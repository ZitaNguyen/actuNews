<?php

/*

    Dans ce fichier nous allons définir quelques fonctions qui seront utiles pour gérer nos auteurs (membres)

    - Vérifier l'existance d'un membre dans la base
    - Inscrire un membre
    - Connecter un membre
    - Deconnexion

*/

/*

    Permet l'inscription d'un auteur / membre dans la BDD
    Retourne true ou 1 si l'insertion a ete faite correctement
    Retourne false ou 0 si une erreur est survenue

*/

function inscription($prenom, $nom, $email, $password) {
    
    global $db;

    $query = $db->prepare('
        INSERT INTO auteur (`prenom`, `nom`, `email`, `password`)
        VALUES (:prenom, :nom, :email, :password)
    ');

    $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $query->bindParam(':nom', $nom, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

    return $query->execute();
}    

/*

    Permet la connexion d'un utilisateur 
    Le stockage de ses informatiohns en session
    Retourne vrai (true) si la connexion est un succes
    Retourne faux (false) en cas d'echec de connexion

*/
function connexion($email, $password) {

    global $db;

    $sql = 'SELECT * FROM auteur WHERE email = :email';
    $query = $db->prepare($sql);
    $query->bindValue(':email', $email);
    $query->execute();

    // Recuperation de l'auteur dans la base
    $auteur = $query->fetch();

    // on verifie si un auteur a bien ete trouve, et que dans le meme temps, le mot de passe saisie par l'utilisateur dans le formulaire correspond au mot de passe de l'auteur trouve dans la BDD
    if ($auteur && password_verify($password, $auteur['password'])) {
        
        // mettre en session les informations de l'auteur
        $_SESSION['auteur'] = $auteur; // je stock dans ma session PHP à la cle auteur, mon tableau associatif $auteur

        return true;
    }

    return false;
}

/*

    Permet de deconnecter un utilisateur de la session en cours

*/
function deconnexion() {

    unset($_SESSION['auteur']);
    return true;

}