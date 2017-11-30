<?php

/* Lorsque l'utilisateur fait une erreur à la complétion d'un formulaire, on remplit la variable de session 'erreur' selon
 * la faute qui a été commise. printErreur() est toujours appelée en début de page.
 */

function printErreur(){
   switch ($_SESSION['erreur']) {
       
       /*Inscription */
        case 'nonauthorized':
            echo '<h1 class="tit">La page que vous avez demandée n\'est pas accessible</h1><br/><br/>';
            break;
        
        case 'mdptropcourt':
            echo '<h1 class="tit">Votre mot de passe doit posséder au moins 10 caractères</h1><br/><br/>';
            break;
        
        case 'mdpdifferents':
            echo '<h1 class="tit">Il y a une différence dans le mot de passe et votre confirmation de mot de passe</h1><br/><br/>';
            break;
        
        case 'loginexistant':
            echo'<h1 class="tit">ce login est déjà utilisé, veuillez en choisir un autre</h1><br/><br/>';
            break;
        
        case 'mailexistant':
            echo'<h1 class="tit">Ce mail est déjà utilisé, veuillez en choisir un autre</h1><br/><br/>';
            break;
        
        case'fbexistant':
            echo'<h1 class="tit">Ce profil fb est déjà utilisé, veuillez en choisir un autre</h1><br/><br/>';
            break;        
        case 'falsemdp':
            echo'<h1 class="tit"> Vous vous êtes trompés sur l\'ancien mot de passe</h1><br/><br/>';
            break;
        case 'forgetmdp' : 
            echo '<h1 class="tit">Vous vous êtes trompés sur la valeur de votre mot de passe</h1><br/><br/>';
            break;
        case 'forgetlogin': 
            echo '<h1 class="tit">Vous vous êtes trompés sur la valeur de votre identifiant</h1><br/><br/>';
            break;

        /* Partie Secure*/
        /*Partie inscription*/
        case 'pseudoInvalide':
            echo '<h1 class="tit">Le pseudo que vous avez rentré est invalide</h1><br/><br/>';
            break;
        case 'mdpInvalide':
            echo '<h1 class="tit">Le mot de passe que vous avez rentré est invalide</h1><br/><br/>';
            break;
        case 'prenomInvalide':
            echo '<h1 class="tit">Ce n\'est pas un prénom ça!</h1><br/><br/>';
            break;
        case 'nomInvalide':
            echo '<h1 class="tit">Ce n\'est pas un nom ça!</h1><br/><br/>';
            break;        
        case 'emailInvalide':
            echo '<h1 class="tit">L\'email que vous avez rentré est invalide</h1><br/><br/>';
            break;
        case 'lienInvalide':
            echo '<h1 class="tit">Le lien fb que vous avez rentré est invalide</h1><br/><br/>';
            break;

        /*Partie Offre*/
        case 'TitreInvalide':
            echo '<h1 class="tit">Le titre que vous avez rentré est invalide</h1><br/><br/>';
            break;        
        case 'DescriptionDuPlatInvalide':
            echo '<h1 class="tit">La description du plat que vous avez rentré est invalide</h1><br/><br/>';
            break;
        case 'AdresseInvalide':
            echo '<h1 class="tit">L\'adresse que vous avez rentré est invalide</h1><br/><br/>';
            break;
        case 'CodePostalInvalide':
            echo '<h1 class="tit">Le code postal que vous avez rentré est invalide</h1><br/><br/>';
            break;
        case 'NumeroDeTelInvalide':
            echo '<h1 class="tit">Le numéro de téléphone que vous avez rentré est invalide</h1><br/><br/>';
            break;
        
        /* Message */
        case 'ObjetInvalide':
            echo '<h1 class="tit">L\'objet que vous avez rentré est invalide</h1><br/><br/>';
            break;
        case 'MessageInvalide':
            echo '<h1 class="tit">Le message que vous avez rentré est invalide</h1><br/><br/>';
            break;
        
        
        /* Partie désinscription */
        case 'raisonInvalide':
            echo '<h1 class="tit">La raison que vous avez rentrée semble invalide</h1><br/><br/>';
            break;
   }
   
   
   unset($_SESSION['erreur']);
}

?>

