<?php
    /*
        FonctionsDB.php est le fichier qui représente notre MODÈLE dans notre architecture MVC-lite. C'est donc dnas ce fichier que nous retrouverons TOUTES les requêtes SQL SANS AUCUNE EXCEPTION. C'est aussi ici que nous retoruverons la connexion à la base de données et les informations nécessaires à celle-ci (hostname, username, password, base de données, etc.)  
    
    */

    function connectDB()
    {
        $c = mysqli_connect("localhost", "root", "", "freelancer");
        
        if(!$c)
            trigger_error("Erreur de connexion... " . mysqli_connect_error());
        
        mysqli_query($c, "SET NAMES 'utf8'");
        return $c;
    }

    $connexion = connectDB();

    function insertprestataire($nom,$prenom,$username,$password,$email,$adress,$ville,$specialite)
    {
        global $connexion;
        $password = password_hash($password, PASSWORD_DEFAULT);
        $requete = "INSERT INTO Utilisateurs (nom, prenom, username, password, email, adresse, ville, specialite, role, etat_compte	)
        VALUES ('$nom', '$prenom', '$username','$password', '$email', '$adress','$ville', '$specialite','prestataire','active');";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function insertentreprise($nom,$prenom,$username,$password,$email,$adresse,$ville,$nom_entreprise)
    {
        global $connexion;
        $password = password_hash($password, PASSWORD_DEFAULT);
        $requete = "INSERT INTO Utilisateurs (nom, prenom, username, password, email, adresse, ville, nom_entreprise, role, etat_compte)
        VALUES ('$nom', '$prenom', '$username','$password', '$email', '$adresse','$ville', '$nom_entreprise','entreprise','active');";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function checkUsername($username)
    {
        global $connexion;
        
        $requete = "SELECT * FROM utilisateurs WHERE username = '$username'";
        $resultat = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_assoc($resultat);
        if ($resultat) {
            return true;
        }else{
            return false;
        }
    }

    function checkUsernameUpdate($username,$userId)
    {
        global $connexion;
        
        $requete = "SELECT * FROM utilisateurs WHERE username = '$username' AND id != '$userId'";
        $resultat = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_assoc($resultat);
        if ($resultat) {
            return true;
        }else{
            return false;
        }
    }

    function checkEmail($email)
    {
        global $connexion;
        
        $requete = "SELECT * FROM utilisateurs WHERE email = '$email'";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);
        if ($row) {
            return true;
        }else{
            return false;
        }
    }

    function checkEmailUpdate($email,$userId)
    {
        global $connexion;
        
        $requete = "SELECT * FROM utilisateurs WHERE email = '$email' AND id != '$userId'";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);
        if ($row) {
            return true;
        }else{
            return false;
        }
    }

    function Authentification($user, $pass)
    {
        global $connexion;
        
        $requete = "SELECT password FROM utilisateurs WHERE username = '" . filtre($user) . "'";
    
        $resultat = mysqli_query($connexion, $requete);
    
        if($rangee = mysqli_fetch_assoc($resultat))
        {
            if(password_verify($pass, $rangee["password"]))                
                return true;
            else
                return false;
        }
        else
            return false;
    }

    function TypeUtilisateur ($username)
    {
        global $connexion;

        $requete = "SELECT role FROM Utilisateurs WHERE username ='$username';";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);

        return $row["role"];
    }

    function TypeUtilisateurParId ($userid)
    {
        global $connexion;

        $requete = "SELECT role FROM Utilisateurs WHERE id ='$userid';";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);

        return $row["role"];
    }

    function GetUserId ($username)
    {
        global $connexion;

        $requete = "SELECT id FROM Utilisateurs WHERE username ='$username';";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);

        return $row["id"];
    }

    function GetUserFullName ($username)
    {
        global $connexion;

        $requete = "SELECT CONCAT(nom,' ',prenom) as fullname FROM Utilisateurs WHERE username ='$username';";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);

        return $row["fullname"];
    }

    function filtre($var)
    {
        global $connexion;
        
        $varFiltre = mysqli_real_escape_string($connexion, $var);
        //appliquer d'autres filtres
        //se prémunir contre les attaques de type XSS (cross-site scripting)
        $varFiltre = strip_tags($varFiltre, "<a><b><em>");
        
        return $varFiltre;
    }

    function SaveProject($titre,$description,$budget,$duree,$ville,$categorie,$userid)
    {
        global $connexion;
        
        $requete = "INSERT INTO projets (titre, description, budget, duree, ville,idCategories,idUtilisateurs)
        VALUES ('" . filtre($titre) . "', '" . filtre($description) . "', '" . filtre($budget) . "','" . filtre($duree) . "', '" . filtre($ville) . "','" . filtre($categorie) . "','" . filtre($userid) . "');";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function Getallcategories(){
        global $connexion;
        
        $requete = "SELECT * FROM  categories";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function GetProjectById($id){
        global $connexion;
        
        $requete = "SELECT * FROM  projets WHERE id = '$id'";
        $resultat = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_assoc($resultat);
        
        return $resultat;
    }

    function UpdateProject($titre,$description,$budget,$duree,$ville,$categorie,$projectId)
    {
        global $connexion;
        
        $requete = "UPDATE `projets` SET `titre`='" . filtre($titre) . "',`description`='" . filtre($description) . "',`budget`='" . filtre($budget) . "',`duree`='" . filtre($duree) . "',`ville`='" . filtre($ville) . "',`idCategories`='" . filtre($categorie) . "' WHERE `id`='" . filtre($projectId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function PermissionUpdateProject($userid,$projectId)
    {
        global $connexion;
        
        $requete = "SELECT * FROM  projets WHERE id = '" . filtre($projectId) . "' AND idUtilisateurs = '" . filtre($userid) . "'";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);
        if ($row) {
            return true;
        }else{
            return false;
        }
    }

    function GetProjectsByUserId($userId)
    {
        global $connexion;
        
        $requete = "SELECT *, projets.id as idProjet FROM `projets` JOIN `categories` ON idCategories = categories.id 
        WHERE idUtilisateurs = '" . filtre($userId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function DeleteProject($projectId)
    {
        global $connexion;
        
        $requete = "DELETE FROM projets  
        WHERE id = '" . filtre($projectId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function GetAllProjects()
    {
        global $connexion;
        
        $requete = "SELECT *,projets.id as idProjet FROM  projets JOIN utilisateurs ON idUtilisateurs = utilisateurs.id ORDER BY idProjet";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function GetCategoryNaneByProjectId($projectId)
    {
        global $connexion;
        
        $requete = "SELECT categories.nom AS CATNAME FROM `projets` 
        JOIN categories 
        on idCategories = categories.id
        WHERE projets.id = '" . filtre($projectId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);

        return $row["CATNAME"];
    }

    function ApplyToProject($userId, $projectId)
    {
        global $connexion;
        
        $requete = "INSERT INTO projets_prestataire (idPrestataire, idProjet)
        VALUES ('" . filtre($userId) . "', '" . filtre($projectId) . "');";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function CheckIfApplyed($userId, $projectId)
    {
        global $connexion;
        
        $requete = "SELECT * FROM  projets_prestataire WHERE idPrestataire = '" . filtre($userId) . "' AND idProjet = '" . filtre($projectId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);
        if ($row) {
            return true;
        }else{
            return false;
        }
    }

    function GetAssignedPrestataireName($projectId)
    {
        global $connexion;
        
        $requete = "SELECT CONCAT(nom,' ',prenom) as nomPrestataire,etat FROM projets_prestataire JOIN utilisateurs ON idPrestataire = utilisateurs.id  WHERE idProjet = '" . filtre($projectId) . "' AND etat ='Assigné'";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);

        return $row["nomPrestataire"];
    }

    function GetApplicationsByUserId($userId)
    {
        global $connexion;
        
        $requete = "SELECT * FROM  projets JOIN projets_prestataire ON projets.id = idProjet WHERE idPrestataire = '" . filtre($userId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;

    }

    function GetCompanyNameByProjectId($projectId)
    {
        global $connexion;
        
        $requete = "SELECT DISTINCT  nom_entreprise FROM utilisateurs JOIN projets ON idUtilisateurs = utilisateurs.id WHERE projets.id = '" . filtre($projectId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);

        return $row["nom_entreprise"];

    }

    function GetProfileByUserId($userId)
    {
        global $connexion;
        
        $requete = "SELECT * FROM  Utilisateurs  WHERE id = '" . filtre($userId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function GetProjectsHasApplications($etat)
    {
        global $connexion;
        
        $requete = "SELECT * FROM  projets JOIN projets_prestataire  ON projets.id = idProjet WHERE etat = '" . filtre($etat) . "' GROUP BY idProjet";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function CountProjectsHasApplications($etat)
    {
        global $connexion;
        
        $requete = "SELECT  COUNT(DISTINCT(idProjet)) as QTE FROM  projets JOIN projets_prestataire  ON projets.id = idProjet WHERE etat = '" . filtre($etat) . "'";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);

        return $row["QTE"];
        
    }

    function GetApplicationsByProjectId($projectId)
    {
        global $connexion;
        
        $requete = "SELECT utilisateurs.id,nom,prenom,username,specialite,utilisateurs.ville,idProjet,etat 
        FROM  Utilisateurs 
        JOIN projets_prestataire  
        ON   Utilisateurs.id = idPrestataire 
        JOIN projets
        On projets.id = idProjet
        WHERE idProjet ='" . filtre($projectId) . "'
        ORDER BY etat ASC";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function AssignerProjet($userId,$projectId)
    {
        global $connexion;
        
        $requete = "UPDATE `projets_prestataire` SET `etat`='Non Assigné ' WHERE idProjet ='" . filtre($projectId) . "'";
        $resultat = mysqli_query($connexion, $requete);

        $requete = "UPDATE `projets_prestataire` SET `etat`='Assigné' WHERE idProjet ='" . filtre($projectId) . "' AND idPrestataire ='" . filtre($userId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function AnnulerAssignation($projectId)
    {
        global $connexion;
        
        $requete = "UPDATE `projets_prestataire` SET `etat`='en attente' WHERE idProjet ='" . filtre($projectId) . "' ";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function CheckIfAssigned($userId, $projectId)
    {
        global $connexion;
        
        $requete = "SELECT * FROM  projets_prestataire WHERE idPrestataire = '" . filtre($userId) . "' AND idProjet = '" . filtre($projectId) . "' AND etat = 'assigné'";
        $resultat = mysqli_query($connexion, $requete);
        $row = mysqli_fetch_assoc($resultat);
        if ($row) {
            return true;
        }else{
            return false;
        }
    }

    function GetAllEntreprise()
    {
        global $connexion;
        
        $requete = "SELECT * FROM  utilisateurs WHERE role= 'entreprise'";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;

    }

    function GetAllPrestataire()
    {
        global $connexion;
        
        $requete = "SELECT * FROM  utilisateurs WHERE role= 'prestataire'";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;

    }



    function SupprimerUsager($userId)
    {
        global $connexion;
        
        $requete = "DELETE FROM Utilisateurs  
        WHERE id = '" . filtre($userId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function UpdateProfile($id,$nom,$prenom,$username,$password,$email,$adresse,$ville,$specialete,$nom_entreprise)
    {
        global $connexion;
        $password = password_hash($password, PASSWORD_DEFAULT);
        $requete = "UPDATE `Utilisateurs` SET `nom`='" . filtre($nom) . "',`prenom`='" . filtre($prenom) . "',`username`='" . filtre($username) . "',`password`='" . filtre($password) . "',`email`='" . filtre($email) . "',`adresse`='" . filtre($adresse) . "' ,`ville`='" . filtre($ville) . "',`specialite`='" . filtre($specialite) . "',`nom_entreprise`='" . filtre($nom_entreprise) . "' WHERE `id`='" . filtre($id) . "'";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }

    function AnnulerDemande($userId,$projectId,$assigne)
    {
        global $connexion;
        $requete = "DELETE FROM projets_prestataire WHERE idProjet = '" . filtre($projectId) . "' AND idPrestataire = '" . filtre($userId) . "'";
        $resultat = mysqli_query($connexion, $requete);
        if ($assigne) {
            $requete = "UPDATE `projets_prestataire` SET `etat`='en attente' WHERE idProjet ='" . filtre($projectId) . "' ";
            $resultat = mysqli_query($connexion, $requete);
        }
        return $resultat;
    }

    function SearchInProjects($mots)
    {
        global $connexion;
        
        $requete = "SELECT *,projets.id as idProjet FROM  projets JOIN utilisateurs ON idUtilisateurs = utilisateurs.id  WHERE titre LIKE '%" . filtre($mots) . "%';";
        $resultat = mysqli_query($connexion, $requete);
        
        return $resultat;
    }
?>                                      