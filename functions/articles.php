<?php
/*

    CONSIGNE: Créer 3 fonctions:

    1. getArticles(): permet de retourner tous les articles de la base
    2. getArticleById(): permet de recuperer un article grace a son ID
    3. getArticlesByCategorieId(): permet de recuperer les articles d'une categorie, grace a ID de la categorie

*/

// Retourne les articles de la BDD
function getArticles() {
    
    global $db;
    $query = $db->query('
        SELECT article.id, titre, contenu, image, prenom, nom, date_creation 
        FROM article, auteur 
        WHERE article.auteur_id = auteur.id 
        ORDER BY article.id DESC
    ');

    return $query->fetchAll();

}

function getArticleById($id_article) {

    global $db;
    $sql = '
        SELECT * FROM article, auteur 
        WHERE article.id = :id
        AND article.auteur_id = auteur.id
    ';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id_article);
    $query->execute();

    return $query->fetch();
    
}

function getArticlesByCategorieId($categorie_id) {
    global $db;
    $sql = '
        SELECT article.id, titre, contenu, image, prenom, nom, date_creation 
        FROM article, auteur 
        WHERE article.categorie_id = :id
        AND article.auteur_id = auteur.id
    ';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $categorie_id); 
    $query->execute();

    return $query->fetchAll();
   
}

function getArticlesByAuteurId($auteur_id) {
    global $db;
    $sql = '
        SELECT article.id, titre, contenu, image, prenom, nom, date_creation
        FROM article, auteur 
        WHERE auteur.id = :id
        AND article.auteur_id = auteur.id
    ';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $auteur_id); 
    $query->execute();

    return $query->fetchAll();
   
}

function ecritArticle($titre, $contenu, $image, $categorie_id, $auteur_id) {
    
    global $db;

    $query = $db->prepare('
        INSERT INTO article (`titre`, `contenu`, `image`, `categorie_id`, `auteur_id`)
            VALUES (:titre, :contenu, :image, :categorie_id, :auteur_id)
    ');

    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':contenu', $contenu, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);

    $query->bindValue(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $query->bindValue(':auteur_id', $auteur_id, PDO::PARAM_INT);

    // Si mon article a bien ete insere dans la BDD. Alors je retourne l'ID de l'article. Sinon, je retourne faux...
    return $query->execute() ? $db->lastInsertId() : false;
}    
