<?php include 'include/headerDashboard.php';?>
        <div class="col bg-body" id="main">
          <div class="pagetitle">
                  <h2>Ajouter un Projet</h2>
              </div>
          <div class="container col-6">
              <form action="index.php" method="post">
                      <div class="row top-space">
                        <div class="col">
                          <label>Titre</label>
                          <input type="text" class="form-control" name="titre" value="<?php echo isset($_POST['titre']) ? trim($_POST['titre']) : "" ?>" >
                        </div>
                      </div>
                      <div class="row top-space">
                        <div class="col">
                          <label>Description</label>
                          <textarea  class="form-control"  rows="10" name="description" value="<?php echo isset($_POST['description']) ? trim($_POST['description']) : "" ?>" ></textarea>
                        </div>
                      </div>
                      <div class="row top-space">
                        <div class="col-6">
                          <label>Budget</label>
                          <input type="text" class="form-control" name="budget">
                        </div>
                        <div class="col-6">
                          <label>Durée</label>
                          <input type="text" class="form-control" name="duree">
                        </div>        
                      </div>
                      <div class="row top-space">
                        <div class="col-6">
                          <label>Ville</label>
                          <input type="text" class="form-control" name="ville">
                        </div>
                        <div class="col-6">
                          <label>Catégorie</label>
                          <select class="form-control" name="categorie">
                            <option selected="true" disabled="disabled">Categorie</option>
                              <?php while ($row = mysqli_fetch_assoc($donnee)) {
                                echo '<option value="' . $row["id"] . '">' . $row["nom"] . '</option>';
                              }?>
                          </select>
                        </div> 
                      </div>
                      <div class="row top-space">
                          <div class="col-2 offset-10">
                              <input type="hidden" name="action" value='SaveProject'/>
                              <input class="btn btn-primary float-right" type="submit" name="submit" value="Ajouter le Projet">  
                      </div>
                    </form>
                    <p class="erreur"> <?= isset($msgErreur) ? nl2br($msgErreur) : "" ?> </p>
                      </div>
          </div>
          
            
        </div>
      </div>
      </div>
    </body>
</html>