<?php
    if(isset($_GET['utilisateur'])){
        
        /* Le cas d'un report d'une offre */
        if(isset($_GET['ID']) && isset($_GET['nature']) && $_GET['nature'] == "offre"){
            printSignalerOffre($_GET['ID'],$_GET['utilisateur']);
        }
        
        /* Le cas d'un report d'utilisateur */
        
        if(isset($_GET['nature']) && $_GET['nature'] == "utilisateur"){
            printSignalerUtilisateur($_GET['utilisateur']);
        }
    }
?>

