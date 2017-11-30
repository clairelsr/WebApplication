<?php
    /* Modifications sur le bouton déroulant Mon Profil apparaissant uniquement si l'utilisateur est connecté */
    /* Liste les pages accessibles pour l'utilisateur */
    $page_list = array(
        array(
            "name" => "Accueil",
            "title" => "PasDeGaspX",
            "menutitle" => "Accueil"),
        array(
            "name" => "Offrir",
            "title" => "Faîtes une offre!",
            "menutitle" => "Enregistrez votre offre"),
        array(
            "name" => "PageInscription",
            "title" => "Ne perdez plus de temps, inscrivez-vous!",
            "menutitle" => "S'inscrire"),
        array(
            "name" => "NotreAction",
            "title" => "L'action PasDeGaspX",
            "menutitle" => "Descriptif action"),        
        array(
            "name" => "ApresAvoirOffertAvecSucces",
            "title" => "Merci pour votre don",
            "menutitle" => "offre enregistrée"),
        array(
            "name" => "ApresSEtreInscritAvecSucces",
            "title" => "Vous êtes désormais inscrit!",
            "menutitle" => "Membre enregistré"),
        array(
            "name" => "ListeOffres",
            "title" => "La Carte PasDeGaspX",
            "menutitle" => "La liste des Offres"),
        array(
            "name" => "MonProfilAccueil",
            "title" => "Votre Profil",
            "menutitle" => "Profil"),
        array(
            "name" => "MonProfilMessagerie",
            "title" => "Vos messages",
            "menutitle" => "Messages"),
        array(
            "name" => "MonProfilInformationsPersonnelles",
            "title" => "Récapitulatif de vos informations",
            "menutitle" => "Vos Informations"),
        array(
            "name" => "MonProfilChangePassword",
            "title" => "Changez votre mot de Passe",
            "menutitle" => "Modification mdp"),
        array(
            "name" => "ApresModificationMDPAvecSucces",
            "title" => "Mot de passe mis à jour",
            "menutitle" => "Modification mdp"), 
        array(
            "name" => "MonProfilDeleteUser",
            "title" => "Supprimer son compte",
            "menutitle" => "Supprimer son compte"),
        array(
            "name" => "ApresDesinscriptionAvecSucces",
            "title" => "Vous ne faites malheureusement plus partie de la communauté PasdeGaspX",
            "menutitle" => "Vous ne faites malheureusement plus partie de la communauté PasdeGaspX"),
        array(
            "name" => "ApresDesinscriptionEchec",
            "title" => "Votre compte n'a pas été supprimé",
            "menutitle" => "Votre compte n'a pas été supprimé",
        ),
        array(
            "name" => "ConditionsUtilisation",
            "title" => "Les conditions d'utilisation du site PasdeGaspX",
            "menutitle" => "Conditions",
        ),
        array(
            "name" => "ProfilUtilisateur",
            "title" => "Profil Utilisateur",
            "menutitle" => "Profil",
        ),        
        array(
            "name" => "OffreSelectionne",
            "title" => "Cette offre vous intéresse?",
            "menutitle" => "Offre sélectionnée"),       
        array(
            "name" => "ApresAvoirAccepteOffre",
            "title" => "Vous avez accepté l'offre",
            "menutitle" => "Offre acceptée"),
        array(
            "name" => "HistoriqueOffres",
            "title" => "Votre Historique",
            "menutitle" => "Historique"),
        array(
            "name" => "ModifierRetirerOffre",
            "title" => "Modifier ou retirer votre offre",
            "menutitle" => "Modifer/Retirer"),
        array(
            "name" => "ApresAvoirModifieOffreAvecSucces",
            "title" => "Votre offre a bien été modifée",
            "menutitle" => "Offre modifée"),
        array(
            "name" => "ApresAvoirModifieOffreAvecEchec",
            "title" => "Une erreur est apparue",
            "menutitle" => "Offre non-modifée"),
        array(
            "name" => "EtesVousSurDeSuppimerOffre",
            "title" => "Etes-vous sûr de supprimer votre offre?",
            "menutitle" => "Supprimer votre offre?"),        
        array(
            "name" => "AttribuerRate",
            "title" => "Veuillez attribuer un rate",
            "menutitle" => "Donner un rate"),        
        array(
            "name" => "AnnulerOffreAcceptee",
            "title" => "Souhaitez-vous vous retirer sur cette offre?",
            "menutitle" => "Se retirer?"),
        array(
            "name" => "VotreMessage",
            "title" => "Votre message",
            "menutitle" => "message"),
        array(
            "name" => "Conversation",
            "title" => "Consulter votre conversation",
            "menutitle" => "conversation"),
        /*page amdinistrateur, dont l'accès est un peu plus contrôlé (CF checkPage)*/
        array(
            "name" => "pageadministrateur",
            "title" => "Page administrateur",
            "menutitle" => "admin"),
        array(
            "name" => "Report",
            "title" => "Signalez une activité louche à l'administrateur",
            "menutitle" => "Report"),        
    );
    
    
    
    /* La liste des pages accessibles quand on est pas dans l'espace membres */
    $pagelistSiNonAccessible = array(
        "Accueil", "NotreAction","PageInscription","ConditionsUtilisation"
    );
    
    
    
    
    /* Les aliments recensés sur notre site */ 
    
    
    $feculents = array(
        "Lasagne", "Haricot", "Semoule", "Pâtes","Pain","Huile d''olive", "Pommes de terre", "riz","lentilles"
    );
    $fruits = array(
       "Raisins","Quinoa", "Pamplemousse", "Noix", "Myrtille", "Kiwi", "Grenade", "Pommes","Cerises","Bananes","Fraises","Poire","Noix de Coco","Ananas","Canneberge",'Citron',
       "Framboises"
    );
    $legumes = array(
        "Pignons de pin", "Fenouil", "Salade", "Tomates", "Oignion","Choux","Poivrons","Avocat",'Betterave',"Carotte","Châtaignes"
    );
    $laitage = array(
        "Fromage","Lait","Yaourt","Beurre","Crème","Danette","Fromage blanc","Margarine"
    );
    $sucreries = array(
       "Barres de Céréaleséé",  "Jus de Fruit", "Compote", "Miel","Viennoiseries","Confiture", "Biscuits sucrés", "Chocholat"
    );
    $viande = array(
       "Lardons","Chorizo", "Canard", "Araignée de boeuf", "Bacon", "Bavette de boeuf", "Agneau","Steack hâché","Saucisson", "Poulet", "Dinde","Lapin","Veau","Cheval","jambon","Pâté/Rilletes",
    );
    $poisson=array(
        "Haddock","Anchois",'Bar','Bigorneau','Araignée de mer','Brochet', 'Bulot',"Calmart","Carpe","Colin","Crevettes","Dorade","écrevisse"
    );
    $autre = array(
        "Soupe","Oeuf","Pain","Pizza"
    );
    
    
    
    

    /* Fonction qui vérifie que la page demandée est accessible pour l'utilisateur, retourne true, si c'est le cas */

    function checkPage($askedPage) {
        global $page_list;
        foreach ($page_list as $page) {
            if ($page["name"] == $askedPage) {
                if($askedPage != "pageadministrateur"){
                        return true;
                }
                /*côté amdin*/
                else{
                    if(isset($_SESSION)&& $_SESSION['Pseudo'] == 'olivier'){
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    
    
    /* Fonctoin qui renvoie vraie ssi l'utilisateur est sur une des quatres pages accessibles lorsqu'on est pas connecté */
    function checkPageSiNonConnecte($askedPage){
        global $pagelistSiNonAccessible;
        foreach ($pagelistSiNonAccessible as $page) {
            if ($page == $askedPage) {
                
                return true;
            }
        }
        
        return false;
    } 
    

    /* Donne le titre, à afficher, de la page demandée. */

    function getPageTitle($askedPage) {
        global $page_list;
        foreach ($page_list as $page) {
            if ($page['name'] == $askedPage) {
                return $page['title'];
            }
        }
    }

    /* Donne le contenu à afficher dans la barre de navigation. */
    function getPageMenuTitle($askedPage) {
        global $page_list;
        foreach ($page_list as $page) {
            if ($page['name'] == $askedPage) {
                return $page['menutitle'];
            }
        }
    }

    
    
    /* Génère les en-tête */

    function generateHeader($TitreDeLaPage, $FeuilleDeStyle) {
        echo'
   <!DOCTYPE html>

    <html>
    <head>  
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
        <meta name="author" content="Luc&Claire"/>
        <meta name="keywords" content="Mots clefs relatifs à cette page"/>
        <meta name="description" content="Descriptif court"/>
        <title>'.$TitreDeLaPage.'</title>
        <link href='.$FeuilleDeStyle.' rel="stylesheet" />';

        /* Partie bootstrap */
        echo'<script src="js/bootstrap.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">';
        
            
                
        echo'<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>';

        /* Partie qui génère les dépliants (pour les messages, ou sur l'historique des offres) */
        echo'<link href=css/deroule.css rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="js/deroule.js"></script>';

        /* Partie qui gère les checkbox qu'il faut parfois cocher lors de la complétion d'un formulaire*/  
        echo'<script src="js/checkBox.js"></script>';
       
        
        /* Partie menu de navigation*/
	echo'<link rel="stylesheet" href="css/menu/style.css"> <!-- Resource style -->
	<script src="js/menu/modernizr.js"></script> ';   
        
       /* Partie qui génère le dynamisme des formulaires d'inscription, d'offres et de désinscription */        
	echo '<link href="css/progression/progression.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/progression/progression.min.js"></script>
        <script type="text/javascript" src="js/progression/pro.js"></script>
        
         </head>                                           
        <body>';

    }


    /* Génère les footer */

    function generateFooter() {
        echo <<<CHAINE_DE_FIN
    <br/>
    <br/>

    <br/>
    <div id="footer">
    <p>Site réalisé en Modal par Luc&Claire</p>
    </div>        
    <script src="js/menu/jquery-2.1.1.js"></script>
<script src="js/menu/main.js"></script>
    <script src="js/jquery.js"></script>        
    <script src="js/bootstrap.js"></script>
    </body>
    </html>
CHAINE_DE_FIN;
    }

    
    
    /* Genère le menu, on fait appel à un autre fichier, contenu également dans Utilitaires */

    function generateMenu($titre) {
        require"Utilitaires/Menu.php";
        echo '<h1 class="titMax">'.$titre.'</h1>';
        echo'<br/>';
        echo'<br/>';
    }










    /* Pour une liste de messages, la fonction renvoie la liste des messages non-lus */
    function detecterMessagesNonLus($messages){
        $messagesnonlus=array();
        foreach($messages as $message){
            if($message->Lu == 'non'){
                $temp = array($message);
                $messagesnonlus = array_merge($messagesnonlus,$temp);
            }        
        }
        return $messagesnonlus;
    }
    
    
    
    /* Pour une liste de messages, la fonction renvoie la liste des messages lus */
    function detecterMessagesLus($messages){
        $messageslus=array();
        foreach($messages as $message){
            if($message->Lu == 'oui'){
                $temp = array($message);
                $messageslus = array_merge($messageslus,$temp);
            }        
        }
        return $messageslus;
    }
    
/* Vérifie qu'un offre repérée par id peut être acceptée */   

    
?>