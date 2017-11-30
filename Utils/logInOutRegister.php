<?php

/* Fonction de login d'un utilisateur */
function logIn($dbh) {
    
    /* On vérifie que le todo = login a été appelé convenablement */
    if (isset($_POST['loginConnexion']) && isset($_POST['mdpConnexion'])){
        
        /* On récupère les champs remplis */
        $login = $_POST['loginConnexion'];
        $mdp = $_POST['mdpConnexion'];
        
        /* On vérifie que le login entré correspond a un utilisateur existant */
        if (Utilisateurs::getUtilisateur($dbh, $login) != NULL) {
            
            /* Puis que le mot de passe entré correspond bien à celui du pseudo entré */
            if (Utilisateurs::testerMdp($dbh, $login, $mdp)) {
                
                /* Si oui, on connecte l'utilisateur, et on stocke quelques variables de SESSION */
                $_SESSION['loggedIn'] = true;
                $user = Utilisateurs::getUtilisateur($dbh, $_POST['loginConnexion']);
                $_SESSION['Pseudo'] = $user->Pseudo;
                $_SESSION['Mdp'] = $user->Mdp;
                $_SESSION['Prenom'] = $user->Prenom;
                $_SESSION['Nom'] = $user->Nom;
                $_SESSION['Email'] = $user->Email;
                $_SESSION['ProfilFb'] = $user->ProfilFb;
            } 
            else {
                $_SESSION['erreur']= 'forgetmdp';
            }
        } 
        else {
            $_SESSION['erreur']='forgetlogin';
        }
    }
}






/* Le login de l'admin */
function logInAdmin($dbh){
    $login = $_SESSION['Pseudo'];
    $mdp = $_POST['mdpadmin'];
    if($_POST['mdpadmin'] != $_POST['mdpadminbis']) {
        $_SESSION['erreur'] = 'mdpdifferents';
        return 'pageadministrateur';
    }
    elseif(Utilisateurs::testerMdp($dbh, $login, $mdp)){
        /* Connection de l'admin */
        $_SESSION['loggedInAdmin'] = true;
        return "pageadministrateur";
    }
    else{
        $_SESSION['erreur'] = 'forgetmdp';
        return 'pageadministrateur' ;
    }
} 




/* La fonction de déconnection */
function logOut() {
    
    /*Partie admin : on unset la variable de session 'loggedInAdmin' qui est la condition de connection de l'admin */
    if(isset($_SESSION['loggedInAdmin'])){
        unset($_SESSION['loggedInAdmin']);
    }
    /*Partie commune*/
    $_SESSION['loggedIn'] = false; /* Déconnection */
    
    /* On unset toutes les variables de session */
    unset($_SESSION['Pseudo']);
    unset($_SESSION['Mdp']);
    unset($_SESSION['Prenom']);
    unset($_SESSION['Nom']);
    unset($_SESSION['email']);
    unset($_SESSION['ProfilFb']);    
}








/* Enregistre un nouvel utilisateur */

