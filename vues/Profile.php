<?php include 'include/headerDashboard.php';?>
        <div class="col bg-body" id="main">
          <div class="pagetitle">
                  <h2>Profile</h2>
              </div>
              <div class="container data-row p-5">
        <form action="index.php" method="post">
                <div class="row top-space">
                  <div class="col-4 offset-2">
                    <span class="blue">Nom :</span> <span class="font-weight-bold"><?php echo $row["nom"]  ?></span>
                  </div>
                </div>  
                <div class="row top-space">
                  <div class="col-4 offset-2">
                  <span class="blue">Prenom : </span> <span class="font-weight-bold"><?php echo $row["prenom"]  ?>                  
                    </div>
                </div>
                <div class="row top-space">
                  <div class="col-8 offset-2">
                  <span class="blue">Nom d'utilisateur :</span> <span class="font-weight-bold"><?php echo $row["username"]  ?> 
                  </div>
                </div>
                <div class="row top-space">
                  <div class="col-8 offset-2">
                  <span class="blue">E-mail :</span> <span class="font-weight-bold"><?php echo $row["email"]  ?> 
                  </div>
                </div>
                <div class="row top-space">
                  <div class="col-4 offset-2">
                  <span class="blue"> Adresse :</span> <span class="font-weight-bold"><?php echo $row["adresse"]  ?>
                  </div>
                </div>  
                <div class="row top-space">
                  <div class="col-4 offset-2">
                  <span class="blue">Ville :</span> <span class="font-weight-bold"><?php echo $row["ville"]  ?>
                  </div>        
                </div>
                <div class="row top-space">
                <?php 
                    if ($row["nom_entreprise"] != NULL) {
                        echo '<div class="col-4 offset-2">
                        <span class="blue">Nom d\'entreprise : </span><span class="font-weight-bold">' . $row["nom_entreprise"] . '
                        </div>';
                    }
                    if ($row["specialite"] != NULL) {
                        echo '<div class="col-4 offset-2">
                        <span class="blue">Spécialité : </span><span class="font-weight-bold">' . $row["specialite"] . '
                        </div>';
                    }

                ?>
                </div>
                 <div class="row top-space">
                  <div class="col-2 offset-8">
                  <?php  if (!isset($_GET["id"])) {
                    $ID = $_SESSION["idUsager"];
                  }else{
                    $ID = $_GET["id"];
                  }
                  ?>
                  <a class="btn btn-primary float-right" href="index.php?action=EditProfile&id=<?php echo $ID ?>" role="button">Modifier</a>
                  </div>        
                </div>
                      
                </div>
                
                
    </div>
       

    </body>
</html>