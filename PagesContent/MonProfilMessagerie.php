<div class="Messagerie"><br/><br/><br/><br/><br/><br/>
<?php
/* Lorsqu'on supprime un message qu'on consulte, on est renvoyé sur cette page, en recevant une alerte */
if(isset($_GET['alert'])){    echo'<script> alert("Message supprimé")</script>';}
if(isset($_GET['alertmessageenvoye'])){ echo'<script>alert("Message envoyé!")</script>';}

/* On recueille l'ensemble des messages reçus par l'utilisateur courant */
$messagesrecus = Messagerie::getMessagesRecus($dbh, $_SESSION['Pseudo']);

/* , puis on sélectionne ceux qu'il n'a pas lu. Si $messagerecus est null, $messagesnonlus aussi */
if($messagesrecus == null){
    $messagesnonlus = null;
}
else{
    $messagesnonlus= detecterMessagesNonLus($messagesrecus); 
}
    

/* Puis on affiche le formulaire de messagerie */ 

printMessagerie($dbh,$_SESSION['Pseudo'],$messagesnonlus);

?>

<br/><br/><br/><br/><br/><br/>
</div>

    



