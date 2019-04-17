<?php
// Inclusion de header.php sur la page
require_once(__DIR__.'/partials/header.php');
?>

<?php
    $email = $password = null;

    if (!empty($_POST)) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];

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
    
    }

    if (empty($errors)) {

        // Debut du processus de connexion
        if (connexion($email, $password)) {

            // l'utilisateur est bien connecte
            // la fonction connexion a retourne true
            redirection('.');

        } else {

            // probleme avec l'authentification
            // la fonction connexion a retourne false
            $errors['email'] = "Email/ Mot de passe incorrect.";
        }

    }
?>


<div class="container">

    <div class="row">
        <p class="display-4 mx-auto mt-3">Connexion</p>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">

            <?php if (isset($_GET['inscription'])) { ?>
                <div class="alert alert-info">
                        Félicitation. Vous pouvez connecter.
                </div>
            <?php } ?>

            <form  novalidate method="POST" class="form-horizontal">

                <!-- Champ Email -->
                <div class="form-group">
                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" placeholder="Email" name="email" value="<?= $email ?? $_GET['email'] ?? '' ?>">
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
                
                <!-- Champ Button -->
                <button class="btn btn-block btn-dark">Connexion</button>
            </form>
        </div>
    </div>
    
</div>

<?php
// Inclusion de footer.php sur la page
require_once(__DIR__.'/partials/footer.php');
?>