function register($dbh) {
    
    
    /* On vérifie que l'utilisateur essaie bien de s'écrire via la page - et non via l'url */
    if(isset($_POST['loginInscription']) && isset($_POST['mdpInscription1']) && isset($_POST['mdpInscription2']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['link']) && isset($_POST['email'])){
        
        /* On check les entrées passées par l'utilisateur, on excluant les caractères trop spéciaux */
        
        if(!checkTxt($_POST['loginInscription'])){
            $_SESSION['erreur']='pseudoInvalide';
            return 'PageInscription'; 
        }
        
        /* Partie mot de passe */
        
        /* Le mdp et sa confirmation doivent être identiques */
        elseif(!checkTxt($_POST['mdpInscription1']) || !checkTxt($_POST['mdpInscription2']) ){
            $_SESSION['erreur']='mdpInvalide';
            return 'PageInscription' ;
        }
        /* Si le mdp et la confirmation du mdp ne sont pas égaux : problème */

        elseif ($_POST['mdpInscription1'] != $_POST['mdpInscription2']) {
            $_SESSION['erreur'] = 'mdpdifferents';
            return 'PageInscription';
        }
        
        
        
        elseif(!checkTxt($_POST['prenom'])){
            $_SESSION['erreur']='prenomInvalide';
            return 'PageInscription'; 
        }
        elseif(!checkTxt($_POST['nom'])){
            $_SESSION['erreur']='nomInvalide';
            return 'PageInscription'; 
        }
        
        /* Ici on utilise la fonction qui vérifie que le lien commence par 'https://www.facebook.com/'*/     
        elseif($_POST['link'] !='' && !checkLinkFb($_POST['link'])){
            $_SESSION['erreur']='lienInvalide';
            return 'PageInscription'; 
        }
    
    
        
  

        /* Cherche si le login a déjà été utilisé ; si oui, il faut en trouver un autre  */ 

        elseif (Utilisateurs::getUtilisateur($dbh, $_POST['loginInscription']) != NULL) {
            $_SESSION['erreur'] = 'loginexistant';
            return 'PageInscription';
        }

    
        /* Cherche si le mail a déjà été utilisé ; si oui, il faut en trouver un autre : on redirige vers la page d'échec d'inscription */

        elseif (Utilisateurs::emailExisted($dbh, $_POST['email']) != NULL) {
            $_SESSION['erreur'] = 'mailexistant';
            return 'PageInscription';
        }


        /* Selon que l'utilisateur ait bien voulu rentrer son profil fb ou non */ 
   
        elseif ($_POST['link'] != NULL) {
        /* Si une telle page fb a déjà été renseignée, il faut en trouver un autre*/
            if (Utilisateurs::profilFbExisted($dbh, $_POST['link']) != NULL) {
                $_SESSION['erreur'] = 'fbexistant';
                return 'PageInscription';
            } 
        
            else {
                /* Sinon on inscrit l'utilisateur et on le redirige vers la page de succès de l'inscription */
                Utilisateurs::insererUtilisateur($dbh, $_POST['loginInscription'], $_POST['mdpInscription1'], $_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['link']);
                
                /* On oublie pas d'initialiser le rate de l'utilisateur */
                Rate::initialiserRate($dbh, $_POST['loginInscription']);
                
                /* On le login immédiatement */
                $_POST['loginConnexion'] = $_POST['loginInscription'];
                $_POST['mdpConnexion'] = $_POST['mdpInscription1'];
                login($dbh);
                
                /* On félicite pour l'inscription */
                return 'ApresSEtreInscritAvecSucces';
            }
        }

            
        /* Si tous les identifiants conviennent, on ajoute l'utilisateur et on le redirige vers la page de succès de l'inscription */ 
        else {
            Utilisateurs::insererUtilisateur($dbh, $_POST['loginInscription'], $_POST['mdpInscription1'], $_POST['prenom'], $_POST['nom'], $_POST['email'], null);     
            Rate::initialiserRate($dbh, $_POST['loginInscription']);
            $_POST['loginConnexion'] = $_POST['loginInscription'];
            $_POST['mdpConnexion'] = $_POST['mdpInscription1'];
            login($dbh);
            return 'ApresSEtreInscritAvecSucces';
        }
    }

    
}












/*La fonction permet de changer le mot de passe de l'utilisateur courant*/

function changeMDP($dbh){
    
    /* On vérifie d'abord que l'utilisateur accède à la page par méthode usuelle, et non en passant par l'url*/
    
    if(isset($_POST['ancienmdp']) && isset($_POST['nouvmdp']) && isset($_POST['nouvmdpbis'])){
        /* Puis on vérifie que les champs remplis par l'utilisateur sont convenables */
        if (!checkTxt($_POST['ancienmdp']) || !checkTxt($_POST['nouvmdp']) || !checkTxt($_POST['nouvmdpbis'])){
            $_SESSION['erreur']="mdpInvalide";
            return 'MonProfilChangePassword';
        }    

        /* Partie mot de passe */
        
        /* Puis on vérifie que les deux entrées pour le nouveau mot de passe sont identiques*/          
        elseif ($_POST['nouvmdp'] != $_POST['nouvmdpbis']) { 
                $_SESSION['erreur']="mdpdifferents";
                return 'MonProfilChangePassword';
        }                
        
        
            
        /* Enfin on vérifie que l'ancien mot de passe entré dans le formulaire est identique au mot de passe associé dans la base à l'utilisateur en question */
        elseif (Utilisateurs::testerMdp($dbh, $_SESSION['Pseudo'],$_POST['ancienmdp'])==false) {
                $_SESSION['erreur'] = 'falsemdp';
                return 'MonProfilChangePassword';
         } 
        
         /*Si tout va bien jusque là, mettre à jour le mot de passe haché (fonction SHA1($passwd)) dans la base de données.*/
         else{
            Utilisateurs::modifierMdp($dbh, $_SESSION['Pseudo'], $_POST['nouvmdp']);
            return 'ApresModificationMDPAvecSucces';            
        }
    }   
}







