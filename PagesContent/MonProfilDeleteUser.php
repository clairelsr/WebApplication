<div class="form-style-5">
    
    <form id="myform" action="index.php?todo=deleteuser&comptesupprime=0" method="post">


<div class='Legend'><span class="number"></span> Se désinscrire</div>

<p><input name="logindesinscription" data-progression type="text" data-helper="MORT À" <?php if(isset($_POST['logindesinscription'])){echo'value="'.$_POST['logindesinscription'].'"';} ?> placeholder="Votre login *" required></p>
<p><input name="mdpdesinscription1" data-progression type="password" data-helper="MORT À"  placeholder="Mot de passe*" required></p>
<p><input name="mdpdesinscription2" data-progression type="password" data-helper="MORT À"  placeholder="Confirmez votre mot de passe *" required></p>
<p><textarea name="raisonDepart" data-progression data-helper="MORT À" <?php if(isset($_POST['raisonDepart'])){echo'value="'.$_POST['raisonDepart'].'"';} ?> placeholder="Pourquoi souhaitez-vous nous quitter?" ></textarea></p>


<input type="submit" value="Apply" />
</form>
</div>
    <!-- Ci-dessous, le form à compléter pour changer de mot de passe. 
    Une fois validée, on est redirigée vers la page ApresModificationMDP. L'utilisateur sera enregistré si aucun problème n'est apparu --> 
    
    

