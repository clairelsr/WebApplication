<?php

if(isset($_GET['Id'])){
    
    /* On vérifie que le message en question existe */
    $message = Messagerie::getMessageId($dbh,$_GET['Id']);
    
    if($message != null){
        
        /* On vérifie que l'utilisateur courant est effectivement le recepteur du message */
        
        if($_SESSION['Pseudo'] == $message->recepteur){
            
        
            printMessage($dbh,$_GET['Id']);
        
            $destinataire = $message->expediteur;
?>

<div class="toggle">


    <div class="more">
        <?php  printEnvoieMessage($destinataire); ?>
    </div>
    <div class="less">
        <div class="modifierretireroffre LienDeroulant"><a class="button-read-more button-read LienDeroulant" href="#read">Répondre instantanément</a></div>
        <a class="button-read-less button-read LienDeroulant" href="#read">Replier</a>
    </div>
</div>


<?php 
}}}
?>

