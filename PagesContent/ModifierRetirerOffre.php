<div class="ModifierOffre"><br/><br/><br/><br/><br/>

<?php /* D'abord, on vérfie que l'utilisateur courant est bien propriétaire de l'offre */
if(isset($_GET['ID'])){
    $offre = Offres::offreId($dbh, $_GET['ID']);
    if($offre != null){
        if($_SESSION['Pseudo'] == $offre->Donneur){
            
        /* Dans le cas normal, on peut donc montrer le formulaire normalement */
?>

<div class="form-style-5">
    
    <?php echo '<form id="myform" action="index.php?todo=modifyoffer&ID='.$_GET['ID'].'" method="post">';?>


<div class='Legend'><span class="number">1</span> Description du plat</div>

<p><input name="titre" data-progression type="text" data-helper="Donnez un titre (apétissant?) à votre plat" <?php if(isset($_GET['Titre'])){ echo 'value = "'.$_GET['Titre'].'" ';} ?> placeholder="Le nom de votre plat *" required></p>
        
<p><input name="date" data-progression type="date" data-helper="Indiquez la date de péremption de votre plat... que les utilisateurs soient au courant!!" <?php if(isset($_GET['Date'])){ echo 'value = "'.$_GET['Date'].'" ';} ?> required></p>

<p><select name="Quantite" data-progression data-helper="Combien de personnes votre plat peut-il repaître?">
<optgroup label="Nombre de personnes?">
                    <option value = '1'>1 personne</option>
                    <option value = '2'>2 personnes</option>
                    <option value = '3'>3 personnes</option>
                    <option value = '4'>4 personnes</option>
                    <option value = '5'>5 personnes</option>
                    <option value = '6'>6 personnes</option>
                    <option value = '7'>7 personnes</option>
                    <option value = '8'>8 personnes</option>
                    <option value = '9'>9 personnes</option>
                    <option value = '10'>10 personnes</option>
</optgroup>
</select></p>

<?php               echo'<p><select name="Ali" data-progression  data-helper="Quel est l aliment principal de votre recette?">';                    
                    echo'<optgroup label="Mon ingrédient phare est: ">';
                    echo'<optgroup label="Les féculents: ">';
                        foreach ($feculents as $fec){
                            echo'<option value = "'.$fec.'">'.$fec.'</option>';
                        }   
                        echo'</optgroup>';
                        echo'<optgroup label="Les fruits: ">';
                        foreach ($fruits as $Fr){
                            echo'<option value = "'.$Fr.'">'.$Fr.'</option>';
                        }
                        echo'<optgroup label="Les légumes: ">';
                        foreach ($legumes as $leg){
                            echo'<option value = "'.$leg.'">'.$leg.'</option>';
                        }
                        echo'<optgroup label="Les laitages: ">';
                        foreach ($laitage as $lait){
                            echo'<option value = "'.$lait.'">'.$lait.'</option>';
                        }
                        echo'<optgroup label="Les sucreries: ">';
                        foreach ($sucreries as $suc){
                            echo'<option value = "'.$suc.'">'.$suc.'</option>';
                        }
                        echo'<optgroup label="Les viandes: ">';
                        foreach ($viande as $vi){
                            echo'<option value = "'.$vi.'">'.$vi.'</option>';
                        }
                        echo'<optgroup label="Les poissons: ">';
                        foreach ($poisson as $po){
                            echo'<option value = "'.$po.'">'.$po.'</option>';
                        }
                        echo'<optgroup label="Autres: ">';
                        foreach ($autre as $aut){
                            echo'<option value = "'.$aut.'">'.$aut.'</option>';
                        }  
    echo'</optgroup>';                    
    echo'</select></p>';
?>

<p><textarea name="descriptionDuPlat" data-progression  data-helper="Une belle description du plat donnera plus envie aux utilisateurs"  placeholder="Comment avez-vous cuisiné le plat?" ></textarea></p>

      
<div class='Legend'><span class="number">2</span> Le lieu de la rencontre</div>

<p><input name="adresse" data-progression type="text" data-helper="Inscrivez soigneusement l'adresse où vous souhaitez échanger : on pourra inscrire précisemment sur notre map" <?php if(isset($_GET['Adresse'])){ echo 'value = "'.$_GET['Adresse'].'" ';} ?> placeholder="Votre Adresse*" required></p>
<p><input name="codePostal" data-progression type="number" data-helper="On rappelle que seul l'île-de-France est acceptée" <?php if(isset($_GET['CodePostal'])){ echo 'value = "'.$_GET['CodePostal'].'" ';} ?> placeholder="Votre code postal*" required></p>
<p><input name="numeroDeTel" data-progression type="number" data-helper="Votre numéro de téléphone ne sera jamais révélé publiquement sur notre site" <?php if(isset($_GET['numeroDeTel'])){ echo 'value = "'.$_GET['numeroDeTel'].'" ';} ?> placeholder="Envie de laissez votre numéro de téléphone?" ></p>
       
<input type="submit" value="Modifier l'offre" />

</form>

<?php 
if(isset($_GET['Titre']) && isset($_GET['ID']) && isset($_GET['Date']) && isset($_GET['Quantite']) && isset($_GET['Adresse']) && isset($_GET['CodePostal'])){
echo'<form id="myform" action ="index.php?name=EtesVousSurDeSuppimerOffre&ID='.$_GET['ID'].'&Titre='.$_GET['Titre'].'&Date='.$_GET['Date'].'&Quantite='.$_GET['Quantite'].'&Adresse='.$_GET['Adresse'].'&CodePostal='.$_GET['CodePostal'].'" method="post">';
}
?>

<br/>
<div class='Legend'><span class="number">3</span>Annuler l'offre</div>
<input type="submit" value="Supprimer votre offre" />

</form>
</div>

<?php 

/* On oublie pas de fermer nos accolades d'en haut */
        }
    }
}
?>
<br/><br/><br/><br/><br/>
</div>

                


