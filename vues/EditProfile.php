<?php include 'include/headerDashboard.php';?>
<div class="col bg-body" id="main">
    <div class="pagetitle">
            <h2>Modifier le profile</h2>
        </div>
        <p class="confirmation"> <?= isset($msgConfirmation) ? nl2br($msgConfirmation) : "" ?> </p>
    <div class="container">
        <form action="index.php" method="post">
                <div class="row top-space">
                  <div class="col-4 offset-2">
                    <label>Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?php echo isset($_POST['nom']) ? trim($_POST['nom']) : $donnee['nom'] ?>" >
                  </div>
                  <div class="col-4">
                    <label>Prénom</label>
                    <input type="text" class="form-control" name="prenom" value="<?php echo $donnee['prenom']?>" >
                  </div>
                </div>
                <div class="row top-space">
                  <div class="col-8 offset-2">
                    <label>Nom d'utilisateur</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $donnee['username']?>" >
                  </div>
                </div>
                <div class="row top-space">
                  <div class="col-4 offset-2">
                    <label>Mot de pass</label>
                    <input type="password" class="form-control"  name="password1">
                  </div>
                  <div class="col-4">
                    <label>Mot de pass</label>
                    <input type="password" class="form-control" name="password2">
                  </div>        
                </div>
                <div class="row top-space">
                  <div class="col-8 offset-2">
                    <label>E-mail</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $donnee['email']?>" >
                  </div>
                </div>
                <div class="row top-space">
                  <div class="col-4 offset-2">
                    <label>Adresse</label>
                    <input type="text" class="form-control"  name="adress" value="<?php echo $donnee['adresse']?>" >
                  </div>
                  <div class="col-4">
                    <label>Ville</label>
                    <input type="text" class="form-control" name="ville" value="<?php echo $donnee['ville']?>" >
                  </div>        
                </div>
                <?php 
                    if (isset($_GET["id"])) {
                      $ID = $_GET["id"];
                    }
                    if (isset($_POST["id"])) {
                      $ID = $_POST["id"];
                    }
                    if ($_SESSION['role']== 'entreprise' ||  TypeUtilisateurParId($ID) == 'entreprise') {
                        echo '<div class="row top-space">
                        <div class="col-8 offset-2">
                          <label>Nom d\'Entreprise</label>
                          <input type="text" class="form-control" name="entreprise" value="' . $donnee['nom_entreprise'] .'" >
                        </div>
                      </div>';
                    }
                    if ($_SESSION['role']== 'prestataire' ||  TypeUtilisateurParId($ID) == 'prestataire' ){
                        echo '<div class="row top-space">
                        <div class="col-8 offset-2">
                          <label>Spécialité </label>
                          <input type="text" class="form-control" name="specialite" value="' . $donnee['specialite'] .'" >
                        </div>
                      </div>';
                    }

                ?>

                
                <div class="row top-space">
                    <div class="col-2 offset-8">
                        <input type="hidden" name="action" value='UpdateProfile'/>
                        <input type="hidden" name="id" value='<?php echo $ID; ?>'/>
                        <input class="btn btn-primary float-right" type="submit" name="submit" value="Modifier">  
                </div>
                </div>
              </form>
              <p class="erreur"> <?= isset($msgErreur) ? nl2br($msgErreur) : "" ?> </p>
    </div>
       

    </body>
</html>