<div class="OffreSelectionne"> <br/><br/><br/><br/><br/><br/>

<?php
    /* D'abord, on récupère les données relatives à l'offre sélectionnée */
    if(isset($_GET['ID']) ||isset($_SESSION['loggedInAdmin']) ){
        
        /* Côté utilisateur, on récupère l'ID via l'url */
        if(isset($_GET['ID'])){
            $ID = $_GET['ID'];
        }
        
        /* Côté admin, on récupère l'ID via le formulaire de recherche */
        if(isset($_SESSION['loggedInAdmin'])){
            if(isset($_POST['IDrecherchee'])){
               $ID = $_POST['IDrecherchee'];
            }
        }   
         
        
        
        /* On vérifie que l'offre séléctionnée existe bien */
        
        $offre = Offres::offreId($dbh, $ID);
        if($offre == null){
        }
        else{
            
            /* Et qu'elle est encore disponible */
            
            if($offre->Etat){

                $pseudoDonneur = Offres::getDonneurId($dbh,$ID);



    

?>
<div class="form-style-6">
    
    <?php
    echo'<form id="myform" action="index.php?todo=accepteroffre&ID='.$ID.'&Donneur='.$pseudoDonneur.'" method="post">';
    ?>


<div class='Legend'><span class="number">1</span> Description du plat</div>
<div class ='tit2It'>Titre du plat : <?php echo Offres::getTitreId($dbh,$ID)?></div> 
<div class ='tit4'>Nombre de personnes pouvant manger sur ce plat : <?php echo Offres::getQuantite($dbh,$ID)?></div> 
<div class ='tit4'>Date limite de consommation : <?php echo Offres::getDateLimiteDeConsommationId($dbh,$ID)?></div> 
<div class ='tit4'>Adresse de la rencontre: <?php echo Offres::getAdresse($dbh,$ID).", ".Offres::getCodePostale($dbh,$ID)?></div> 
<div class ='tit4'>Description du plat : 
    <?php if  (Offres::getDescriptionPlat($dbh,$ID) == null){
    echo "Le donneur n'a pas mis d'autres détails sur son offre";}
          else{
              echo Offres::getDescriptionPlat($dbh,$ID);
          }
    ?>
</div> 
<br/>   

<div class='Legend'><span class="number">2</span> Le donneur</div>

<div class ='tit4'>Pseudo : <?php echo'<a class="LienDeroulantMid" href="index.php?name=ProfilUtilisateur&userConsulte='.Offres::getDonneurId($dbh,$ID).'">'.Offres::getDonneurId($dbh,$ID).'</a> ';?>
</div>
<div class ='tit4'>Rate : 
    <?php 
    if(Rate::getRate($dbh,$pseudoDonneur)==null){
        echo $pseudoDonneur." n'a pas encore de rate";
    }
    else{
        echo Rate::getRate($dbh,$pseudoDonneur);
    }
    ?>
</div> 
<div class ='tit4'>Email : <?php echo Utilisateurs::getMailUtilisateur($dbh,$pseudoDonneur)?></div> 
<div class ='tit4'>Numéro de téléphone : 
    <?php if  (Offres::getNumeroId($dbh,$ID) == null){
    echo "Le donneur n'a pas mis son numéro de téléphone";}
          else{
              echo Offres::getNumeroId($dbh,$ID);
          }
    ?>
</div>
<br/>     

<input type="submit" value="Accepter l'offre" />

</form>
</div>

<?php 

/* Du côté de l'utilisateur normal, on propose un bouton de signalement de l'offre */
if(!isset($_SESSION['loggedInAdmin'])){
    echo'<a class="LienReport" href="index.php?name=Report&nature=offre&ID='.$ID.'&utilisateur='.$pseudoDonneur.'">Signaler cette offre</a>';
}

/* Du côté de l'admin, on propose un bouton pour supprimer l'offre */
if(isset($_SESSION['loggedInAdmin'])){
    echo'<a class="LienReport" href="index.php?todo=withdrawoffer&ID='.$ID.'">Supprimer cette offre</a>';

}
    }
    }
    }
    ?> 
    
<br/><br/><br/><br/><br/><br/><br/><br/>

</div>


