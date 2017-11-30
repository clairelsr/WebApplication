<div class="EtesVousSurDeSuppimerOffre">
    
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

<?php 
if(isset($_GET['ID']) && isset($_GET['Titre']) && isset($_GET['Date']) && isset($_GET['Quantite']) && isset($_GET['Adresse']) && isset($_GET['CodePostal'])){
    printOuiNonForm($_GET['ID'],$_GET['Titre'],$_GET['Date'],$_GET['Quantite'],$_GET['Adresse'],$_GET['CodePostal']);
}
?>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>