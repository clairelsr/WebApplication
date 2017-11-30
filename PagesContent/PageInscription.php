<h1 class='tit3'>1. Consultez les conditions d'utilisation <a class = "LienDeroulantBig" href="index.php?name=ConditionsUtilisation"> ici</a></h1>
<br/>
<br/>

<h1 class='tit3'>2. Remplissez le formulaire d'inscritpion</h1>
<br/>
<br/>
<div class="PageInscription"><br/><br/><br/><br/><br/><br/>
<div class="form-style-5" >

	<form id="myform" action="index.php?todo=register" method="post">
            
<div class='Legend'><span class="number"></span> Inscris-toi</div>

            <p><input name="loginInscription" data-progression type="text" data-helper="Choisissez votre pseudo, vous serez identifié par celui-ci : choisissez-le bien" <?php if(isset($_POST['loginInscription'])){echo 'value="'.$_POST['loginInscription'].'"';}?> placeholder="Votre pseudo *" required></p>
            <p class="left"><input name="mdpInscription1" data-progression data-helper="Choisissez votre mot de passe... pas trop simple! (Au moins 10 caractères" type="password"   placeholder="Votre Mot de Passe *" required=""></p>
            <p class="right"><input name="mdpInscription2" data-progression data-helper="Confirmez votre mot de passe" type="password"  placeholder="Confirmez votre Mot de Passe *" required=""></p>
            <p><input name="prenom" data-progression data-helper="Inscrivez correctement vos patronimes..." type="text" <?php if(isset($_POST['prenom'])){ echo 'value="'.$_POST['prenom'].'"';}?>  placeholder="Votre prénom *" required=""></p>
            <p><input name="nom" data-progression data-helper="...afin de faciliter le dialogue avec les autres utilisateurs" type="text" <?php if(isset($_POST['nom'])){ echo 'value="'.$_POST['nom'].'"';}?>  placeholder="Votre nom *" required=""></p>
            <p><input name="email" data-progression data-helper="Votre adresse mail nous servira à vous envoyer des notifications concernant les offres... jamais à envoyer de la pub!" type="email" <?php if(isset($_POST['email'])) {echo 'value="'.$_POST['email'].'"';}?> placeholder="Votre email *" required></p>
            <p><input name="link" data-progression data-helper="Une page facebook sert toujours" type="url"  <?php if(isset($_POST['link'])){ echo 'value="'.$_POST['link'].'"';}?>  placeholder="Votre profil fb?"></p>
            <p class='conditionutilisation'><input type="checkbox" data-progression data-helper="N'oubliez pas de consulter nos conditions d'utilisation" id="check1" /> J'accepte les conditions d'utilisation</p>
            <input type="submit" value="Apply" onClick="gBox('check1'); return false;"/>
        </form>
</div>
    <br/><br/><br/><br/><br/><br/>
</div>
   



