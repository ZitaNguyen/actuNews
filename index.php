<?php
// Inclusion de header.php sur la page
require_once(__DIR__.'/partials/header.php');

$articles = getArticles();

?>

<div class="container">

    <div class="row">
        <p class="display-4 mx-auto">ActuNews</p>
    </div>
    
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