/* Supprime le compte de l'utilisateur du compte courant.
 * Supprime également toutes les offres en cours que cet utilisateur a pu faire.
 * Libère également les offres précédemments acceptées en prévenant les donneurs que l'offre s'est libérée.
 * Enregistre enfin la raison de son départ dans notre table*/

function deleteUser ($dbh) {
/* Tout d'abord le cas de l'admin, qui peut supprimer tous les comptes qu'il veut */
            if(isset($_SESSION['loggedInAdmin'])){
                
                Offres::libererOffreQuandSuppression($dbh, $_GET['user']);
                Offres::retirerOffreQuandSuppression($dbh,$_GET['user']);
                RaisonsDepart::insererRaison($dbh, "Supprimé par administrateur");
                $message = "Bonjour. ".$_GET['user']." s'est vu supprimer son compte pour mauvais comportement. Nous avons donc libéré l'offre que vous aviez en cours avec lui.";
                Offres::envoieMessagesInformations($dbh, $_GET['user'], $message);
                Rate::supprimer($dbh, $_GET['user']);
                Utilisateurs::supprimerCompte($dbh, $_GET['user']);
                return "pageadministrateur";
            }

/* Puis petit contrôle du contenu des formulaires que remplit l'utilisateur courant lors de sa désinscription*/            
            if ( isset($_POST['logindesinscription']) && isset($_POST['mdpdesinscription1'])&& isset($_POST['mdpdesinscription2']) && isset($_POST['raisonDepart'])) {
                
                if(!checkTxt($_POST['logindesinscription'])){
                    $_SESSION['erreur']='pseudoInvalide';
                    return 'MonProfilDeleteUser';
                }                
                elseif(!checkTxt($_POST['mdpdesinscription1']) || !checkTxt($_POST['mdpdesinscription2'])){
                    $_SESSION['erreur']='mdpInvalide';
                    return 'MonProfilDeleteUser';
                }                        
                elseif ($_POST['logindesinscription'] != $_SESSION['Pseudo']) {
                   $_SESSION['erreur']= 'forgetlogin';
                   return 'MonProfilDeleteUser';
                }
                else if ($_POST['mdpdesinscription1'] != $_POST['mdpdesinscription2']) { 
                    $_SESSION['erreur']="mdpdifferents";
                    return 'MonProfilDeleteUser';
                }
                
            
        /*vérifier que l'ancien mot de passe entré dans le formulaire est identique au mot de passe associé dans la base à l'utilisateur en question */
                else if (Utilisateurs::testerMdp($dbh, $_SESSION['Pseudo'],$_POST['mdpdesinscription1'])==false) {
                    $_SESSION['erreur'] = 'falsemdp';
                    return 'MonProfilDeleteUser';
                } 
        
         /*Si tout va bien jusque là */
                else{
                    /* I. On libère les offres que l'utilisateur avait acceptées */
                    Offres::libererOffreQuandSuppression($dbh, $_SESSION['Pseudo']);
                    
                    /* II ... et on prévient! */
                    $message = "Bonjour. ".$_SESSION['Pseudo']." a supprimé son compte. Nous avons donc libéré l'offre que vous aviez en cours avec lui.";
                    Offres::envoieMessagesInformations($dbh, $_SESSION['Pseudo'], $message);
                    
                    /* III On retire de la circulation toutes les offres postées par l'utilisateur */
                    Offres::retirerOffreQuandSuppression($dbh,$_SESSION['Pseudo']);
                    
                    /* IV On inscrit sa raison de départ */
                    RaisonsDepart::insererRaison($dbh, htmlspecialchars($_POST['raisonDepart']));
                    
                    /* V On supprime la ligne de rate de l'utilisateur, et son compte */
                    Rate::supprimer($dbh,$_SESSION['Pseudo']);
                    Utilisateurs::supprimerCompte($dbh, $_SESSION['Pseudo']); 
                    
                    /* VI On le déconnecte */
                    logOut();
                    
                    /* VII On retourne vers la page de confirmation de désinscription */
                    return 'ApresDesinscriptionAvecSucces';
            }  
        }
}







