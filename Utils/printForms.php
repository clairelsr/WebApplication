<?php



function printLoginForm($askedPage){
    
    echo'<div class="form-style-5">';
    echo'<form action="index.php?todo=login&name='.$askedPage;  
    
echo <<<CHAINE_DE_FIN

        " method="post">
    
    
<fieldset>
<legend>Connectez-vous</legend>
<input type="text" name="loginConnexion" placeholder="Votre Pseudo*" required>
<input type="password" name="mdpConnexion" placeholder="Votre MDP*" required> 
</fieldset>
    
<input type="submit" value="Sign In" />
</form>
    
<form action="index.php?name=PageInscription" method ="post">   
<input type="submit" value = "Pas encore inscrit, fonce!" />
</form>    
</div>
    
CHAINE_DE_FIN;
}








/* Renvoie la fiche récapitulatrice d'une offre, repérée par ID, actuellement consultée par l'utilisateur, repéré par pseudoDonneur*/
function printRecapitulatifOffre($dbh,$ID,$pseudoDonneur){
    echo'<div class="form-style-6">    
    <form id="myform" action="index.php?todo=withdrawacceptation&ID='.$ID.'&retire=0" method="post">';
    /* La partie relative aux caractéristiques de l'offre */
    
    echo'<div class="Legend"><span class="number">1</span> Description du plat</div>
    <div class ="tit4">Titre du plat : '.Offres::getTitreId($dbh,$ID).'</div> 
    <div class ="tit4">Nombre de personnes pouvant manger sur ce plat : '.Offres::getQuantite($dbh,$ID).'</div> 
    <div class ="tit4">Date limite de consommation : '.Offres::getDateLimiteDeConsommationId($dbh,$ID).'</div> 
    <div class ="tit4">Adresse de la rencontre: '.Offres::getAdresse($dbh,$ID).', '.Offres::getCodePostale($dbh,$ID).'</div> 
    <div class ="tit4">Description du plat : ';
    /* On distingue deux cas, suivant que le donneur a inscrit une description au plat, ou non */
    if (Offres::getDescriptionPlat($dbh,$ID) == null){
        echo "Le donneur n'a pas mis d'autres détails sur son offre";        
    }
    else{
        echo Offres::getDescriptionPlat($dbh,$ID);
    }
    echo"</div> ";
    
    /* La partie relative aux caractéristiques du donneur */
    echo"<div class='Legend'><span class='number'>2</span>Le donneur</div>
    <div class ='tit4'>Pseudo : ".Offres::getDonneurId($dbh,$ID)."</div> 
    <div class ='tit4'>Email : ".Utilisateurs::getMailUtilisateur($dbh,$pseudoDonneur)."</div> 
    <div class ='tit4'>Numéro de téléphone : ";
    /* On distingue deux cas, suivant que le donneur a inscrit son numéro de téléphone ou pas, ou non */
    if  (Offres::getNumeroId($dbh,$ID) == null){
        echo "Le donneur n'a pas mis son numéro de téléphone";    
    }
    else{
        echo Offres::getNumeroId($dbh,$ID);
    }
    
    echo'</div>
    <input type="submit" value="Se retirer" />
    </div>';
}





/* Affiche le formulaire qui permet de noter un utilisateur sur son offre */
function printformRate($ID,$Donneur){
    echo'<div class="form-style-5">    
    <form id="myform" action="index.php?todo=ratemydish&ID='.$ID.'&Donneur='.$Donneur.'&offrenotee=0" method="post">
    <div class="Legend3"><span class="number">R</span> Veuillez attribuer une note au plat que vous avez dégusté</div>
    <p><select name="rate">
    <optgroup label="Votre note">';
        echo"<option value = '1'>1 </option>
        <option value = '2'>2 </option>
        <option value = '3'>3 </option>
        <option value = '4'>4 </option>
        <option value = '5'>5 </option>
    </optgroup>
    </select></p>";

    echo'<input type="submit" value="Rate!" />
    </form>
    </div>';
}





/* Fiche de la description d'un don fait par l'utilisateur en cours, que personne n'a encore accepté */

