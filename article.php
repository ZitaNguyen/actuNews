<?php

require_once(__DIR__ . '/partials/header.php');

// $id_article = $_GET['id_article'];

// Si mon parametre id_article n'existe pas dans la route. J'affecte la valeur 0. Ainsi, ma requete ne retournera aucun résultat
// $article = getArticleById($_GET['id_article'] ?? 0);
$article = getArticleById(isset($_GET['id_article']) ? ($_GET['id_article']) : 0);

?>

<!-- Ici, viendra le contenu de ma page -->
<div class="container">

    <div class="row mx-auto my-5">
        <h1 class="text-center display-4"><?= $article['titre'] ?></h1>
    </div><!-- row -->

    <div class="row">
        <img class="img-fluid align-items-center mb-5 mx-auto d-block rounded" src="assets/img/article/<?= $article['image'] ?>" alt="<?= $article['titre'] ?>">
        <p class="text-justify">
            <?= $article['contenu'] ?>
        </p>
        <small class="text-muted text-capitalize"><?= $article['prenom'] . ' ' . $article['nom'] ?></small>   
    </div><!-- row -->

</div><!-- container -->

<?php
// Inclusion de footer.php sur la page
require_once(__DIR__.'/partials/footer.php');
?>