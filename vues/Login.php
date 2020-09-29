<?php include 'include/header.php';?>
    <body>
        <div class="pagetitle">
                <h2>Se connecter</h2>
            </div>
            <div class="container">
            <p class="confirmation"> <?= isset($msgConfirmation) ? nl2br($msgConfirmation) : "" ?> </p>

                <form method="post">
                    <div class="row top-space">
                        <div class="col-4 offset-4">
                            <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="username" value="<?php echo isset($_POST['username']) ? trim($_POST['username']) : "" ?>" >
                        </div>
                    </div>
                    <div class="row top-space">
                        <div class="col-4 offset-4">
                            <input type="password" class="form-control" placeholder="Mot de pass" name="password">
                        </div>
                    </div>
                    <div class="row top-space">
                        <div class="col-4 offset-4">
                            <input type="hidden" name="action" value="VerifierLogin"/>
                            <input type="submit" value="Se connecter" class="btn btn-primary btn-block"/>                     </div>
                        </div>
                </form>
                <p class="erreur"> <?= isset($msgErreur) ? nl2br($msgErreur) : "" ?> </p>
        </div>
    </body>
</html>