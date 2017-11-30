<!-- Ci-dessous, le form à compléter pour changer de mot de passe. 
    Une fois validée, on est redirigée vers la page ApresModificationMDP. L'utilisateur sera enregistré si aucun problème n'est apparu --> 
<div class="form-style-5">   
    <form action="index.php?todo=changemdp" method="post">  
<fieldset>
<div class='Legend4'><span class="number"></span> Modification de votre mot de passe</div>
<input type="password" name="ancienmdp" placeholder="Ancien mdp*" required>
<input type="password" name="nouvmdp" placeholder="Nouveau mdp*" required>
<input type="password" name="nouvmdpbis" placeholder="Confirmer le nouveau mdp*" required>
</fieldset>

<input type="submit" value="Modifier" />
</form>
</div>
    

