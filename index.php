<?php
    /*
    *
        index.php est le CONTRÔLEUR de notre application "MVC-lite". TOUTES les
        requêtes vers notre application vont passer par ici. Le coeur du contrôleur est sa structure décisionnelle qui traite un paramètre que l'on nommera ACTION. C'est la valeur de ce paramètre qui déterminera les actions que posera le contrôleur.
    
    */
    //initialiser la session
    session_start();

    //1. Recevoir le paramètre action
    if(isset($_REQUEST["action"]))
    {
        $action = $_REQUEST["action"];
    }
    else
    {
        //action par défaut
        $action = "Accueil";
    }

    //inclure le modèle
    require_once("fonctionsDB.php");
    //structure décisionnelle
    switch($action)
    {
        case "Accueil":
            $donnee = GetAllProjects();
            require_once("vues/Accueil.php");
            break;
        case "InscriptionPrestataire":
            require_once("vues/AjouterPrestataire.php");
            break;
        case "InscriptionEntreprise":
            require_once("vues/AjouterEntreprise.php");
            break;

        case "AjouterPrestataire":
            $msgErreur = "";
            if(isset($_POST["submit"])  &&  $_POST["submit"] == "Créer compte"){
                
                if(!isset($_POST["nom"])  ||  $_POST["nom"] == "")
                    $msgErreur = "Veuillez remplir le champ nom\n";
                if(!isset($_POST["prenom"])  ||  $_POST["prenom"] == "")
                    $msgErreur .= "Veuillez remplir le champ prenom\n";
                if(!isset($_POST["username"])  ||  $_POST["username"] == "")
                    $msgErreur .= "Veuillez remplir le champ Nom d'utilisateur\n";
                if(!isset($_POST["password1"])  ||  $_POST["password1"] == "")
                    $msgErreur .= "Veuillez remplir le champ Mot de pass\n";
                if(!isset($_POST["password2"])  ||  $_POST["password2"] == "")
                    $msgErreur .= "Veuillez confirmer le mot de pass\n";
                if(!isset($_POST["email"])  ||  $_POST["email"] == "")
                    $msgErreur .= "Veuillez remplir le champ E-mail\n";
                if(!isset($_POST["adress"])  ||  $_POST["adress"] == "")
                    $msgErreur .= "Veuillez remplir le champ adress\n";
                if(!isset($_POST["ville"])  ||  $_POST["ville"] == "")
                    $msgErreur .= "Veuillez remplir le champ ville\n";
                if(!isset($_POST["specialite"])  ||  $_POST["specialite"] == "")
                    $msgErreur .= "Veuillez remplir le champ Spécialité\n";
                if($_POST["password1"] !== $_POST["password2"]){
                    $msgErreur .= "Les deux mots de pass ne se ressemblent pas\n";
                }
                if(checkUsername($_POST["username"])){
                    $msgErreur .= "Ce nom d'utilisateur existe déjà\n";
                }
                if(checkEmail($_POST["email"])){
                    $msgErreur .= "Cette adresse email existe déjà\n";
                }
                if ($msgErreur == "") {
                    insertprestataire($_POST["nom"],$_POST["prenom"],$_POST["username"],$_POST["password1"],$_POST["email"],$_POST["adress"],$_POST["ville"],$_POST["specialite"]);
                    $msgConfirmation = "Felicitation Votre Compte À Bien Été Créé\n Connectes-toi Dès Maintenant et Commence à Postuler";
                    require_once("vues/Login.php");    
                }else{
                    require_once("vues/AjouterPrestataire.php");
                }
            }else{
                require_once("index.php");
            }

            break;

        case "AjouterEntreprise":
            $msgErreur = "";
            if(isset($_POST["submit"])  &&  $_POST["submit"] == "Créer compte"){
                
                if(!isset($_POST["nom"])  ||  $_POST["nom"] == "")
                    $msgErreur = "Veuillez remplir le champ nom\n";
                if(!isset($_POST["prenom"])  ||  $_POST["prenom"] == "")
                    $msgErreur .= "Veuillez remplir le champ prenom\n";
                if(!isset($_POST["username"])  ||  $_POST["username"] == "")
                    $msgErreur .= "Veuillez remplir le champ Nom d'utilisateur\n";
                if(!isset($_POST["password1"])  ||  $_POST["password1"] == "")
                    $msgErreur .= "Veuillez remplir le champ mot de pass\n";
                if(!isset($_POST["password2"])  ||  $_POST["password2"] == "")
                    $msgErreur .= "Veuillez remplir le champ mot de pass\n";
                if(!isset($_POST["email"])  ||  $_POST["email"] == "")
                    $msgErreur .= "Veuillez remplir le champ email\n";
                if(!isset($_POST["adress"])  ||  $_POST["adress"] == "")
                    $msgErreur .= "Veuillez remplir le champ adress\n";
                if(!isset($_POST["ville"])  ||  $_POST["ville"] == "")
                    $msgErreur .= "Veuillez remplir le champ ville\n";
                if(!isset($_POST["entreprise"])  ||  $_POST["entreprise"] == "")
                    $msgErreur .= "Veuillez remplir le champ nom d'entreprise\n";
                if($_POST["password1"] !== $_POST["password2"]){
                    $msgErreur .= "Les deux mots de pass ne se ressemblent pas\n";
                }
                if(checkUsername($_POST["username"])){
                    $msgErreur .= "Ce nom d'utilisateur existe déjà\n";
                }
                if(checkEmail($_POST["email"])){
                    $msgErreur .= "Cette adresse email existe déjà\n";
                }
                if ($msgErreur == "") {
                    insertentreprise($_POST["nom"],$_POST["prenom"],$_POST["username"],$_POST["password1"],$_POST["email"],$_POST["adress"],$_POST["ville"],$_POST["entreprise"]);
                    $msgConfirmation = "Felicitation Votre Compte À Bien Été Créé\n Connectes-toi Dès Maintenant et Commence Trouvez Des Prestataires Pour Votre Projets";
                    require_once("vues/Login.php"); 
                     
                }else{
                    require_once("vues/AjouterEntreprise.php");
                }
            }else{
                require_once("index.php");
            }

            break;

        case "Login" :
            require_once("vues/Login.php");
            break;

        case "VerifierLogin" :
            //vérifier la combinaison username/password
            if(isset($_POST["username"]) && isset($_POST["password"]))
            {
                $resultat = Authentification($_POST["username"], $_POST["password"]);
                
                if($resultat)
                {
                    $_SESSION["usager"] = $_POST["username"];
                    $TypeUtilisateur = TypeUtilisateur($_POST["username"]);
                    $_SESSION["role"] = $TypeUtilisateur ;
                    $userId = GetUserId ($_POST["username"]);
                    $_SESSION["idUsager"] = $userId;
                    $userFullName = GetUserFullName ($_POST["username"]);
                    $_SESSION["nomUsager"] = $userFullName;
                    if ($_SESSION["role"] == "entreprise") {
                        header("Location: index.php?action=MyProjects");
                    }
                    if ($_SESSION["role"] == "admin") {
                        header("Location: index.php?action=DemandesEnAttente");
                    }else{
                        header("Location: index.php?");
                    }
                   
                }
                else
                {
                    $msgErreur = "Combinaison username/password invalide.";
                    require_once("vues/Login.php");
                }
            }
            else
            {
                header("Location: index.php");
            }
            break;
        case "Logout":
            //vider le tableau $_SESSION
            $_SESSION = array();
            
            //supprimer le cookie de session
            if(isset($_COOKIE[session_name()]))
            {
                setcookie(session_name(), '', time() - 3600);
            }
            
            //détruire la session complètement
            session_destroy();
            header("Location: index.php");
            break; 
        case "AddProject":
            if(isset($_SESSION["role"]) && $_SESSION["role"] == "entreprise") {
                $donnee = Getallcategories();
                require_once("vues/AddProject.php");   
            }else{
                header("Location: index.php"); 
            }
            break;
        case "SaveProject":
            $msgErreur = "";
            if(isset($_POST["submit"])  &&  $_POST["submit"] == "Ajouter le Projet"){
                if(!isset($_POST["titre"])  ||  $_POST["titre"] == "")
                    $msgErreur = "Veuillez remplir le champ Titre\n";
                if(!isset($_POST["description"])  ||  $_POST["description"] == "")
                    $msgErreur .= "Veuillez remplir le champ Description\n";
                if(!isset($_POST["budget"])  ||  $_POST["budget"] == "")
                    $msgErreur .= "Veuillez remplir le champ Budget\n";
                if(!isset($_POST["duree"])  ||  $_POST["duree"] == "")
                    $msgErreur .= "Veuillez remplir le champ Durée\n";
                if(!isset($_POST["ville"])  ||  $_POST["ville"] == "")
                    $msgErreur .= "Veuillez remplir le champ Ville\n";
                if(!isset($_POST["categorie"])  ||  $_POST["categorie"] == "")
                    $msgErreur .= "Veuillez choisire une categorie\n";

                if ($msgErreur == "") {
                  
                    SaveProject($_POST["titre"],$_POST["description"],$_POST["budget"],$_POST["duree"],$_POST["ville"],$_POST["categorie"], $_SESSION["idUsager"]);
                    header("Location: index.php"); 
                }else{
                    
                    require_once("vues/AddProject.php");
                }
            }else{
                require_once("index.php");
            }
            break;
        case "EditProject":
            if (isset($_SESSION["idUsager"]) && isset($_GET["id"])) {
                $Permission = PermissionUpdateProject($_SESSION["idUsager"],$_GET["id"]);
                $donneeCategories = Getallcategories();
                $donnee = GetProjectById($_GET["id"]);
                if ($Permission || $_SESSION["role"]=="admin") {
                    require_once("vues/EditProject.php");
                }else{
                    header("Location: index.php"); 
                }
            }else {
                header("Location: index.php"); 
            }  
            break; 
        case "UpdateProject":
            $msgErreur = "";
            if(isset($_POST["submit"])  &&  $_POST["submit"] == "Modifier" && (PermissionUpdateProject($_SESSION["idUsager"],$_POST["ProjectId"]) || $_SESSION["role"]== "admin")){
                if(!isset($_POST["titre"])  ||  $_POST["titre"] == "")
                    $msgErreur = "Veuillez remplir le champ Titre\n";
                if(!isset($_POST["description"])  ||  $_POST["description"] == "")
                    $msgErreur .= "Veuillez remplir le champ Description\n";
                if(!isset($_POST["budget"])  ||  $_POST["budget"] == "")
                    $msgErreur .= "Veuillez remplir le champ Budget\n";
                if(!isset($_POST["duree"])  ||  $_POST["duree"] == "")
                    $msgErreur .= "Veuillez remplir le champ Durée\n";
                if(!isset($_POST["ville"])  ||  $_POST["ville"] == "")
                    $msgErreur .= "Veuillez remplir le champ Ville\n";
                if(!isset($_POST["categorie"])  ||  $_POST["categorie"] == "")
                    $msgErreur .= "Veuillez choisire une categorie\n";

                if ($msgErreur == "") {
                
                    UpdateProject($_POST["titre"],$_POST["description"],$_POST["budget"],$_POST["duree"],$_POST["ville"],$_POST["categorie"], $_POST["ProjectId"]);
                    if ($_SESSION["role"]== "admin") {
                        header("Location: index.php?action=Projects"); 
                    }else{
                        header("Location: index.php?action=MyProjects");   
                    }
                    
                    
                }else{
                    
                    require_once("vues/UpdateProject.php");
                }
            }else{
                header("Location: index.php"); 
            }
            break;
        case "Dashboard":
            require_once("vues/Dashboard.php");
            break;
        case "MyProjects":
            if(isset($_SESSION["role"]) && $_SESSION["role"] == "entreprise") {
                $donnee = GetProjectsByUserId($_SESSION["idUsager"]);
                require_once("vues/MyProjects.php");   
            }else{
                header("Location: index.php"); 
            }
            break;
        case "DeleteProject":
            if(isset($_SESSION["role"]) && $_SESSION["role"] == "entreprise" && isset($_GET["id"])) {
                $Permission = PermissionUpdateProject($_SESSION["idUsager"],$_GET["id"]);
               if ($Permission) {
                DeleteProject($_GET["id"]);
                header("Location: index.php?action=MyProjects");
               }    
            }else{
                header("Location: index.php"); 
            }
            break;
        case "Apply":
            if(isset($_SESSION["role"]) && isset($_SESSION["idUsager"]) && $_SESSION["role"] == "prestataire" && isset($_GET["idProject"])) {
                ApplyToProject($_SESSION["idUsager"],$_GET["idProject"]);
                header("Location: index.php");
            }else{
                header("Location: index.php?action=Login");
            }
            break;
        case "MyApplications":
            if(isset($_SESSION["role"]) && $_SESSION["role"] == "prestataire") {
                $donnee = GetApplicationsByUserId($_SESSION["idUsager"]);
                require_once("vues/MyApplications.php");   
            }else{
                header("Location: index.php"); 
            }
            break;
        case "Profile":
            if (isset($_GET["id"])) {
                $donnee =  GetProfileByUserId($_GET["id"]);
            }else{
                $donnee =  GetProfileByUserId($_SESSION["idUsager"]);
            }
            
            $row = mysqli_fetch_assoc($donnee);
            require_once("vues/Profile.php");
            break;
        case "EditProfile":
            if (isset($_SESSION["idUsager"]) && isset($_GET["id"])) {
                
                if ($_SESSION["idUsager"] == $_GET["id"] || $_SESSION["role"] == "admin" ) {
                    $donnee =  GetProfileByUserId($_GET["id"]);
                    $donnee  = mysqli_fetch_assoc($donnee);
                    require_once("vues/EditProfile.php");
                }else{
                    header("Location: index.php"); 
                }
            }else {
                header("Location: index.php"); 
            }  
            break;
        case "UpdateProfile" :
            $msgErreur = "";
            if(isset($_SESSION["idUsager"]) && isset($_POST["id"]) && ($_SESSION["idUsager"] == $_POST["id"] || $_SESSION["role"] == "admin" )){
                
                if(!isset($_POST["nom"])  ||  $_POST["nom"] == "")
                    $msgErreur = "Veuillez remplir le champ nom\n";
                if(!isset($_POST["prenom"])  ||  $_POST["prenom"] == "")
                    $msgErreur .= "Veuillez remplir le champ prenom\n";
                if(!isset($_POST["username"])  ||  $_POST["username"] == "")
                    $msgErreur .= "Veuillez remplir le champ Nom d'utilisateur\n";
                if(!isset($_POST["password1"])  ||  $_POST["password1"] == "")
                    $msgErreur .= "Veuillez remplir le champ mot de pass\n";
                if(!isset($_POST["password2"])  ||  $_POST["password2"] == "")
                    $msgErreur .= "Veuillez remplir le champ mot de pass\n";
                if(!isset($_POST["email"])  ||  $_POST["email"] == "")
                    $msgErreur .= "Veuillez remplir le champ email\n";
                if(!isset($_POST["adress"])  ||  $_POST["adress"] == "")
                    $msgErreur .= "Veuillez remplir le champ adress\n";
                if(!isset($_POST["ville"])  ||  $_POST["ville"] == "")
                    $msgErreur .= "Veuillez remplir le champ ville\n";
                if((!isset($_POST["entreprise"])  ||  $_POST["entreprise"] == "") && $_SESSION["role"]=="entreprise")
                    $msgErreur .= "Veuillez remplir le champ nom d'entreprise\n";
                if((!isset($_POST["specialite"])  ||  $_POST["specialite"] == "")  && $_SESSION["role"]=="prestataire")
                    $msgErreur .= "Veuillez remplir le champ specialite\n";
                if($_POST["password1"] !== $_POST["password2"]){
                    $msgErreur .= "Les deux mots de pass ne se ressemblent pas\n";
                }
                if(checkUsernameUpdate($_POST["username"],$_POST["id"])){
                    $msgErreur .= "Ce nom d'utilisateur existe déjà\n";
                }
                if(checkEmailUpdate($_POST["email"],$_POST["id"])){
                    $msgErreur .= "Cette adresse email existe déjà\n";
                }
                if ($msgErreur == "") {
                    if ($_SESSION["role"]=="admin") {
                        $userID = $_POST['id'];
                    }else{
                        $userID = $_SESSION['idUsager'];
                    }
                    if (!isset($_POST["specialite"])) {
                        $specialite = NULL;
                    }else{
                        $nom_entreprise = $_POST["specialite"];
                    }
                    if (!isset($_POST["entreprise"])) {
                        $nom_entreprise = NULL;
                    }else{
                        $nom_entreprise = $_POST["entreprise"];
                    }
                    UpdateProfile ($userID,$_POST["nom"],$_POST["prenom"],$_POST["username"],$_POST["password1"],$_POST["email"],$_POST["adress"],$_POST["ville"],$specialete,$nom_entreprise) ;                   $msgConfirmation = "mise ajours reusie";
                    $msgConfirmation = "Mise a jours de profile avec succes";
                    if ($_SESSION["role"]== "admin") {
                        header("Location: index.php?action=Profile&id=$userID");
                    }else{
                        header("Location: index.php?action=Profile");
                    }
                    
                    
                }else{
                    $donnee =  GetProfileByUserId($_POST["id"]);
                    $donnee  = mysqli_fetch_assoc($donnee);
                    require_once("vues/EditProfile.php");
                }
            }else{
                require_once("index.php");
            }

            break;
            
        case "DemandesEnAttente":
            if ($_SESSION["role"] == "admin") {
                $donnee = GetProjectsHasApplications('en attente');
                require_once("vues/AdminDemandes.php");
            }
            break;
        case "DemandesAssigne":
            if ($_SESSION["role"] == "admin") {
                $donnee = GetProjectsHasApplications('Assigné');
                require_once("vues/AdminDemandes.php");
            }
            break;
        case "AssignerProjet":
            if ($_SESSION["role"] == "admin") {
                AssignerProjet($_GET["userId"],$_GET["projectId"]);
                header("Location: index.php?action=DemandesEnAttente");
            }
            break;
        case "AnnulerAssignation":
            if ($_SESSION["role"] == "admin") {
                AnnulerAssignation($_GET["projectId"]);
                header("Location: index.php?action=DemandesAssigne");
            }
            break;

        case "UtilisateursEntreprise":
            if ($_SESSION["role"] == "admin") {
                $donnee = GetAllEntreprise();
                require_once("vues/AdminEntreprises.php");
            }
            break;
        case "UtilisateursPrestataire":
            if ($_SESSION["role"] == "admin") {
                $donnee = GetAllPrestataire();
                require_once("vues/AdminPrestataires.php");
            }
            break;
        case "Projets":
            if ($_SESSION["role"] == "admin") {
                $donnee = GetAllProjects();
                require_once("vues/AdminProjets.php");
            }
            break;
        case "SupprimerUsager":
            if ($_SESSION["role"] == "admin") {
                SupprimerUsager($_GET["id"]);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                
            }
            break;
        case "AnnulerDemande":
            if ($_SESSION["role"] == "prestataire" && CheckIfApplyed( $_SESSION["idUsager"], $_GET["projectId"])) {
                if(CheckIfAssigned($_SESSION["idUsager"],$_GET["projectId"])){
                    AnnulerDemande($_SESSION["idUsager"],$_GET["projectId"],1);
                }else{
                    AnnulerDemande($_SESSION["idUsager"],$_GET["projectId"],0);
                }
                header('Location: ' . $_SERVER['HTTP_REFERER']);

            }else{
                header("Location: index.php");

            }
            break;
        case "Recherche":
            if (isset($_POST["mots"]) && $_POST["mots"] != "") {
                $donnee = SearchInProjects($_POST["mots"]);
                if (mysqli_fetch_assoc($donnee) == NULL) {
                    $msgErreur = "Désolé, aucun résultat n'a été trouvé";
                }
                require_once("vues/Accueil.php");
            }else{
                header("Location: index.php");
            }
            break;
        

            
}

?>