<?php
/* Classe associée à la table de messagerie sur notre base de données */

Class Messagerie{
    public $id; /*Clé PRIMARY*/
    public $expediteur;
    public $recepteur;
    public $titre;
    public $message;
    public $date;
    public $Lu; /* "oui" ssi le message a été lu par le recepteur et "non" sinon */
    


/* Insère un nouveau message */    
    public static function insererMessagerie($dbh, $exp,$rec,$titre,$mes) {
        $sth = $dbh->prepare("INSERT INTO `Messagerie`(`expediteur`, `recepteur`, `titre`, `message`, `Lu`) VALUES(?,?,?,?,?)");
        $sth->execute(array($exp,$rec,$titre,$mes,'non'));
        return true;                    
    }


/* Récupère un message à partir de son id (ou renvoie null si un tel message n'existe pas) */   
    public static function getMessageId($dbh,$id){
        $query = "SELECT * FROM Messagerie WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Messagerie');
        $sth->execute(array($id));
        $message = $sth->fetch();
        $sth->closeCursor();
        if($message==null){
            return null;
        }
        else{
            return $message;
        }
    }

    
/* Récupère un l'expéditeur du message repéré par id */      
    public static function getExpediteur($dbh,$id){
        return Messagerie::getMessageId($dbh,$id)->expediteur;
    }
    
/* Récupère un le recepteur du message repéré par id */      
    public static function getDestinataire($dbh,$id){
        return Messagerie::getMessageId($dbh,$id)->recepteur;
    }

    
/* Supprime le message repéré par id */    
    public static function supprimerMessage($dbh,$id){
        $query='DELETE FROM `Messagerie` WHERE `id`=?';
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
    }

    
 /* Renvoie l'ensemble des messages reçus par l'utlisateur passé en paramètre */   
    public static function  getMessagesRecus($dbh,$user) {
        $query = "SELECT * FROM Messagerie "
                . "WHERE recepteur = ?"
                . "ORDER BY date DESC";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Messagerie');
        $sth->execute(array($user));
        $messages = $sth->fetchAll();
        $sth->closeCursor();
        if($messages==null){
            return null;
        }
        else{
            return $messages;
        }           
    }

/* Renvoie l'ensemble des messages envoés par l'utlisateur passé en paramètre */   
    public static function  getMessagesEnvoyes($dbh,$user) {
        $query = "SELECT * FROM Messagerie "
                . "WHERE expediteur = ?"
                . "ORDER BY date DESC";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Messagerie');
        $sth->execute(array($user));
        $messages = $sth->fetchAll();
        $sth->closeCursor();
        if($messages==null){
            return null;
        }
        else{
            return $messages;
        }           
    }
    
    
/* Marque comme lu le message repéré par $id */        
    public static function marquerCommeLu($dbh,$id){
        $query = "UPDATE `Messagerie` SET `Lu`= ? WHERE `id`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array('oui',$id));
    }

/* Marque comme non-lu le message repéré par $id */        
    
    public static function marquerCommeNonLu($dbh,$id){
        $query = "UPDATE `Messagerie` SET `Lu`= ? WHERE `id`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array('non',$id));
    }

/* Renvoie l'ensemble des messages que ce sont envoyés user1 et user2 */    
    public static function  getConversation($dbh,$user1,$user2) {
        $query = "SELECT * FROM Messagerie "
                . "WHERE ((recepteur = ? and expediteur=?)or(recepteur = ? and expediteur=?))"
                . "ORDER BY date DESC";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Messagerie');
        $sth->execute(array($user1,$user2,$user2,$user1));
        $messages = $sth->fetchAll();
        $sth->closeCursor();
        if($messages==null){
            return null;
        }
        else{
            return $messages;
        }           
    }
    
    
    
    
}
?>
