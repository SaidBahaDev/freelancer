<?php include 'include/headerDashboard.php';?>
    <body>
        <div class="col bg-body" id="main">
          <div class="pagetitle">
            <h2>Gestion des Projets</h2>
          </div>
          <div class="row col-11 offset-1 data-head p-3 m-3">
          <div class="col-1">
            <span>ID</span>
            </div>
            <div class="col-4">
            <span>Titre du projet</span>
            </div>
            <div class="col-1">
            <span>Durée</span>
            </div>
            <div class="col-2">
            <span>Budget</span>
            </div>
            <div class="col-2">
            <span>Entreprise</span>
            </div>
            <div class="col-2">
            <div class="text-center">Actions</div>
            </div>
          </div>

               <?php while ($row = mysqli_fetch_assoc($donnee)) {
                    echo '<div class="row col-11 offset-1 data-row p-4 m-3">
                            <div class="col-1">
                            <span>'. $row["idProjet"] .'</span>
                            </div>
                            <div class="col-4">
                            <span>'. $row["titre"] . '</span>
                            </div>
                            <div class="col-1">
                            <span>'. $row["duree"] .'</span>
                            </div>
                            <div class="col-2">
                            <span>'. $row["budget"] .'</span>
                            </div>
                            <div class="col-2">
                            <span>'. $row["nom_entreprise"] . '</span>
                            </div>
                            <div class="col-2 class="text-center"">
                                <div class="text-center">
                                    <a data-toggle="tooltip" title="Modifier" href="index.php?action=EditProject&id='. $row["id"] . '"><i class="far fa-edit p-1"></i></a>
                                    <a data-toggle="tooltip" title="Supprimer" onclick="return confirm(\'Voulez vous vraiment supprimer ? Cette action est irréversible !\')" href="index.php?action=DeleteProject&id='. $row["id"] . '"><i class="far fa-trash-alt p-1"></i></a>
                                </div>
                            </div>
                            </div>';
              }?> 
        </div>
        
      </div>
      </div>
    </body>
</html>