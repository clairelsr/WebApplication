<div class="container">
      <header class="page-header">

        <h1 class='t1'>Récapitulatif de vos informations personnelles </h1>
      </header>
      <section class="row">
        <div class="col-lg-12">      
    
    <h2 class='tit3'>Monsieur 
    <?php
        echo $_SESSION['Prenom']. ' '.  $_SESSION['Nom'];
       
    ?>
    </h2>
    
    <h2 class='tit3'>Votre pseudo est <?php echo $_SESSION['Pseudo'];?> </h2>
    
    
    <h2 class='tit3'><a class="Lie" href="index.php?name=MonProfilChangePassword"> Modifier</a> votre mot de passe?</h2>
        

    
     <h2 class='tit3'><a class="Lie" href="index.php?name=MonProfilDeleteUser"> Supprimer</a> votre compte?</h2>
        

      </section>
