<?php include 'include/header.php';?>
    <div class="container-fluid home-banner mb-5">
        <div class="row justify-content-center">
            <div class="col">
                <h2 class="text-white mb-3">Bienvenue sur Freelancer</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3">
                <form action="index.php" method="post">
                    <input type="text" class="form-control" name="mots">
            </div>
            <div class="col-1">
                <input type="hidden" name="action" value='Recherche'/>
                <input class="btn btn-primary float-right" type="submit" name="submit" value="    Chercher    ">  
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <?php
            if (!isset($_SESSION['role']) || (isset($_SESSION['role']) && $_SESSION['role'] == "prestataire")) {
                $display ='';
            }else{
                $display ="d-none";
            }
            while ($row = mysqli_fetch_assoc($donnee)) {
                if (isset($_SESSION['idUsager']) && CheckIfApplyed($_SESSION['idUsager'], $row["idProjet"])) {
                   $applyed = "applyed";
                   $postuler = '<i class="far fa-check-circle"></i> Postulé';
                }else{
                    $applyed = "";
                    $postuler = "Postuler";
                }
                echo   '<div class="data-row col-10 offset-1 p-4 mb-4">
                    <div class="row">
                        <div class="col-10">
                            <div class="project-title text-capitalize">' . $row["titre"] . '</div>
                            <div class="company-name">' . $row["nom_entreprise"] . '</div>
                        </div>
                        <div class="col">
                            <div><a class="btn btn-primary float-right '. $display .'' . $applyed . '" href="index.php?action=Apply&idProject=' . $row["idProjet"] . '" role="button">' . $postuler . '</a></div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        
                        <div class="col-2">
                            <div class="short-description"><i class="far fa-clock"></i>' . $row["duree"]  . ' heurs</div>
                        </div>
                        <div class="col-2">
                            <div class="short-description"><i class="fas fa-dollar-sign"></i>' . number_format($row["budget"], 0, '.', ' ')  . '</div>
                        </div>
                        <div class="col-3">
                            <div class="short-description"><i class="fas fa-map-marker-alt"></i></i>' . $row["ville"] . '</div>
                        </div>
                        <div class="col-3">
                            <div>Categorie : '.GetCategoryNaneByProjectId($row["idProjet"]).'</div>
                        </div>
                        <div class="col-2 float-right">
                            <div><a role="button" class="btn btn-outline-info float-right collapsed" data-toggle="collapse" href="#test'.$row["idProjet"].'" aria-expanded="false" aria-controls="test'.$row["idProjet"].'"><i class="fas fa-plus pr-1"></i>Détail
                            </a></div>
                        </div>
                    </div>
                    <div class="row mt-2" >
                        <div class="col collapse" id="test'.$row["idProjet"].'" aria-expanded="false">
                                <div class="short-description">' . $row["description"]. '</div>
                            </div>
                    </div>
                    
                </div>';
            
        }
        if (isset($msgErreur)) {
            echo '<p class="alert alert-info"> '. $msgErreur .'</p>';
        }
            ?>

        
    </div>

    </body>
</html>