function printDescriptionDonsEnCours($offres){
    
    /* Si auncun dont ne correspond à cette description */ 

    if($offres==null){
        echo"<h3 class ='tit4It'>Vous n'avez rien offert récemment </h3>";}
    
        
    else{
        foreach($offres as $offre){

        echo"<div class='tit4It'>Le titre du plat : ".$offre->Titre."</div>"; 
        echo"<div class ='tit5'>Date limite de consommation : ".$offre->DateLimiteDeConsommation."</div>"; 
        echo"<div class ='tit5'>Adresse de la rencontre : ".$offre->AdresseDeLaRencontre.", ".$offre->CodePostale."</div> ";
        echo"<div class ='tit5'>Description du plat : "; 
        if ($offre->CommentJeLaiCuisine== null){
            echo "Vous n'avez pas ajouté de détails";}
        else{
            echo $offre->CommentJeLaiCuisine;}
        echo"</div>";
        echo'<div class="modifierretireroffre"><a class="LienDeroulantTer" href="index.php?name=ModifierRetirerOffre&ID='.$offre->id.'&Titre='.$offre->Titre.'&Date='.$offre->DateLimiteDeConsommation.'&Quantite='.$offre->Quantite.'&Adresse='.$offre->AdresseDeLaRencontre.'&CodePostal='.$offre->CodePostale.'&numeroDeTel='.$offre->NumeroDeTel.'">Modifier/retirer cette offre </a></div> ';
        echo'<br/>';
        }
    }
}






/* Fiche de la descritpion des offres que l'utilisateur a accepté et qu'il doit encore noter */

function printDescriptionOffresEnCours($offres){
    
    /* Si auncun dont ne correspond à cette description */ 

    if($offres==null){
        echo"<h3 class ='tit4It'>Vous n'avez rien offert récemment </h3>";
    }
    
    else{
        
        foreach($offres as $offre){
            
        echo"<div class='tit4It'>Le titre du plat : ".$offre->Titre."</div>"; 
        echo"<div class ='tit5'>Le donneur : <a class='LienDeroulant' href='index.php?name=ProfilUtilisateur&userConsulte=".$offre->Donneur."'>".$offre->Donneur."</a></div>"; 
        echo"<div class ='tit5'>Date limite de consommation : ".$offre->DateLimiteDeConsommation."</div>"; 
        echo"<div class ='tit5'>Adresse de la rencontre : ".$offre->AdresseDeLaRencontre.", ".$offre->CodePostale."</div> ";
        echo"<div class ='tit5'>Description du plat : "; 
        if ($offre->CommentJeLaiCuisine== null){
            echo "Le donneur n'a pas mis d'autres détails sur son offre";}
        else{
            echo $offre->CommentJeLaiCuisine;}
        echo'</div>';
        echo'<div class="modifierretireroffre"><a class="LienDeroulantTer" href="index.php?name=AnnulerOffreAcceptee&ID='.$offre->id.'">Se retirer sur cette offre</a></div>';
        echo'<div class="modifierretireroffre"><a class="LienDeroulantTer" href="index.php?name=AttribuerRate&ID='.$offre->id.'&Donneur='.$offre->Donneur.'">Noter l\'offre</a></div>';
        echo'<br/>';
        echo'<br/>';
        }
    }
}



/* Fiche de la description des dons qui ont été fait et notés */

function printDescriptionDonsEffectues($dbh,$offres){
    
    /* Si aucun des dons n'a jamais été acceptés */

    if($offres==null){
        echo"<h3 class ='tit4It'>Personne n'a encore accepté un de vos dons</h3>";        
    }
    
    else{
        /* On parcout les offres */
        
        foreach($offres as $offre){
            
            /* On affiche le titre donné au plat */ 
        
            echo"<div class='tit4It'>Le titre du plat : ".$offre->Titre."</div>"; 
            
            /* Puis le receveur du don */
            echo"<div class ='tit5'>Receveur de votre don : <a class='LienDeroulant' href='index.php?name=ProfilUtilisateur&userConsulte=".$offre->Receveur."'>".$offre->Receveur."</a></div>"; 

            /* On recueille l'id de l'offre, puis le rate qui lui a été donné 
             * (qui vaut "l'utilisateur n'a pas encore donné de note sur ce plat si aucun rate n'a été donné) */
            
            $ID = $offre->id;
            $rate = RateOffer::getRate($dbh, $ID);
            echo"<div class ='tit5'>Note reçu sur ce plat : ". $rate."</div>";
            
            /* Puis on récapitule l'adresse qui a été donnée, et la description */
            echo"<div class ='tit5'>Adresse de la rencontre : ".$offre->AdresseDeLaRencontre.", ".$offre->CodePostale."</div> ";
            echo"<div class ='tit5'>Description du plat : "; 
            if ($offre->CommentJeLaiCuisine== null){
                echo "Vous n'aviez pas ajouté de détails";}
            else{
                echo $offre->CommentJeLaiCuisine;}
            echo'</div>';
            echo'<br/>';
            echo'<br/>';
        }
    }
}


