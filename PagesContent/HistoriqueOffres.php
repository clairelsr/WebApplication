

<?php

/* Lorsqu'on note, supprime ou retire une offre, un message d'alerte est envoyé, avant d'être renvoyé sur la page d'historique */
if(isset($_GET['offrenotee'])){ echo'<script> alert("Votre note a bien été prise en compte")</script>';}
if(isset($_GET['offresupprimee'])){ echo'<script> alert("Votre offre a été supprimée")</script>';}
if(isset($_GET['retire'])){ echo'<script> alert("Vous vous êtes retirés de l\'offre")</script>';}

?>
<div class="HistoriqueDons">
    <br/><br/><br/>    <br/><br/><br/>


<div class="form-style-6 ">
    
    
<!-- Les dons que l'utilisateur courant a effectué, qui n'ont pas encore été acceptés -->
    
<div class="toggle">

    
<div class='Legend'><span class="number">1</span> Vos dons en cours</div>
    <div class="more">
        <?php 
        /* D'abord, on recueille les dons que l'utilisateur a fait, mais qui n'ont pas encore été accepté
           Puis, on affiche leur fiche descriptive
         */
        printDescriptionDonsEnCours(Offres::getHisoriqueDonneurEnCours($dbh, $_SESSION['Pseudo'])); 
        ?>
    </div>
    <div class="less">
        <div class='modifierretireroffre'><a class="button-read-more button-read LienDeroulant" href="#read">Dérouler</a></div>
        <a class="button-read-less button-read LienDeroulant " href="#read">Replier</a>
    </div>

</div>


<!-- Les dons que l'utilisateurs a accepté, et qu'il doit encore noter -->

<div class="toggle">

<div class='Legend'><span class="number">2</span>Offres à noter</div>

    <div class="more">
        <?php 
        /* D'abord, on recueille les dons que l'utilisateur a accepté, mais pas encore noté
           Puis, on affiche leur fiche descriptive
         */
        printDescriptionOffresEnCours(Offres::getHisoriqueReceveurEnCours($dbh, $_SESSION['Pseudo'])); 
        ?>

    </div>
    <div class="less">
        <div class='modifierretireroffre'><a class="button-read-more button-read LienDeroulant" href="#read">Dérouler</a></div>
        <a class="button-read-less button-read LienDeroulant" href="#read">Replier</a>
    </div>

</div>




<!-- Les dons que l'utilisateur a fait, que quelqu'un a accepté -->

<div class="toggle">

<div class='Legend'><span class="number">3</span>Historique de dons</div>

    <div class="more">
        <?php 
        /* D'abord, on recueille les dons que l'utilisateur a fait, et qui ont été acceptés
           Puis, on affiche leur fiche descriptive
         */
        printDescriptionDonsEffectues($dbh, Offres::getHisoriqueDonneurOver($dbh, $_SESSION['Pseudo']));
        ?>
    </div>
    <div class="less">
        <div class='modifierretireroffre'><a class="button-read-more button-read LienDeroulant" href="#read">Dérouler</a></div>
        <a class="button-read-less button-read LienDeroulant" href="#read">Replier</a>
    </div>

</div>



<!-- Les dons que l'utilisateur a accepté, et notés!-->

<div class="toggle">

<div class='Legend'><span class="number">4</span>Offres notées</div>

    <div class="more">
        <?php 
        /* D'abord, on recueille les dons que l'utilisateur a accepté et qu'il a noté
           Puis, on affiche leur fiche descriptive
         */
        printDescriptionOffresConsommees($dbh,Offres::getHisoriqueReceveurOver($dbh, $_SESSION['Pseudo']));
        ?>
    </div>
    <div class="less">
        <div class='modifierretireroffre'><a class="button-read-more button-read LienDeroulant" href="#read">Dérouler</a></div>
        <a class="button-read-less button-read LienDeroulant" href="#read">Replier</a>
    </div>

</div>
</div>
        <br/><br/><br/>    <br/><br/><br/>

</div>    



