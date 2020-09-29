<?php include 'include/headerDashboard.php';?>
    <body>
        <div class="col bg-body" id="main">
          <div class="pagetitle">
            <h2>Mes Demandes</h2>
          </div>
          <div class="row col-11 offset-1 data-head p-3 m-3">
            <div class="col-4">
              <span>Titre du projet</span>
            </div>
            <div class="col">
              <span>Budget</span>
            </div>
            <div class="col">
              <span>Nom d'entreprise</span>
            </div>
            <div class="col">
              <span>Etat</span>
            </div>
            <div class="col">
              <span>Action</span>
            </div>
          </div>

               <?php while ($row = mysqli_fetch_assoc($donnee)) {
                    echo '<div class="row col-11 offset-1 data-row p-4 m-3">
                              <div class="col-4">
                                <span>' . $row["titre"] . '</span>
                              </div>
                              <div class="col">
                                <span>' . $row["budget"] . '</span>
                              </div>
                              <div class="col">
                                <span>' . GetCompanyNameByProjectId($row["id"]) . '</span>
                              </div>
                              <div class="col">
                                <span>' . $row["etat"] . '</span>
                              </div>
                              <div class="col">
                              <a class="annuler" data-toggle="tooltip" title="Annuler la Demande" onclick="return confirm(\'Voulez vous vraiment Anuuler ? Cette action est irréversible !\')" href="index.php?action=AnnulerDemande&projectId='.$row["id"].'"><i class="fas fa-window-close"></i></a>                              
                               </div>
                            </div>';
              }?> 
        </div>
        
      </div>
      </div>
    </body>
</html>