/* Fonction google qui nous permet de récupérer (Latitude,Longitude) à partir d'une adresse réelle */
function getLnt($zip){ $zip=trim($zip);
 
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=true";
 
 
 
$result_string = file_get_contents($url);
 
$result = json_decode($result_string, true);
return $result['results'][0]['geometry']['location'];
 
}








/* Enregistre l'offre d'un utilisateur */

function registerOffer($dbh){
    
    /* On vérifie que l'utilisateur n'essaie pas d'y accéder depuis l'URL:*/
    if(isset($_POST['Adresse']) && isset($_POST['CodePostal']) && isset($_POST['Titre']) && isset($_POST['DescriptionDuPlat']) && isset($_POST['NumeroDeTel']) && isset($_POST['Ali'])){
        $val = getLnt($_POST["Adresse"]);
        
        /* On check les entrées de l'utilisateur avec notre fontction checkTxt*/
        if(!(checkTxt($_POST['Adresse']))){
            $_SESSION['erreur'] ='AdresseInvalide';
            return 'Offrir';
        }
    
       
        $Lat =$val['lat'];
 
        $Lng=$val['lng'];
        
        
       
        if(!checkTxt($_POST['Titre'])){
            $_SESSION['erreur'] ='TitreInvalide';
            return 'Offrir';
        }
        
              
                
        elseif($_POST['NumeroDeTel']!="" && checkNum($_POST['NumeroDeTel'])){
            $_SESSION['erreur'] ='NumeroDeTelInvalide';
            return 'Offrir';
        }

        elseif(!testCodePostalValide($_POST['CodePostal'])){
            $_SESSION['erreur'] ='CodePostalInvalide';
            return 'Offrir';            
        }
        
        
        /* Si tout va bien alors, on peut enregistrer l'offre. $bol est le boolean false de l'Etat de l'offre quand elle est enregistrée */
        $bol =  False;
        
        
            
            /* On distingue les cas suivant que l'utilisateur a renseigné son numéro de tel ou non, et une description de plat ou non */
            if($_POST['NumeroDeTel'] != '' && $_POST['DescriptionDuPlat'] !=''){            
                Offres::insererOffre($dbh, $_SESSION['Pseudo'], null, true, $_POST['Titre'], $_POST['quantite'], $_POST['Date'],$_POST['Adresse'],$_POST['CodePostal'],$_POST['NumeroDeTel'],htmlspecialchars($_POST['DescriptionDuPlat']),$Lat,$Lng,$bol);
                AlimentsExistant::registerAliment($dbh, $_POST['Ali']);
                return 'ApresAvoirOffertAvecSucces';
            }
        
            elseif($_POST['NumeroDeTel'] != '' && $_POST['DescriptionDuPlat'] ==''){
                Offres::insererOffre($dbh, $_SESSION['Pseudo'], null, true, $_POST['Titre'], $_POST['quantite'], $_POST['Date'],$_POST['Adresse'],$_POST['CodePostal'], $_POST['NumeroDeTel'],null,$Lat,$Lng,$bol);
                AlimentsExistant::registerAliment($dbh, $_POST['Ali']);
                return 'ApresAvoirOffertAvecSucces';
            }   
        
            elseif($_POST['NumeroDeTel'] == '' && $_POST['DescriptionDuPlat'] != '') {
                Offres::insererOffre($dbh, $_SESSION['Pseudo'], null, true, $_POST['Titre'], $_POST['quantite'], $_POST['Date'],$_POST['Adresse'],$_POST['CodePostal'],null,htmlspecialchars($_POST['DescriptionDuPlat']),$Lat,$Lng,$bol);
                AlimentsExistant::registerAliment($dbh, $_POST['Ali']);
                return 'ApresAvoirOffertAvecSucces';
            }
            else{
                Offres::insererOffre($dbh, $_SESSION['Pseudo'], null, true, $_POST['Titre'], $_POST['quantite'], $_POST['Date'],$_POST['Adresse'],$_POST['CodePostal'],null, null,$Lat,$Lng,$bol);
                AlimentsExistant::registerAliment($dbh, $_POST['Ali']);
                return 'ApresAvoirOffertAvecSucces';
            }
        
        
    }
    
    
        
}











