<?php include 'include/headerDashboard.php';?>
    <body>
        <div class="col bg-body" id="main">
          <div class="pagetitle">
            <h2>Mes Projets</h2>
          </div>
          <div class="row col-11 offset-1 data-head p-3 m-3">
            <div class="col-6">
              <span>Titre du projet</span>
            </div>
            <div class="col">
              <span>Categorie</span>
            </div>
            <div class="col">
              <span>Prestataire</span>
            </div>
            <div class="col">
              <span>Actions</span>
            </div>
          </div>

               <?php while ($row = mysqli_fetch_assoc($donnee)) {
                $nomPrestataire = GetAssignedPrestataireName($row["idProjet"]);
                    echo '<div class="row col-11 offset-1 data-row p-4 m-3">
                              <div class="col-6">
                                <span>' . $row["titre"] . '</span>
                              </div>
                              <div class="col">
                                <span>' . $row["nom"] . '</span>
                              </div>
                              <div class="col">
                                <span>'.((GetAssignedPrestataireName($row["idProjet"]))? $nomPrestataire :"en attente").'</span>
                              </div>
                              <div class="col">
                                <a data-toggle="tooltip" title="Modifier" href="index.php?action=EditProject&id=' . $row["idProjet"] . '"><i class="far fa-edit p-1"></i></a>
                                <a data-toggle="tooltip" title="Supprimer" onclick="return confirm(\'Voulez vous vraiment supprimer ? Cette action est irréversible !\')" href="index.php?action=DeleteProject&id=' . $row["idProjet"] . '"><i class="far fa-trash-alt p-1"></i></a>
                              </div>
                            </div>';
              }?> 
        </div>
        
      </div>
      </div>
    </body>
</html>