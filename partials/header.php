<?php
    
    // Inclusion du fichier global
    require_once (__DIR__ . '/../functions/global.php');
    
    // Inclusion du fichier database
    require_once (__DIR__. '/../config/database.php');


    // Inclusion de nos fonctions
    require_once (__DIR__ . '/../functions/categories.php');
    require_once (__DIR__ . '/../functions/articles.php');
    require_once (__DIR__ . '/../functions/auteur.php');
    
    // Recuperation des categories de la base
    // $categories = ['Politique', 'Economie', 'Culture', 'Sports'];
    $categories = getCategories();

    // Si un auteur est en session, alors $auteur prendra comme valeur le tableau d'auteur. sinon, $auteur prendra comme valeur false
    $auteur = isOnline();
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>ActuNews | Premier site d'actualité en France</title>

    <!-- Bootraps CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Styles personnalisés -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Menu du site -->
    <nav class="navbar navbar-light bg-info justify-content-between">
        <div class="container">
            <div class="nav row">
                    <a href="index.php" class="navbar-brand text-white">ActuNews</a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <?php 
                        foreach ($categories as $categorie) { ?>
                            <a href="categorie.php?nom_categorie=<?= $categorie['nom']; ?>&id_categorie=<?= $categorie['id']; ?>
                            " class="nav-item nav-link text-white"><?= $categorie['nom']; ?></a>
                        <?php } ?>  
                    </div><!-- navbar-collapse -->    
            </div><!-- nav row --> 
            
            <div class="nav row align-items-center">
                <?php if ($auteur) { ?>
                    
                    <div class="col-lg-3 col-md-6 order-md-last col-sm-12 my-2 text-right">
                        <span class="text-white text-capitalize my-auto">
                            Bonjour, <strong><?= $auteur['prenom'] ?></strong>
                        </span>
                    </div><!-- col -->

                    <div class="col-lg-3 col-md-6 my-2">
                        <a href="ecrit-article.php" class="nav-item nav-link btn btn-outline-dark bg-dark text-white mr-sm-2"><small>Ecrire un Article</small></a>
                    </div><!-- col -->

                    <div class="col-lg-3 col-md-6 my-2">
                        <a href="mes-articles.php?id_auteur=<?= $auteur['id'] ?>" class="nav-item nav-link btn btn-outline-dark bg-dark text-white mr-sm-2"><small>Mes Articles</small></a>
                    </div><!-- col -->

                    <div class="col-lg-3 col-md-6 my-2">
                        <a href="deconnexion.php" class="nav-item nav-link btn btn-outline-dark bg-dark text-white mr-sm-2"><small>Deconnexion</small></a>
                    </div><!-- col -->
                    
                <?php } else { ?>

                    <div class="col-md-6 my-2">
                        <a href="connexion.php" class="nav-item nav-link btn btn-outline-dark bg-dark text-white mr-sm-2">Connexion</a>
                    </div><!-- col -->

                    <div class="col-md-6 my-2">
                        <a href="inscription.php" class="nav-item nav-link btn btn-outline-dark bg-dark text-white mr-sm-2">Inscription</a>
                    </div><!-- col -->

                <?php } ?>
                
            </div><!-- nav row -->
            
            

                <!-- <div class="input-group col-md-5 col-sm-12 my-1">
                    <input type="text" class="form-control" placeholder="&#xF002;" style="font-family:Arial, FontAwesome">
                    <div class="input-group-append mask">
                        <button class="btn btn-outline-light" type="button">Go</button>
                    </div>
                </div><--input-group -->

                
                
        </div><!-- container -->
    </nav>

    <!-- Fin du menu du site -->
    

    