/* Permet à l'utilisateur courant de modifier son offre. 
 * On renvoie vers la page de de confirmation de modification de l'offre si tout va bien.
 * Si on s'amuse à rentrer une mauvaise id (non-existante // non-disponible, on renvoie une erreur)
 * ou si on rentre de mauvaises données, on renvoie vers la page d'échec de l'offre */ 
function modifyOffer($dbh){
    
    /* On vérifie que l'utilisateur essaie bien de modifier son offre depuis la page prévue à cet effet :*/
    if(isset($_POST['adresse']) && isset($_POST['Ali']) && isset($_POST['codePostal']) && isset($_POST['titre']) && isset($_POST['descriptionDuPlat']) && isset($_POST['numeroDeTel'])){
    
        /* On vérifie que les champs remplis sont valides et ceux obligatoires sont valides */    
    
        if(!isset($_POST['adresse']) || !(checkTxt($_POST['adresse']))){
            $_SESSION['erreur'] ='AdresseInvalide';
            return 'ModifierRetirerOffre';
        }
        elseif(!isset($_POST['titre']) || !checkTxt($_POST['titre'])){
            $_SESSION['erreur'] ='TitreInvalide';
            return 'ModifierRetirerOffre';
        }
            
        elseif($_POST['numeroDeTel']!="" && checkNum($_POST['numeroDeTel'])){
            $_SESSION['erreur'] ='NumeroDeTelInvalide';
            return 'ModifierRetirerOffre';
        }
        /* On vérifie que le code postal est valide */
        elseif(!isset($_POST['codePostal']) ||!testCodePostalValide($_POST['codePostal'])){
            $_SESSION['erreur'] ='CodePostalInvalide';
            return 'ModifierRetirerOffre';            
        }
    
        else{
        /* Fonction qui récupère les coordonnées GPS à partir de l'adresse */
            $val = getLnt($_POST["adresse"]);
            $Lat =$val['lat'];
            $Lng=$val['lng'];
    
/*Les étapes classiques de protection de l'URL, on vérifie 
 * 1. que l'ID de l'offre est bien présente dans l'URL
 * 2. que l'offre repérée par cette ID existe bien
 * 3. que l'offre repérée par cette ID appartient bien à l'utilisateur courant
 */
            if(isset($_GET['ID'])){
                $offre = Offres::offreId($dbh, $_GET['ID']);
                if($offre!=null){
                
                    if($_SESSION['Pseudo'] == $offre->Donneur){
                    
                        /* Puis on UPDATE l'offre en séparant les cas comme dans le cas de l'enregistrement de l'offre */
                    
                        if($_POST['numeroDeTel'] != '' && $_POST['descriptionDuPlat'] !=''){            
                            Offres::modiferOffre($dbh,$_GET['ID'], $_POST['titre'], $_POST['Quantite'], $_POST['date'],$_POST['adresse'],$_POST['codePostal'],$_POST['numeroDeTel'], htmlspecialchars($_POST['descriptionDuPlat']),$Lat,$Lng);
                            AlimentsExistant::modifierAliment($dbh, $_GET['ID'], $_POST['Ali']);
                            return 'ApresAvoirModifieOffreAvecSucces';
                        }           
        
                        elseif($_POST['numeroDeTel'] != '' && $_POST['descriptionDuPlat'] ==''){
                            Offres::modiferOffre($dbh,$_GET['ID'], $_POST['titre'], $_POST['Quantite'], $_POST['date'],$_POST['adresse'],$_POST['codePostal'],$_POST['numeroDeTel'],null,$Lat,$Lng);
                            AlimentsExistant::modifierAliment($dbh, $_GET['ID'], $_POST['Ali']);
                            return 'ApresAvoirModifieOffreAvecSucces';
                        }
        
                        elseif($_POST['numeroDeTel'] == '' && $_POST['descriptionDuPlat'] != '') {
                            Offres::modiferOffre($dbh,$_GET['ID'], $_POST['titre'], $_POST['Quantite'], $_POST['date'],$_POST['adresse'],$_POST['codePostal'],null, htmlspecialchars($_POST['descriptionDuPlat']),$Lat,$Lng);
                            AlimentsExistant::modifierAliment($dbh, $_GET['ID'], $_POST['Ali']);
                            return 'ApresAvoirModifieOffreAvecSucces';
                        }
        
                        else{
                            Offres::modiferOffre($dbh,$_GET['ID'], $_POST['titre'], $_POST['Quantite'], $_POST['date'],$_POST['adresse'],$_POST['codePostal'],null,null,$Lat,$Lng);
                            AlimentsExistant::modifierAliment($dbh, $_GET['ID'], $_POST['Ali']);
                            return 'ApresAvoirModifieOffreAvecSucces';
                        }
                    }
                }
            }
        }            
    }
}







