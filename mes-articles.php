<?php

require_once(__DIR__.'/partials/header.php');

$id_auteur = (isset($_GET['id_auteur'])) ? $_GET['id_auteur'] : 0;

$articles = getArticlesByAuteurId($id_auteur);

?>

<div class="container">

    <div class="row">
        <p class="display-2 mx-auto mt-3">Mes Articles</p>
    </div>

    <?php if (empty($articles)) { ?>
        <div class="alert alert-info">
            Vous n'avez pas encore des articles.
        </div>
    <?php } ?>

    <div class="row">

        <?php foreach($articles as $article) { ?>

            <div class="col-md-4 mt-4">
            
                <div class="card shadow-sm">
                    <img class="card-img-top" src="assets/img/article/<?= $article['image'] ?>" alt="<?= $article['titre'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $article['titre'] ?></h5>
                        <p class="card-text">
                            <?= summarize($article['contenu']) ?>
                            <a href="article.php?id_article=<?= $article['id'] ?>"><u>Lire la suite...</u></a>
                        </p>
                        
                    </div><!-- card-body -->
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted"><?= $article['date_creation'] ?></small>
                        <small class="text-muted text-capitalize"><?= $article['prenom'] . ' ' . $article['nom'] ?></small>
                    </div><!-- card-footer -->
                </div><!-- card -->
            
            </div><!-- col -->
        <?php } ?><!-- fin du foreach $articles -->

    </div><!-- row -->

</div>

<?php
// Inclusion de footer.php sur la page
require_once(__DIR__.'/partials/footer.php');
?>