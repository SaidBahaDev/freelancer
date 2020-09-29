<?php include 'include/headerDashboard.php';?>
    <body>
        <div class="col bg-body" id="main">
          <div class="pagetitle">
            <h2>Gestion des Prestataires</h2>
          </div>
          <div class="row col-11 offset-1 data-head p-3 m-3">
          <div class="col-1">
            <span>ID</span>
            </div>
            <div class="col-3">
            <span>Nom & prenom</span>
            </div>
            <div class="col-2">
            <span>Nom d'utilisateur</span>
            </div>
            <div class="col-2">
            <span>Spécialité</span>
            </div>
            <div class="col-2">
            <span>Ville</span>
            </div>
            <div class="col-2">
            <div class="text-center">Actions</div>
            </div>
          </div>

               <?php while ($row = mysqli_fetch_assoc($donnee)) {
                    echo '<div class="row col-11 offset-1 data-row p-4 m-3">
                            <div class="col-1">
                            <span>'. $row["id"] .'</span>
                            </div>
                            <div class="col-3">
                            <span>'. $row["nom"] . " " . $row["prenom"] .'</span>
                            </div>
                            <div class="col-2">
                            <span>'. $row["username"] .'</span>
                            </div>
                            <div class="col-2">
                            <span>'. $row["specialite"] .'</span>
                            </div>
                            <div class="col-2">
                            <span>'. $row["ville"] . '</span>
                            </div>
                            <div class="col-2 class="text-center"">
                                <div class="text-center">
                                    <a data-toggle="tooltip" title="Profile" href="index.php?action=Profile&id='. $row["id"] .'"><i class="far fa-eye p-1"></i></a>
                                    <a data-toggle="tooltip" title="Modifier" href="index.php?action=EditProfile&id='. $row["id"] . '"><i class="far fa-edit p-1"></i></a>
                                    <a data-toggle="tooltip" title="Supprimer" onclick="return confirm(\'Voulez vous vraiment supprimer ? Cette action est irréversible !\')" href="index.php?action=SupprimerUsager&id='. $row["id"] .'"><i class="far fa-trash-alt p-1"></i></a>
                                </div>
                            </div>
                            </div>';
              }?> 
        </div>
        
      </div>
      </div>
    </body>
</html>