/* Fiche descriptives des dons acceptés et notés par l'utilisateur courant */

function printDescriptionOffresConsommees($dbh,$offres){
    
    /* Si aucune offre n'a été acceptée&notée par l'utilisateur courant */ 

    if($offres==null){

        echo"<h3 class ='tit4It'>Vous n'avez jamais accepté de dons</h3>";       
    }
    
    else{
        
        /* On parcourt les offres */
        
        foreach($offres as $offre){
            
            echo"<div class='tit4It'>Le titre du plat : ".$offre->Titre."</div>"; 

            /* On récupère l'id de l'offre, et le rate qui lui a été donné */
            $ID = $offre->id;
            $rate = RateOffer::getRate($dbh, $ID);
            
            echo"<div class ='tit5'>Note donnée sur ce plat : ".$rate."</div>"; 
            
            /* Puis le donneur */
            echo"<div class ='tit5'>Le donneur : <a class='LienDeroulant' href='index.php?name=ProfilUtilisateur&userConsulte=".$offre->Donneur."'>".$offre->Donneur."</a></div>"; 
            
            /* Puis le reste de la description */
            echo"<div class ='tit5'>Adresse de la rencontre : ".$offre->AdresseDeLaRencontre.", ".$offre->CodePostale."</div> ";
            echo"<div class ='tit5'>Description du plat : "; 
            if ($offre->CommentJeLaiCuisine== null){
                echo "Le donneur n'avait pas mis de détails";}
            else{
                echo $offre->CommentJeLaiCuisine;}
            echo'</div>';
            echo'<br/>';
            echo'<br/>';
        }
    }
}






/* Le formulaire d'envoie de message à un interlocuteur préselectionné */
function printEnvoieMessage($destinataire){
    echo'<div class="form-style-5">';   
    echo'<form action="index.php?todo=registermessage&Interlocuteur='.$destinataire.'" method="post">';  
    echo'<div class="Leg0">Envoyer votre message à '.$destinataire.'</div>
    <input type="text" name="titre" placeholder="Objet du message*" required>
    <textarea  type="text" name="message" placeholder="Votre message" required></textarea>
    <input type="submit" value="Envoyer le message" />
    </form>
    </div>';
}





/* Le formulaire de signalement d'une offre */

function printSignalerOffre($id,$utilisateurEnTort){
    echo'<div class="form-style-5">';   
    echo'<form action="index.php?todo=registermessageSignalementOffre&alertmessageenvoye=0&utilisateurEnTort='.$utilisateurEnTort.'&IDoffre='.$id.'" method="post">
    <div class="Legend0">Envoyer votre message à un administrateur</div>
<textarea type="text" name="message" placeholder="Décrivez l\'objet de votre plainte" required></textarea>
<input type="submit" value="Envoyer le message" />
</form>
</div>';
}


/* Le formulaire de signalement d'un utilisateur */

function printSignalerUtilisateur($utilisateurEnTort){
    echo'<div class="form-style-5">';   
    echo'<form action="index.php?todo=registermessageSignalementUtilisateur&alertmessageenvoye=0&utilisateurEnTort='.$utilisateurEnTort.'" method="post">
    <div class="Legend0">Envoyer votre message à un administrateur</div>
<textarea type="text" name="message" placeholder="Décrivez l\'objet de votre plainte" required></textarea>
<input type="submit" value="Envoyer le message" />
</form>
</div>';
}







/* Affiche le contenu d'un message */

function printMessage($dbh,$id){
    
    /* On récupère le message depuis son id */
    $message = Messagerie::getMessageId($dbh,$id);
    
    echo'<div class ="tit3">Message envoyé par <a class="LienDeroulantBig" href="index.php?name=ProfilUtilisateur&userConsulte="'.$message->expediteur.'">'.$message->expediteur.'</a> à '.$message->date.'</div>';
    echo'<br/>';
    echo'<div class ="tit3"><FONT color="#ffffff">Objet du message </FONT>: '.$message->titre.'</div>';
    echo'<br/>';
    echo'<div class ="tit3"><FONT color="#ffffff">Contenu </FONT>: '.$message->message.'</div>';
    echo'<br/>';
    echo'<div><a class="Lienn" href="index.php?todo=markasnonread&id='.$id.'">Marquer comme non-lu</a></div>';
    echo'<div><a class="Lienn" href="index.php?todo=deletemessage&id='.$id.'&alert=0">Supprimer message</a></div>';
}