/*Retire l'offre qui avait été postée. 
 * On renvoie alors vers l'historique des offres de l'utilisateur.
 * Si on s'amuse à rentrer une mauvaise id (non-existante // non-disponible, on renvoie une erreur) */ 

function withdrawOffer($dbh){
    
    /* Au cas où quelqu'un rentre une ID  dans la barre URL, on vérifie:
 * 1. que l'URL contient bien un ID, et que l'offre repérée par ID existe bien.
 * 2. que l'utilisateur courant est bien le propriétaire de l'offre repérée par ID.
 * 3. Cas particulier : l'admin peut supprimer n'importe quelle offre existante.
 On vérifie également le contenu du message avec nos fonctions qui travaillent le texte */
    if(isset($_GET['ID'])){
        $offre = Offres::offreId($dbh, $_GET['ID']);
        if($offre != null){
            if($_SESSION['Pseudo'] == $offre->Donneur || isset($_SESSION['loggedInAdmin'])){
                /* Si tout va bien, on supprime l'offre de la table, aliment que la ligne de Aliment Existant */
                AlimentsExistant::retirerAliment($dbh,  $_GET['ID']);
                Offres::retirerOffre($dbh, $_GET['ID']);
                return "HistoriqueOffres";
            }
        }
    }    
}









/* Attribue une note à l'offre repérée par ID dans la table RateOffers.
* Met à jour la note de l'utilisateur dont le plat a été noté.
* On envoie un message au donneur pour le prévenir que son offre a été notée
* On renvoie vers la page d'historique des offres de l'utilisateur courant.
* Si on s'amuse à rentrer une mauvaise id (non-existante // non-disponible, on renvoie une erreur) */ 

function RateMyDish($dbh){

/* Au cas où quelqu'un rentre une ID et/ou un mauvais utilisateur non approprié(s) dans la barre URL, on vérifie:
 * 1. que l'URL contient bien un ID et un Donneur.
 * 2. que l'offre repérée par l'ID et le Donneur en question existe bien.
 * 3. que pour l'offre en question, le receveur est bien l'utilisateur courant, et que le donneur est bien Donneur de l'ID
 On vérifie également le contenu du message avec nos fonctions qui travaillent le texte */       
    if(isset($_GET['ID']) && isset($_GET['Donneur'])){
        $offre = Offres::offreId($dbh, $_GET['ID']);
        $user = Utilisateurs::getPseudoUtilisateur($dbh, $_GET['Donneur']);
        
        if(($offre != null) && ($user != null)){
            
            if((Offres::getDonneurId($dbh, $_GET['ID']) == $_GET['Donneur']) && (Offres::getReceveurId($dbh, $_GET['ID']) == $_SESSION['Pseudo'])){
                
                Offres::getRated($dbh, $_GET['ID']);
                if( isset ( $_POST['rate'])) {
                    RateOffer::initialiserRate($dbh,$_GET['ID'], $_POST['rate']);
                    Rate::updatingRate($dbh, $_GET['Donneur'], $_POST['rate']);
                    $message="Bonjour ".$_GET['Donneur']."! Votre offre \"".Offres::getTitreId($dbh, $_GET['ID'])."\" a reçu la note ".$_POST['rate']."/5. Encore merci pour votre don, et à très vite.";
                    Messagerie::insererMessagerie($dbh, 'olivier', $_GET['Donneur'], 'Notation', $message);
                    return "HistoriqueOffres";
                }
            }
        }
    }
    else{
        return "PageNonAuthorized";
    }
} 







/* Enregistre un message envoyé par l'utilisateur courant vers $_GET['Donneur'].
* On renvoie vers la page de la conversation avec le destinataire du message.
* Si on s'amuse à rentrer une mauvaise id (non-existante // non-disponible, on renvoie une erreur) */  

