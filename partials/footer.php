
    <footer>

<div class="bg-info">
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-md ml-3 mt-3">
                <h5>ActuNews</h5>
                <small class="d-block">
                        &copy; <?= date('Y') ?>
                </small>
            </div><!-- col -->

            <div class="col-6 col-md ml-3 mt-3">
                <h5>Catégories</h5>
                <ul class="list-unstyled">
                    <?php foreach($categories as $categorie) { ?>
                        <li>
                            <a href="categorie.php?nom_categorie=<?= $categorie['nom']; ?>&id_categorie=<?= $categorie['id']; ?>" class="text-dark" ><?= $categorie['nom']; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div><!-- col -->

            <div class="col-6 col-md ml-3 mt-3">
                <h5>En plus</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-dark">Mentions Légales</a></li>
                    <li><a href="#" class="text-dark">Politique de Confidentialité</a></li>
                    <li><a href="#" class="text-dark">Plan du site</a></li>
                </ul>
            </div><!--col -->
        </div><!-- row -->
    </div><!-- container -->
</div>

</footer>


<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'contenu' );
</script>

<!-- Fichier JS Personnalise -->
<script src="assets/js/script.js"></script>

</body>
</html>