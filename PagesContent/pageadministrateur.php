<?php 
if(!isset($_SESSION['loggedInAdmin'])){

    echo'<div class="form-style-5">   
    <form action="index.php?todo=checkadmin" method="post">  
<fieldset>
<div class="Legend"><span class="number">X</span>Veuillez entrer votre mdp</div>
<input type="password" name="mdpadmin" placeholder="mdp*" required>
<input type="password" name="mdpadminbis" placeholder="Confirmez mdp*" required>
</fieldset>

<input type="submit" value="Entrer dans l\'antre de l\'admin" />
</form>
</div>';
}
else{
    if(isset($_GET['alert'])){    echo'<script> alert("Message supprimé")</script>';}
$messages = Messagerie::getMessagesRecus($dbh, $_SESSION['Pseudo']);
if($messages!=null){
    $messagesnonlus= detecterMessagesNonLus($messages); 
    printMessagerie($dbh,$_SESSION['Pseudo'],$messagesnonlus);
}else{
    echo"Vous n'avez pour l'instant envoyé/reçu aucun message!";
}
?> 
<div class="form-style-5">   
    <form action="index.php?name=OffreSelectionne" method="post">  
        <div class='Legend'><span class="number">3</span>Entrer l'ID de l'offre recherchée</div>
        <input type="text" name="IDrecherchee" placeholder="ID" required>
        <input type="submit" value="rechercher offre" />
    </form>
    
    <form action="index.php?name=ProfilUtilisateur" method="post">  
        <div class='Legend'><span class="number">4</span>Entrer l'utilisateur recherché</div>
        <input type="text" name="userConsulteParAdmin" placeholder="user" required>
        <input type="submit" value="rechercher l'utilisateur" />
    </form>
    
</div>

<?php } ?>
   