<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="include/css/style.css">

    <!--  fonts -->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://kit.fontawesome.com/0cec3451bc.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body class="bg-body">
    <header>
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-godeal static-top">
        <div class="container">
          <a class="navbar-brand" href="index.php">
                <img src="include/img/logo1.svg" alt="index.php">
              </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <?php
                if (empty($_SESSION)) {
                    echo '<li class="nav-item">
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        S\'inscrire
                      </button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="index.php?action=InscriptionEntreprise">Entreprise</a>
                        <a class="dropdown-item" href="index.php?action=InscriptionPrestataire">Prestataire</a>
                      </div>
                    </div>
                  </li>';
                }
                if (!empty($_SESSION)) {
                  echo '
                    <li class="nav-item">
                    <a class="nav-link" disabled>'. $_SESSION["nomUsager"]. '</a>
                    </li>
                    <li class="nav-item">
                      <div class="dropdown show">
                        <a class="dropdown-toggle secondary-color" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        </a>
      
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">';
                        if ($_SESSION["role"]== "entreprise") {
                          echo '<a class="dropdown-item" href="index.php?action=AddProject">Ajouter un Projet</a>
                                <a class="dropdown-item" href="index.php?action=MyProjects">Mes Projets</a>';
                        }
                        if ($_SESSION["role"]== "prestataire") {
                          echo '<a class="dropdown-item" href="index.php?action=MyApplications">Mes Demandes</a>
                          ';
                        }  
                        if ($_SESSION["role"]== "admin") {
                          echo '<a class="dropdown-item" href="index.php?action=DemandesEnAttente">Gestion des demandes</a>
                          <a class="dropdown-item" href="index.php?action=UtilisateursEntreprise">Gestion d\'Utilisateurs</a>
                          <a class="dropdown-item" href="index.php?action=Projets">Gestions des Projets</a>';
                        }   
                          echo '<a class="dropdown-item" href="index.php?action=Profile">Mon Profile</a>
                                <a class="dropdown-item" href="index.php?action=Logout">Quitter</a>
                        </div>
                      </div>
                      </li>';
                }
              ?>

              
              <?php 
              if (empty($_SESSION)) {
                echo '<li class="nav-item"> 
                <a class="btn btn-primary margin-left" href="index.php?action=Login" role="button">Se connecter</a>  
                </li>';
              }
              
              ?>
            </ul>
          </div>
        </div>
      </nav>
      
    </header>  
  
