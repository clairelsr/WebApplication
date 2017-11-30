<?php
/* Classe associée au rate individuel donnée à une offre */

Class RateOffer{
    public $IdOffre;
    public $rate;

/* Associe une note à l'offre id */     
    public static function initialiserRate($dbh, $id,$note){
        $query = "INSERT INTO `RateOffer`(`IdOffre`, `rate`) VALUES (?,?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id,$note));            
    }

/* Renvoie la note associée à l'offre repérée par son id, ou un message indiquant que le plat n'a pas encore été noté */    
    public static function getRate($dbh,$id){
        $query = "SELECT * FROM `RateOffer` WHERE IdOffre=? ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'RateOffer');
        $sth->execute(array($id));
        $rate = $sth->fetch();
        $sth->closeCursor();
        if($rate !=null){
           return $rate->rate;
        }
        else{
            return "Le receveur n'a pas encore noté votre plat";
        }
    }
    
}

?>