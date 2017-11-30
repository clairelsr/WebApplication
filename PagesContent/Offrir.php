<div class='backimageOffrir'>
    
    <br/><br/><br/>
    <div class="form-style-5">
    
        <form id="myform" action="index.php?todo=registeroffer" method="post">


            <div class='Legend'><span class="number">1</span> Description du plat</div>

            <p><input name="Titre" data-progression type="text" data-helper="Donnez un titre (apétissant?) à votre plat" <?php if(isset($_POST['Titre'])){echo'value="'.$_POST['Titre'].'"';} ?> placeholder="Le nom de votre plat *" required></p>

            <p><input name="Date" data-progression type="date" data-helper="Indiquez la date de péremption de votre plat... que les utilisateurs soient au courant!!" <?php if(isset($_POST['Date'])){echo'value="'.$_POST['Date'].'"';} ?>  required></p>

            <p><select name="quantite" data-progression data-helper="Combien de personnes votre plat peut-il repaître?" >
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

<?php       echo'<p><select name="Ali" data-progression  data-helper="Quel est l\'ingrédient principal de votre recette?">';                    
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
                echo'</optgroup>';
                      
                echo'<optgroup label="Les légumes: ">';
                    foreach ($legumes as $leg){
                        echo'<option value = "'.$leg.'">'.$leg.'</option>';
                    }
                echo'</optgroup>';
                        
                echo'<optgroup label="Les laitages: ">';
                    foreach ($laitage as $lait){
                        echo'<option value = "'.$lait.'">'.$lait.'</option>';
                    }
                echo'</optgroup>';
                
                echo'<optgroup label="Les sucreries: ">';
                    foreach ($sucreries as $suc){
                        echo'<option value = "'.$suc.'">'.$suc.'</option>';
                    }
                echo'</optgroup>';
                        
                echo'<optgroup label="Les viandes: ">';
                    foreach ($viande as $vi){
                        echo'<option value = "'.$vi.'">'.$vi.'</option>';
                    }
                echo'</optgroup>';
                        
                echo'<optgroup label="Les poissons: ">';
                    foreach ($poisson as $po){
                        echo'<option value = "'.$po.'">'.$po.'</option>';
                    }
                echo'</optgroup>';
                
                echo'<optgroup label="Autres: ">';
                    foreach ($autre as $aut){
                        echo'<option value = "'.$aut.'">'.$aut.'</option>';
                    }
                echo'</optgroup>';
                
            echo'</select></p>';
?>
            <p><textarea name="DescriptionDuPlat" data-progression data-helper="Une belle description du plat donnera plus envie aux utilisateurs" <?php if(isset($_POST['DescriptionDuPlat'])){echo'value="'.$_POST['DescriptionDuPlat'].'"';} ?>  placeholder="Comment avez-vous cuisiné le plat?" ></textarea></p>

      
            <div class='Legend'><span class="number">2</span> Le lieu de la rencontre</div>

            <p><input name="Adresse" data-progression type="text" data-helper="Inscrivez soigneusement l'adresse où vous souhaitez échanger : on pourra vous placer précisemment sur notre map" <?php if(isset($_POST['Adresse'])){echo'value="'.$_POST['Adresse'].'"';} ?>  placeholder="Votre Adresse*" required></p>

            <p><input name="CodePostal" data-progression type="number" data-helper="On rappelle que seul l'île-de-France est acceptée" <?php if(isset($_POST['CodePostal'])){echo'value="'.$_POST['CodePostal'].'"';} ?>  placeholder="Votre code postal*" required></p>

            <p><input name="NumeroDeTel" data-progression type="number" data-helper="Votre numéro de téléphone sera visible pour les utilisateurs acceptant vos dons" <?php if(isset($_POST['NumeroDeTel'])){echo'value="'.$_POST['NumeroDeTel'].'"';} ?>  placeholder="Envie de laissez votre numéro de téléphone?" ></p>
       
            <p class='conditionutilisation'><input type="checkbox" data-progression data-helper="Cochez cette case pour confirmer que vous n'êtes pas un robot" id="check1" /> Je ne suis pas un robot</p>

            <input type="submit" value="Submit" onClick="gBox('check1'); return false;"/>


        </form>

    </div>
    <br/><br/><br/>
    <br/><br/><br/>
</div>
    

                
