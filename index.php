<?php

/* Début de session */
session_name("PasDeGaspX");
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
    $_SESSION["loggedIn"] = false;
}

/* Appel aux fichiers regroupant les fonctions 'utilitaires : celles qui permettent une modification dynamique du site */
require ("Utilitaires/logInOutRegister.php");
require ("Utilitaires/printForms.php");
require ("Utilitaires/Erreurs.php");
require ("Utilitaires/secure.php");
require("Utilitaires/utils.php");


/* Appel aux classes qui permettent de gérer la base de données */
require ('ClassesAssocieesBDD/Database.php');
require ("ClassesAssocieesBDD/Utilisateurs.php");
require ("ClassesAssocieesBDD/RaisonsDepart.php");
require ("ClassesAssocieesBDD/Messagerie.php");
require ("ClassesAssocieesBDD/Rate.php");
require ("ClassesAssocieesBDD/Offres.php");
require ("ClassesAssocieesBDD/RateOffer.php");
require ("ClassesAssocieesBDD/AlimentsExistant.php");



/* On se connecte à la base de données */
$dbh = Database::connect();




// Code de sélection des pages
if (isset($_GET['name'])) {
    $askedPage = $_GET['name'];
} else {
    $askedPage = "Accueil";
}


//traitement des contenus de formulaires

if (isset($_GET['todo'])) {
    switch ($_GET['todo']) {        
        /* Connecte l'utilisateur  */ 
        case 'login':
            logIn($dbh);
            break;
        
        /*Déconnecte l'utilisateur courant */ 
        case 'logout': 
            logOut($dbh);
            $askedPage = "Accueil"; 
            break;
        
        /* Enregistre un nouveau membre à la communauté PasDeGaspX */
        case 'register':
            $askedPage =register($dbh);
            break;
        
        /*Permet à l'utilisateur courant de changer son mdp*/
        case 'changemdp':
            $askedPage = changeMDP($dbh);
            break;
        
        /* Permet à l'utilisateur de supprimer son compte */
        case 'deleteuser':
            $askedPage = deleteUser($dbh);
            break;
        
        /* Permet à l'utilisateur d'enregistrer son offre */ 
        case 'registeroffer':
            $askedPage = registerOffer($dbh);
            break;
        
        /* Permet à l'utilisateur courant de modifier son offre */
        case 'modifyoffer':
            $askedPage = modifyOffer($dbh);
            break;
        
        /* Permet à l'utilisateur courant de supprimer son offre */
        case 'withdrawoffer':
            $askedPage= withdrawOffer($dbh);
            break;
                
        /* Enregistrer dans la table Messagerie un message envoyé par l'utilisateur courant */
        case 'registermessage':
            $askedPage = registerMessage($dbh);
            break;
        
        /* Noter un plat, ce qui va à la fois actualiser la note du donneur et attribuer une note au plat en question dans les tables */
        case 'ratemydish':
            $askedPage = RateMyDish($dbh);
            break;
        
        /* Permet à l'utilisateur courant de se retirer d'une offre précédemment acceptée*/
        case 'withdrawacceptation':
            $askedPage = withdrawAcceptation($dbh);
            break;
        
        /* Permet à l'utilisateur courant d'accepter une offre */
        case 'accepteroffre':
            $askedPage = accepterOffre($dbh);
            break;
        
        /* Renvoie sur le contenu du nouveau message sélectionné, et le marque comme lu par la même occasion */
        case 'consult':
            $askedPage = Consult($dbh);
            break;
        
        /* Lorsque que quelqu'un consulte un nouveau message, celui-ci est automatiquement marqué comme lu. Cette fonction
        permet à l'utilisateur de marquer le message comme non-lu lorsqu'il l'a consutlé*/
        case 'markasnonread':
            $askedPage=markAsNonRead($dbh);
            break;
        
        /* Supprime un nouveau message */
        case 'deletemessage':
            $askedPage=deleteMessage($dbh);
            break;
        
        case 'checkadmin':
            $askedPage= logInAdmin($dbh);
            break;
        
        /* Envoie un message à l'administrateur pour le signaler d'un problème sur une offre */
        case 'registermessageSignalementOffre':
            $askedPage= RegistermMessageSignalementOffre($dbh);
            break;
        
        /* Envoie un message à l'administrateur pour le signaler d'un problème sur un utilisateur */
        case 'registermessageSignalementUtilisateur' :
            $askedPage= RegistermMessageSignalementUtilisateur($dbh);
            break;
        
    }
}






/* authorized est true si la page demandée est accessible */
$authorized = checkPage($askedPage);
/* pageTitle contient le titre de la page qui apparaîtra en haut de page. pageMenuTitle contient le "title" présent dans le header */
if ($authorized) {
    $pageTitle = getPageTitle($askedPage);
    $pageMenuTitle = getPageMenuTitle($askedPage);
} else {
    $pageTitle = 'Erreur';
    $pageMenuTitle = 'Accueil';
}


/* Génération du Header */
generateHeader($pageMenuTitle, "css/swagg.css");





// affichage du formulaire de connexion + de la barre de navigation


generateMenu ($pageTitle);



/* Si l'utilisateur n'est pas logé, on lui propose de se connecter */
if ($_SESSION["loggedIn"] == false){
    /* Si on est sur la page d'inscription ou les conditions d'utilisation, on ne display pas le formulaire. */
    if (!isset($_GET['name']) || ($_GET['name'] != "PageInscription" && $_GET['name'] != "ConditionsUtilisation")) {
         printLoginForm($askedPage); 
    }
}




/* Variable de session 'erreur' qui, par l'intermédiaire de printErreur() renvoie une erreur lorsque l'utilisateur remplit mal les formulaires */

if (isset($_SESSION['erreur'])) {
    printErreur();
}
/* La page demandée n'est ouverte que si elle fait parties des pages possibles! */
if ($authorized) {
    
    /* Connecté, celles-ci sont toutes accessibles à l'utilisateur */
    if($_SESSION["loggedIn"]){
        
        require ("ContenuDesPages/" . $askedPage . ".php");

    }
    
    
    else{
        /* Non connecté, à part quelques pages, l'utilisateur n'a pas accès au site */
        if(checkPageSiNonConnecte($askedPage)){
            require ("ContenuDesPages/" . $askedPage . ".php");
        }
        else{
            
            require("ContenuDesPages/PageSiNonConnectee.php");
            
        }
        
    }
    
}

    


/* Sinon, erreur 404 */ 
else {
    require ("ContenuDesPages/PageNonAuthorized.php");
}



/* On se déconnecte de la base de données */

$dbh = null;


/* On finit avec le footer de la page */
generateFooter();
?>