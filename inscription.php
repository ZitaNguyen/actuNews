<?php

// Inclusion de header.php sur la page
require_once(__DIR__.'/partials/header.php');

?>

<?php
    $nom = $prenom = $email = $password = $passConfirm = $content = null;

    if (!empty($_POST)) {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passConfirm = $_POST['passConfirm'];

        $errors = [];

        /******* Verification Nom *******/
        if (empty($nom)) {
            $errors['nom'] = 'Votre nom est vide';
        }

        /******* Verification Prenom *******/
        if (empty($prenom)) {
            $errors['prenom'] = 'Votre prenom est vide';
        }

        /******* Verification Email *******/
        if (empty($email)) {
            $errors['email'] = 'Votre email est vide';
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Votre email est non-valid';
        }

        /******* Verification Password *******/
        if (empty($password)) {
            $errors['password'] = 'Votre password est vide';
        }

        if (!empty($password) && strlen($password)<8) {
            $errors['password'] = 'Votre password est trop court';
        }

        if ($password !== $passConfirm) {
            $errors['password'] = 'Vos passwords ne sont pas identique';
        }

        /*******  Work in Database *******/
        if (empty($errors)) {
                
            // Je procede à l'inscription en base
            if (inscription($prenom, $nom, $email, $password)) {
                    
                    // puis redirection sur la page de connexion
                    redirection('connexion.php?inscription=success&email=' . $email);
            }

        } else {
            $content = '
                <div class="alert alert-danger">
                    Remplissiez tous les champs s\'il vous plaît.
                </div>
            ';
        }
    }

    
?>

<div class="container">

    <div class="row">
        <p class="display-4 mx-auto mt-3">Inscription</p>
    </div>
    
    <div class="row">
        <div class="col-md-6 offset-md-3">

            <form novalidate method="POST" class="form-horizontal">

                <?= $content ?>

                <!-- Champ Nom -->
                <div class="form-group">
                    <input type="text" class="form-control <?= isset($errors['nom']) ? 'is-invalid' : '' ?>" placeholder="Nom" name="nom" value="<?= $nom; ?>">
                    <div class="invalid-feedback">
                        <?= isset($errors['nom']) ? $errors['nom'] : '' ?>
                    </div>
                </div>

                <!-- Champ Prenom -->
                <div class="form-group">
                    <input type="text" class="form-control <?= isset($errors['prenom']) ? 'is-invalid' : '' ?>" placeholder="Prenom" name="prenom" value="<?= $prenom; ?>">
                    <div class="invalid-feedback">
                        <?= isset($errors['prenom']) ? $errors['prenom'] : '' ?>
                    </div>
                </div>

                <!-- Champ Email -->
                <div class="form-group">
                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" placeholder="Email" name="email" value="<?= $email; ?>">
                    <div class="invalid-feedback">
                        <?= isset($errors['email']) ? $errors['email'] : '' ?>
                    </div>
                </div>

                <!-- Champ Password -->
                <div class="form-group">
                    <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" placeholder="Mot de passe" name="password">
                    <div class="invalid-feedback">
                        <?= isset($errors['password']) ? $errors['password'] : '' ?>
                    </div>
                </div>

                <!-- Champ Confirm Password -->
                <div class="form-group">
                    <input type="password" class="form-control <?= isset($errors['password']) || isset($errors['passConfirm']) ? 'is-invalid' : '' ?>" placeholder="Mot de passe a nouveau" name="passConfirm">
                </div>

                <!-- Button -->
                <button class="btn btn-block btn-dark">Inscrire</button>
            </form>
        </div>
    </div>

</div>

<?php
// Inclusion de footer.php sur la page
require_once(__DIR__.'/partials/footer.php');
?>