function registerMessage($dbh){
        
/* Au cas où quelqu'un rentre une ID non appropriée dans la barre URL, on vérifie:
 * 1. que l'URL contient bien un Donneur et que celui-ci est bien dans la table.
 * 2. que les $_POST existe bien (dur, si on travaille à partir de l'URL)
 On vérifie également le contenu du message avec nos fonctions qui travaillent le texte */   

    if(isset($_GET['Interlocuteur'])){
        $user = Utilisateurs::getUtilisateur($dbh, $_GET['Interlocuteur']);
        if($user!=null){
            if(isset($_POST['titre']) && isset($_POST['message']) ){
               /* On applique htmlspecialchar pour se protéger un peu */
                Messagerie::insererMessagerie($dbh, $_SESSION['Pseudo'],$_GET['Interlocuteur'],htmlspecialchars($_POST['titre']),htmlspecialchars($_POST['message']));
               return "Conversation";
            }
        }
    }

}
    

    
    
    
    
    
    
/* Marque que l'utilisateur courant a accepté l'offre sélectionnée.
 * Envoie une message au donneur pour le prévenir
 * Si on s'amuse à rentrer une mauvaise id (non-existante // non-disponible, on renvoie une erreur) */  
    
function accepterOffre($dbh){

/* Au cas où quelqu'un rentre une ID non appropriée dans la barre URL, on vérifie:
 * 1. que l'URL contient bien une ID et un Donneur
 * 2. que l'ID de l'offre entrée dans l'URL correspond à une offre existante
 * 3. que l'offre repérée par ID est bien toujours disponible, comme ça, on ne peut pas voler l'offre de quelqu'un
 */

    if(isset($_GET["ID"]) && isset($_GET['Donneur'])){
        $offre = Offres::offreId($dbh,$_GET["ID"]);
        if($offre !=null){
            if(Offres::getEtat($dbh, $_GET["ID"])){
                Offres::offreAcceptee($dbh,$_GET["ID"],$_SESSION['Pseudo']);
                $message="Bonjour ".$_GET['Donneur']."! ".$_SESSION['Pseudo']." a accepté votre offre \"".Offres::getTitreId($dbh, $_GET['ID'])."\". Vous pouvez le vérifier en consultant l'historique de vos dons. Envoyez-lui un message, s'il ne vous contacte pas avant !";
                Messagerie::insererMessagerie($dbh, 'olivier', $_GET['Donneur'], 'Offre acceptée', $message);
                return "ApresAvoirAccepteOffre";
            }
        }
    }
    else{
        return "PageNonAuthorized";
    }
}








/* Marque que l'utilisateur courant se retire de l'offre l'offre sélectionnée.
 * Envoie un message pour prévenir le donneur
 * Si on s'amuse à rentrer une mauvaise id (non-existante // non-disponible, on renvoie une erreur) */ 

function withdrawAcceptation($dbh){
    
/* Au cas où quelqu'un rentre une ID non appropriée dans la barre URL, on vérifie:
 * 1. que l'URL contient bien une ID
 * 2. que l'ID de l'offre entrée dans l'URL correspond à une offre existante
 * 3. que c'est bien l'utilisateur courant qui se retire de l'offre
 */
    if(isset($_GET["ID"])){
        $offre = Offres::offreId($dbh,$_GET["ID"]);
        if($offre !=null){
            if($offre->Receveur == $_SESSION['Pseudo']){
                Offres::retirerOffreAcceptee($dbh,$_GET['ID']);
                $message="Bonjour ".Offres::getDonneurId($dbh, $_GET["ID"])."! ".$_SESSION['Pseudo']." s'est désisté quant à votre offre \"".Offres::getTitreId($dbh, $_GET['ID'])."\". Elle est donc de nouveau disponible!";
                Messagerie::insererMessagerie($dbh, 'olivier', Offres::getDonneurId($dbh, $_GET["ID"]), 'Désistement', $message);
                return "HistoriqueOffres";
            }
        }
    }
    else{
        return "PageNonAuthorized";        
    }
}









/* Affiche le contenu d'un nouveau message reçu par l'utilisateur courant en renvoyant sur la page VotreMessage.
 Si on marque quelque chose d'adéquant dans l'URL, on est renvoyé vers la page d'erreur*/