/* Affiche le formulaire des messages non-lus */

function printMessagerie($dbh,$user,$messagesnonlus){
    
    echo'<div class="form-style-6">

    <div class="toggle">';
    
    /* Première partie : les messages non-lus
    On affiche le nombre de message non-lus en titre */
    echo'<div class="Legend"><span class="number">1</span>Messages non-lus('. count($messagesnonlus).')</div>';

        echo'<div class="more">';
        
        /* Si il n'y a aucun message non-lus, on le dit */
        if($messagesnonlus ==null){
            echo"<div class='tit4'>Vous n'avez aucun nouveau message</div>";
        }
        
        /* Sinon */
        else{
            
            foreach($messagesnonlus as $messagenonlu){
       
                echo'<div class="tit5"><a class="LienDeroulant" href="index.php?todo=consult&Id='.$messagenonlu->id.'">Message</a> envoyé par <a class="LienDeroulant" href="index.php?name=ProfilUtilisateur&userConsulte='.$messagenonlu->expediteur.'">'.$messagenonlu->expediteur.'</a> à '.$messagenonlu->date.' </div>';
                echo'<br/>';
            }
        }

        echo'</div>
    
        <div class="less">
            <div class="modifierretireroffre"><a class="button-read-more button-read LienDeroulant" href="#read">Consulter</a></div>
            <a class="button-read-less button-read LienDeroulant" href="#read">Replier</a>
        </div>

    </div>
    
    <br/>';
    

    /* Deuxième partie, on va recueillir toutes les personnes avec qui l'utilisateur courant a eu une conversation */
    echo'<div class="Legend"><span class="number">2</span>Historique des vos conversations</div>

        <div class="more">';
    
            $users = Utilisateurs::getUsers($dbh);
            foreach($users as $user2){
                if(Messagerie::getConversation($dbh, $user, $user2->Pseudo) !=NULL){
                    echo'<a class="LienDeroulantTer" href="index.php?name=Conversation&Interlocuteur='.$user2->Pseudo.'">'.$user2->Pseudo.'</a> ';
                    echo'<br/>';

                }
            }
    echo'</div>
    <div class="less">
        <div class="modifierretireroffre"><a class="button-read-more button-read LienDeroulant" href="#read">Consulter</a></div>
        <a class="button-read-less button-read LienDeroulant" href="#read">Replier</a>
    </div>

</div>';
    
}





/* Affiche le profil de l'userConsulte */

function printProfil($dbh,$userConsulte){
    echo'<div class="container">
        <header class="page-header">
            <h1 class="t1">Bienvenu sur le profil de '.$userConsulte.'  </h1>
        </header>
        <section class="row">
            <h2 class="tit2">';
            /* On récupère le rate de l'utilisateur */
                $rate=Rate::getRate($dbh,$userConsulte);
                if($rate == null){
                    echo "Cet utilisateur n'a pas encore de rate";
                }
                else{
                    echo "Son rate est de ".$rate;
                }
            echo'</h2>
            <br/><br/>
            <div class ="tit3">Consulter la conversation avec '.$userConsulte.' en cliquant <a class="Lie" href="index.php?name=Conversation&Interlocuteur='.$userConsulte.'"> ici</a></div>'; 
            echo'<br/><br/>    
            <div class="toggle">

                <div class="more">';
                printEnvoieMessage($userConsulte);
                echo'</div>
    
                <div class="less">
                    <a class="button-read-more button-read Lienn" href="#read">Cliquer ici pour envoyer un message </a>
                    <a class="button-read-less button-read Lienn" href="#read">Replier</a>
                </div>';
            echo'</div>
        </div>
    </div>';
}






/* Affiche le double bouton oui/non de confirmation de l'annulation de l'offre */

function printOuiNonForm($id,$titre,$date,$quantite,$adresse,$code){
    echo'<div class="form-style-5">   
    <form action="index.php?todo=withdrawoffer&ID='.$id.'&offresupprimee=0" method="post">
    <input type="submit" value="Oui" /></form>
    <form action="index.php?name=ModifierRetirerOffre&ID='.$id.'&Titre='.$titre.'&Date='.$date.'&Quantite='.$quantite.'&Adresse='.$adresse.'&CodePostal='.$code.'
" method="post">
    <input type="submit" value="Non" /></form>
    </div>';
}
?>


