<?php include 'include/headerDashboard.php';?>
    <body>
        <div class="col bg-body" id="main">
          <div class="pagetitle">
            <h2>Les Demandes</h2>
          </div>
          <div class="row col-11 offset-1 data-head p-3 m-3">
            <div class="col-1">
              <span>ID</span>
            </div>
            <div class="col-5">
              <span>Titre du projet</span>
            </div>
            <div class="col">
              <span>Budget</span>
            </div>
            <div class="col">
              <span>Nom d'entreprise</span>
            </div>
            <div class="col">
              <span>Demandes</span>
            </div>
          </div>

               <?php while ($row = mysqli_fetch_assoc($donnee)) {
                    echo '<div class="row col-11 offset-1 data-row p-4 m-3">
                            <div class="col-12">   
                              <div class="row">
                                <div class="col-1">
                                  <span>' . $row["id"] . '</span>
                                </div>
                                <div class="col-5">
                                  <span>' . $row["titre"] . '</span>
                                </div>
                                <div class="col">
                                  <span>' . $row["budget"] . '</span>
                                </div>
                                <div class="col">
                                  <span>' . GetCompanyNameByProjectId($row["id"]) . '</span>
                                </div>
                                <div class="col">
                                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo'. $row["id"] .'">Demandes</button>
                                </div>
                                </div>
                            </div>
                            
                            <div class="col-12 collapse bg-body mt-4 rounded" id="demo'. $row["id"] .'"> 
                              
                              <div class="row">
                                <div class="col-12 ">   
                                 <div class="row grey2">

                                 <div class="row col-12 pl-3 pr-3 pt-2 pb-2">
                                  <div class="col-1">
                                    <span>ID</span>
                                  </div>
                                  <div class="col-3">
                                    <span>Nom de Prestataire</span>
                                  </div>
                                  <div class="col-2">
                                    <span>Specialite</span>
                                  </div>
                                  <div class="col-2">
                                    <span>Ville</span>
                                  </div>
                                  <div class="col-2">
                                    <span>Etat</span>
                                  </div>
                                  <div class="col-2">
                                    <div class="text-center">Action</div>
                                  </div>
                                </div>

                                 </div>
                                </div>
                                    <hr>  
                                <div class="col-12 ">   
                                  <div class="row">';
                                    $donneeApplication = GetApplicationsByProjectId($row["id"]);
                                    while ($row2 = mysqli_fetch_assoc($donneeApplication)) {
                                        echo '<div class="row col-12 p-3 ">
                                        <div class="col-1">
                                          <span>' .$row2["id"].'</span>
                                        </div>
                                        <div class="col-3">
                                          <span>' .$row2["nom"]." " .$row2["prenom"].'</span>
                                        </div>
                                        <div class="col-2">
                                          <span>' .$row2["specialite"]. '</span>
                                        </div>
                                        <div class="col-2">
                                          <span>' .$row2["ville"]. '</span>
                                        </div>
                                        <div class="col-2">
                                          <span>' .$row2["etat"]. '</span>
                                        </div>
                                        <div class="col-2">
                                          <div class="text-center">'
                                          
                                          .(CheckIfAssigned($row2["id"], $row["id"]) ? '<a class="annuler" data-toggle="tooltip" title="Annuler l\'Assignation" href="index.php?action=AnnulerAssignation&projectId='.$row["id"].'"><i class="fas fa-window-close"></i></a>' : '<a class="assigner" data-toggle="tooltip" title="Assigner" href="index.php?action=AssignerProjet&userId='.$row2["id"].'&projectId='.$row["id"].'" ><i class="fas fa-check-square"></i></a>') .

                                          
                                          '</div>
                                        </div>
                                      </div>';
                                    }

                            echo '</div>
                                </div>
                              </div>
                            </div>
                          </div>';
              }?> 
        </div>
        
      </div>
      </div>
    </body>
</html>