function Consult($dbh){
/* Au cas où quelqu'un rentre une ID non appropriée dans la barre URL, on vérifie:
 * 1. que l'URL contient bien une ID
 * 2. que l'ID du message entré dans l'URL correspond bien à un message existant, et reçu par l'utilisateur courant
 */
    if(isset($_GET['Id'])){
        $message = Messagerie::getMessageId($dbh, $_GET['Id']);
        if($message != null){
            if($_SESSION['Pseudo'] == $message->recepteur){
                Messagerie::marquerCommeLu($dbh,$_GET['Id']);
                return "VotreMessage";
            }
        }
    }
}





/* Marque un message comme non-lu 
Puis renvoie vers la messagerie de l'utisateur courant */

function markAsNonRead($dbh){
/* Au cas où quelqu'un rentre une ID, on vérifie:
 * 1. que l'URL contient bien une ID de message
 * 2. que l'ID du message entré dans l'URL correspond bien à un message existant, et reçu par l'utilisateur courant
 */
    if(isset($_GET['id'])){
        $message = Messagerie::getMessageId($dbh, $_GET['id']);
        if($message != null){
            if($_SESSION['Pseudo'] == $message->recepteur){
                Messagerie::marquerCommeNonLu($dbh,$_GET['id']);
                return "MonProfilMessagerie";                
            }
        }
    }
}






/* Supprime un message. 
Puis renvoie vers la messagerie de l'utisateur courant */

function deleteMessage($dbh){
/* Au cas où joue avec l'url, on vérifie:
 * 1. que l'URL contient bien une ID de message
 * 2. que l'ID du message entré dans l'URL correspond bien à un message existant, et reçu par l'utilisateur courant
 */
    if(isset($_GET['id'])){
        $message = Messagerie::getMessageId($dbh, $_GET['id']);
        if($message != null){
            if($_SESSION['Pseudo'] == $message->recepteur){
                Messagerie::supprimerMessage($dbh, $_GET['id']);    
                return "MonProfilMessagerie";
            }
        }
    }
}








/* Envoie un message à l'admin, le signalant sur une offre louche
Renvoie sur la page de la messagerie de l'utilisateur */
function RegistermMessageSignalementOffre($dbh){


/* Au cas où quelqu'un joue avec l'url, on vérifie:
 * 1. que l'URL contient bien une IDoffre et un utilisateurEnTort,
 * 2. que l'ID de l'offre entré dans l'url correspond bien à une offre existante,
 * 3. que l'utilisateur entré dans l'url correspond bien à un utilisateur existant
 */
    if(isset($_GET['IDoffre']) && isset($_GET['utilisateurEnTort'])){
        $offre = Offres::offreId($dbh, $_GET['IDoffre']);
        $user = Utilisateurs::getUtilisateur($dbh, $_GET['utilisateurEnTort']);
        if($offre != null && $user !=null ){
            $titre = "Signalement de l'offre ".$_GET['IDoffre']." postée par l'utilisateur ".$_GET['utilisateurEnTort'];
            $recepteur = 'olivier';
            Messagerie::insererMessagerie($dbh, $_SESSION['Pseudo'],$recepteur,$titre,$_POST['message']);
            return 'MonProfilMessagerie';
        }
    }
    else{
        return "PageNonAuthorized";
    }
}



/* Envoie un message à l'admin, le signalant sur un utilisateur louche
Renvoie sur la page de la messagerie de l'utilisateur */
function RegistermMessageSignalementUtilisateur($dbh){


/* Au cas où quelqu'un joue avec l'url, on vérifie:
 * 1. que l'URL contient un utilisateurEnTort,
 * 2. que l'utilisateur entré dans l'url correspond bien à un utilisateur existant
 */
    if(isset($_GET['utilisateurEnTort'])){
        $user = Utilisateurs::getUtilisateur($dbh, $_GET['utilisateurEnTort']);
        if($user !=null ){
            $titre = "Signalement de l'utilisateur ".$_GET['utilisateurEnTort'];
            $recepteur = 'olivier';
            Messagerie::insererMessagerie($dbh, $_SESSION['Pseudo'],$recepteur,$titre,$_POST['message']);
            return 'MonProfilMessagerie';
        }
    }
    else{
        return "PageNonAuthorized";
    }
}


?>