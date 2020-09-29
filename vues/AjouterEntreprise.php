<?php include 'include/header.php';?>
    <body>
    <div class="pagetitle">
            <h2>inscription entreeprise</h2>
        </div>
    <div class="container">
        <form action="index.php" method="post">
                <div class="row top-space">
                  <div class="col-4 offset-2">
                    <label>Nom</label>
                    <input type="text" class="form-control"  name="nom" value="<?php echo isset($_POST['nom']) ? trim($_POST['nom']) : "" ?>" >
                  </div>
                  <div class="col-4">
                    <label>Prénom</label>
                    <input type="text" class="form-control"  name="prenom" value="<?php echo isset($_POST['prenom']) ? trim($_POST['prenom']) : "" ?>" >
                  </div>
                </div>
                <div class="row top-space">
                  <div class="col-8 offset-2">
                    <label>Nom d'utilisateur</label>
                    <input type="text" class="form-control"  name="username" value="<?php echo isset($_POST['username']) ? trim($_POST['username']) : "" ?>" >
                  </div>
                </div>
                <div class="row top-space">
                  <div class="col-4 offset-2">
                    <label>Mot de pass</label>
                    <input type="password" class="form-control"  name="password1">
                  </div>
                  <div class="col-4">
                    <label>Mot de pass</label>
                    <input type="password" class="form-control"  name="password2">
                  </div>        
                </div>
                <div class="row top-space">
                  <div class="col-8 offset-2">
                    <label>E-mail</label>
                    <input type="text" class="form-control"  name="email" value="<?php echo isset($_POST['email']) ? trim($_POST['email']) : "" ?>" >
                  </div>
                </div>
                <div class="row top-space">
                  <div class="col-5 offset-2">
                    <label>Adresse</label>
                    <input type="text" class="form-control"  name="adress" value="<?php echo isset($_POST['adress']) ? trim($_POST['adress']) : "" ?>" >
                  </div>
                  <div class="col-3">
                    <label>Ville</label>
                    <input type="text" class="form-control"  name="ville" value="<?php echo isset($_POST['nom']) ? trim($_POST['nom']) : "" ?>" >
                  </div>        
                </div>
                <div class="row top-space">
                  <div class="col-8 offset-2">
                    <label>Nom d'Entreprise</label>
                    <input type="text" class="form-control"  name="entreprise" value="<?php echo isset($_POST['entreprise']) ? trim($_POST['entreprise']) : "" ?>" >
                  </div>
                </div>
                <div class="row top-space">
                    <div class="col-2 offset-8">
                        <input type="hidden" name="action" value='AjouterEntreprise'/>
                        <input class="btn btn-primary float-right" type="submit" name="submit" value="Créer compte">  
                </div>
                </div>
              </form>
              <p class="erreur"> <?= isset($msgErreur) ? nl2br($msgErreur) : "" ?> </p>
    </div>
       

    </body>
</html>