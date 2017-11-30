<div class="container">
      <header class="page-header">

        <h1 class='t1'>Bienvenu sur la page de votre profil </h1>
      </header>
      <section class="row">
        
    <h2 class='tit2'>
    <?php 
    $rate=Rate::getRate($dbh, $_SESSION['Pseudo']);
    if($rate == null){
        echo "Vous n'avez pas encore de rate";
    }
    else{
        echo "Votre rate est actuellement de ".$rate;
    }
    ?>
    </h2>
    
    
    
    <h2 class = 'tit2'>Consulter votre historique des offres<a class="Li" href="index.php?name=HistoriqueOffres">   ici</a> </h2>
        
    <h2 class = 'tit2' >Vos conversations <a class="Li" href="index.php?name=MonProfilMessagerie">ici</a> </h2>

    <h2 class = 'tit2' >Vos informations personnelles <a class="Li" href="index.php?name=MonProfilInformationsPersonnelles">ici</a> </h2>

      </section>