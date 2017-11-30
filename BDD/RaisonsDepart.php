<?php
/* Classe associée à la table qui recense les raisons de départ que peuvent donner les utilisateurs */

Class RaisonsDepart {
    public $Raison;
    
    public static function insererRaison($dbh, $raison) {
        $sth = $dbh->prepare("INSERT INTO RaisonsDepart VALUES(?)");
        $sth->execute(array($raison));
    }    
}        
?>