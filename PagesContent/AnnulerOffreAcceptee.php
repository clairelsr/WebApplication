<div class='recapitulatifoffre'>Récapitulatif de l'offre</div>
<br/><br/>

<div class ='annulerOffre'>
<br/><br/><br/><br/>

<?php
    /* On vérifie qu'effectivement une ID est dans l'url */
    if(isset($_GET['ID'])){
        $ID = $_GET['ID'];
        
        /* Puis qu'elle correspond à une offre existante */
        $offre = Offres::offreId($dbh, $ID);
        
        
        
        if($offre != null){
                         
            
            $pseudoDonneur = $offre->Donneur;
            $pseudoReceveur = $offre->Receveur;
            
            
        
        
            /* On vérifie que le receveur de l'offre est bien l'utilisateur courant */ 
            
            if($_SESSION['Pseudo'] == $pseudoReceveur){
                printRecapitulatifOffre($dbh,$ID,$pseudoDonneur);
            }
        }
        
    }
?>
<br/><br/><br/><br/>


</div>




