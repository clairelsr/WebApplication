<?php
/*Classe associée au rate d'un utilisateur */

Class Rate{
    public $PseudoUtilisateur; /*Clé PRIMARY*/
    public $NombreDeRate;
    public $rate;
    
    
/* Initialise un Rate (NombreDeRate,rate) = (0,NULL) */             
    public static function initialiserRate($dbh, $pseudo){
        $query = "INSERT INTO `Rate`(`PseudoUtilisateur`, `NombreDeRate`) VALUES (?,?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($pseudo, 0));            
    }


/* Modifie le rate de l'utilisateur en fonction de la dernière note qui lui a été donnée
Cette fonction utilise les 2 fonctions ci-après */        
    public static function updatingRate($dbh,$user,$rate){
        $query = "UPDATE `Rate` SET `rate`= ?, NombreDeRate=?  WHERE `PseudoUtilisateur`=?";
        $sth = $dbh->prepare($query);
        $nombreDeRate = Rate::getNombredeRate($dbh,$user);
        $Rate=Rate::getRate($dbh, $user);
        if($Rate == null){
            $RATE = $rate;            
        }
        else{
            $RATE = ($rate + $nombreDeRate * $Rate ) / ($nombreDeRate+1);
        }
        $sth->execute(array($RATE,$nombreDeRate+1,$user));
    }

    
    
/* Renvoie le nombre de notes qu'a reçu l'utilisateur */    
    public static function getNombredeRate($dbh,$user){
        $query = "SELECT * FROM Rate WHERE PseudoUtilisateur=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Rate');
        $sth->execute(array($user));
        $user = $sth->fetch();
        $sth->closeCursor();
        return $user->NombreDeRate;
    }

/* Renvoie le rate actuel de l'utilisateur */        
    public static function getRate($dbh,$user){
        $query = "SELECT * FROM Rate WHERE PseudoUtilisateur=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Rate');
        $sth->execute(array($user));
        $user = $sth->fetch();
        $sth->closeCursor();
        return $user->rate;
    }
    
/* Supprime la ligne correspondant à l'utilisateur user */
    public static function supprimer($dbh,$user){
        $query = "DELETE FROM Rate WHERE PseudoUtilisateur=?"; 
        $sth = $dbh->prepare($query);
        $sth->execute(array($user));
    }
}



?>
