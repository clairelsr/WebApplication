<?php 

/* La page de conversation entre deux utilisateurs */



/* Lorsqu'un nouveau message a été envoyé, une petite alerte apparaît juste avant de renvoyer sur la conversation */ 
if(isset($_GET['alertmessageenvoye'])){
    echo'<script>alert("Message envoyé!")</script>';
}

if (isset($_GET['Interlocuteur'])){

    /* D'abord on vérifie que l'utilisateur sélectionné existe effectivement */

    $user = Utilisateurs::getUtilisateur($dbh, $_GET['Interlocuteur']);

    if($user == null){
        echo'<div class="container">
        <header class="page-header">

        <h1 class="t1"> Nous n\'avons pas trouvé d\'utilisateur dont le pseudo est '.$_GET['Interlocuteur'].'</h1>
        </header>
        <br/>'; 
    }   

    /* Puis */ 

    else{
    
    /* Titre */
    echo'<div class="container">
        <header class="page-header">
        <h1 class="t1"> Conversation avec  '.$_GET['Interlocuteur'].'</h1>
        </header>
        <section class="row">
        <br/>';

    /* Envoyer un nouveau message */
    echo'<div class="toggle">

        <div class="more">';
            printEnvoieMessage($_GET["Interlocuteur"]);
        echo'</div>
        <div class="less">
            <a class="button-read-more button-read LienDeroulant" href="#read">Envoyer un nouveau message à '.$_GET['Interlocuteur'].'</a>
            <a class="button-read-less button-read LienDeroulant" href="#read">Replier</a>
        </div><br/><br/>';
    
    

    /* Maintenant la conversation en tant que telle */    


    /* D'abord, si aucun message n'a été échangé entre les 2 interlocuteurs, on le dit*/    
    if(Messagerie::getConversation($dbh, $_SESSION['Pseudo'], $_GET['Interlocuteur']) == null){
        echo "<h3 class='tit3'>Vous n'avez pas encore de conversation avec ". $_GET['Interlocuteur']."</h3>";
    }



    /* Sinon, on récupère tous les messages échangés, par date décroissante */
    else{
        foreach(Messagerie::getConversation($dbh, $_SESSION['Pseudo'], $_GET['Interlocuteur']) as $message){
        
            /* D'abord on ne sélectionne pas les messages non-lus par l'utilisateur courant, qui sont dans les non-lus */
            if($message->Lu == "oui" || $message->expediteur == $_SESSION['Pseudo']){
        
            /* Pour cette classe de messages : */    
                        
                /* Si l'expéditeur est l'utilisateur, on place le message à droite. Dans le cas contraire, à gauche */
                if($message->expediteur == $_SESSION['Pseudo']){
                    echo'<div class="messageMoi">';
                }
                else{
                    echo'<div class="messageToi">';
                }
        
                /* On fait la présentation suivante : seul le contenu de message apparaît sur la page. Si on clique dessus
                toutesles caractéristiques apparaissent*/
        
                    echo '<div class="toggle">
                        <div class="more">';
            
                        /* Le contenu quand on clique sur le message */
            
                
                            echo'<div class = "compartiment">'; 
                
                                /* Le titre */
                
                                echo'<h5 class="tit5"> Message envoyé par <a class="Lienn" href="index.php?name=ProfilUtilisateur&userConsulte='
                                .$message->expediteur.'">'. $message->expediteur.'</a> 
                                à '.$message->date.': '; 
            
                                /* Si l'interlocuteur n'a pas lu le message, on l'indique */
                                if($message->Lu == "non"){
                                    echo "( ".$_GET['Interlocuteur']." n'a pas encore vu ce message)";                
                                }
                                echo'</h5>';
                
                                /* Puis l'objet et le contenu du message */
            
                                echo'<div class="messageContenu">';
                                echo'<FONT color="#ffffff">Objet du message: </FONT>'.$message->titre;
                                echo'<br/>';
                                echo'<FONT color="#ffffff">Contenu: </FONT>: '.$message->message;
            
                                echo'</div>';
                            
                            echo'</div>';
                        
                        echo'</div>';
                        
                        /* Ce qui apparaît avant que l'on clique sur le message */
                        echo '<div class="less">';
                        
                            /* Si l'expéditeur est l'utilisateur courant, le texte est en bleu, sinon, en noir */
                            if($message->expediteur == $_SESSION['Pseudo']){
                                echo'<a class="button-read-more button-read LienDeroulant" href="#read">'.$message->message.'</a>';
                            }
                        
                            else{
                                echo'<a class="button-read-more button-read LienDeroulantBis" href="#read">'.$message->message.'</a>';
                            }
                            echo'<a class="button-read-less button-read LienDeroulant" href="#read">Replier</a>
                        </div>';
                        
                    echo'</div>';
                
                echo'</div>';
        
            }

        }
    }
}
}
?>


