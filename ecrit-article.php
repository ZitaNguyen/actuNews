<!-- 
    OBJECTIF: mettre en place le formulaire permettant l'ajout d'un article dans la base de donnée

    CONSIGNE: 
    1. mettre en place le formulaire HTML
    2. valider le formulaire a l'aide de PHP
    3. inserer l'article en BDD sans tenir compte de l'image
    4. BONUS: gerer l'upload de l'image
    5. BONUS: apres l'insertion, redirigez l'utilisateur sur l'article nouvellement cree

-->
<?php
ob_start();
require_once(__DIR__ . ('/partials/header.php'));

$auteur = isOnline();
if(!$auteur) {

    // Il n'y a pas d'auteur connecté
    // Redirection sur la page d'acceuil
    redirection('connexion.php');
}

$categories = getCategories();

$titre = $contenu = $image = $categorie_id = $auteur_id= null;

if (!empty($_POST)) {
    
    // Recuperation de la saisie de l'utilisateur
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $image = $_FILES['image']; // je recupere un fichier avec la superglobale $_FILES
    $categorie_id = $_POST['categorie_id'];
    $auteur_id = $auteur['id'];

    // Traitement de l'upload
    //var_dump($image);
    // die('Arret du PHP');

        // Recuperation des donnees de l'image a uploader
        $fileTmp = $image['tmp_name']; // emplacement temporaire de l'image sur le serveur

        // recuperation de l'extension de mon image
        $extension = pathinfo($image['name'])['extension'];

        // je donne un nom a mon image
        $fileName = slugify($titre) . '.' . $extension;

        // je definie la destination de mon image. L'endroit ou stocker mon fichier
        $destination = __DIR__ . '/assets/img/article/' . $fileName;

        // Pour finir, je deplace mon image, du dossier temporaire vers mon dossier projet
        move_uploaded_file($fileTmp, $destination);

        // j'envoi dans ma BDD, le nom de l'image
        $image = $fileName;

    // Debut des verification
    $errors = [];

    if (empty($titre)) {
        $errors['titre'] =  'Le titre est vide.';
    }

    if (!empty($titre) && strlen($titre) > 100) {
        $errors['titre'] = 'Le titre est trop long. Pas plus de 100 caractères.';
    }

    if (empty($contenu)) {
        $errors['contenu'] = 'Le contenu est vide.';
    }

    if (!empty($contenu) && strlen($contenu) < 50) {
        $errors['contenu'] = 'Le contenu est trop court.';
    }

    if (empty($image)) {
        $errors['image'] = 'Il n\'y pas image';
    }

    if (empty($categorie_id)) {
        $errors['categorie_id'] = 'Il n\'y pas categorie choisi';
    }

    // Fin des verifications des champs.
    if (empty($errors)) {
        
        // S'il n'y pas d'erreur, je continu mon process
        $idArticle = ecritArticle($titre, $contenu, $image, $categorie_id, $auteur_id);

        if ($idArticle) {
            
            // Si $idArticle ne retourne pas false, alors l'article a bien ete ajoute en BDD. Je redirige l'utilisateur sur le nouvel article
            redirection('article.php?id_article=' . $idArticle);

        }
    }

} // Fin $_POST

?>

<div class="container">
    <p class="display-2 text-center my-5">Ecrire Mon Article</p>

    <form method="POST" enctype="multipart/form-data">

        <!-- Champ Titre -->
        <div class="form-group row">
            <label class="col-2 col-form-label">Titre</label>
            <div class="col-10">
                <input type="text" class="form-control <?= isset($errors['titre']) ? 'is-invalid' : '' ?>" name="titre" value="<?= $titre ?>" placeholder="Titre de mon article...">
                
                <div class="invalid-feedback">
                    <?= isset($errors['titre']) ? $errors['titre'] : '' ?>
                </div><!-- invalid-feedback -->
            </div><!-- col -->
        </div><!-- row -->

        <!-- Champ Contenu -->
        <div class="form-group row">
            <label class="col-2 col-form-label">Contenu</label> 
            <div class="col-10">
                <textarea class="form-control <?= isset($errors['contenu']) ? 'is-invalid' : '' ?>" name="contenu" rows="10" placeholder="Contenu de mon article...">
                    <?= $contenu ?>
                </textarea>
                
                <div class="invalid-feedback">
                    <?= isset($errors['contenu']) ? $errors['contenu'] : '' ?>
                </div><!-- invalid-feedback -->
            </div><!-- col -->  
        </div><!-- row -->

        <!-- Champ Categorie -->
        <div class="form-group row">
            <label class="col-form-label col-2">Categories</label>
            <div class="col-10">
                <select name="categorie_id" class="form-control <?= isset($errors['categorie_id']) ? 'is-invalid' : '' ?>">
                    <option value="">Ma catégorie</option>
                    <?php foreach ($categories as $categorie) { ?>
                    <option value="<?= $categorie['id'] ?>" <?= $categorie_id == $categorie['id'] ? "selected" : "" ?>>
                        <?= $categorie['nom'] ?>
                    </option>
                    <?php } ?>
                </select>
                
                <div class="invalid-feedback">
                        <?= isset($errors['categorie_id']) ? $errors['categorie_id'] : '' ?>
                </div><!-- invalid-feedback -->
            </div><!-- col -->
        </div><!-- row -->

        <!-- Champ Image -->
        <div class="form-group row">
            <label class="col-form-label col-2">Image</label>
            <div class="col-10 ">
                <input type="file" class="form-file-control" name="image">
                
                <div class="invalid-feedback">
                    <?= isset($errors['image']) ? $errors['image'] : '' ?>
                </div><!-- invalid-feedback -->
            </div><!-- col -->
        </div><!-- row -->

        <!-- Button -->
        <div class="form-group row ">
            <button type="submit" class="btn btn-secondary offset-2 form-control">
                Publier Mon Article
            </button>
        </div><!-- row -->
        
    </form>
</div>

<?php

require_once (__DIR__ . ('/partials/footer.php'));

?>