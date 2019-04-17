<?php
// Inclusion de header.php sur la page
require_once(__DIR__.'/partials/header.php');

// Recuperation du nom de la categorie dans l'URL
$nom_categorie = (isset($_GET['nom_categorie'])) ? $_GET['nom_categorie'] : '';
$id_categorie = (isset($_GET['id_categorie'])) ? $_GET['id_categorie'] : 0;

$articles = getArticlesByCategorieId($id_categorie);


?>

<div class="container">

    <div class="row">
        <p class="display-2 mx-auto mt-3"><?= $nom_categorie; ?></p>
    </div>

    <?php if (empty($articles)) { ?>

        <div class="alert alert-info">
            Il n\'y a pas des articles dans ce categorie.
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
                        <small class="text-muted"><?= $article['prenom'] . ' ' . $article['nom'] ?></small>
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