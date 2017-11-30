<p>N'oubliez pas d'aller noter le plat en consultant <a class="Lienn" href="index.php?name=HistoriqueOffres">l'historique des offres</a> </p>


<br/><br/>

<div class="toggle">


    <div class="more">
        <?php 
        if (isset($_GET['Donneur'])){
            printEnvoieMessage($_GET['Donneur']);
        }
        ?>
    </div>
    <div class="less">
        <a class="button-read-more button-read Lienn" href="#read">Cliquer ici pour envoyer un message au donneur</a>
        <a class="button-read-less button-read Lienn" href="#read">Replier</a>
    </div>
