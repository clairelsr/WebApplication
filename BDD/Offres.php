<?php

/* Ce fichier est la classe associée à la table où sont recensées toutes les offres */

Class Offres{
    public $id; /* Clé PRIMARY */
    public $Donneur;
    public $Receveur;
    public $Etat; /* Etat true ssi l'offre est toujours disponible */
    public $Titre;
    public $Quantite;
    public $DateLimiteDeConsommation;
    public $AdresseDeLaRencontre;
    public $CodePostale;
    public $NumeroDeTel;
    public $CommentJeLaiCuisine;
    public $Latitude;
    public $Longitude;
    public $Rated; /* Rated true ssi l'offre a été notée *:

    

/* Permet d'insérer une offre */    
    public static function insererOffre($dbh,$Donneur, $Receveur, $Etat, $Titre, $Quantite, $DateLimiteDeConsommation,$AdresseDeLaRencontre,$CodePostale,$NumeroDeTel,$CommentJeLaiCuisine,$Latitude,$Longitude,$Rated){
        $query ="INSERT INTO `Offres`(`Donneur`, `Receveur`, `Etat`, `Titre`, `Quantite`, `DateLimiteDeConsommation`, `AdresseDeLaRencontre`, `CodePostale`,  `NumeroDeTel`, `CommentJeLaiCuisine`,`Latitude`,`Longitude`,`Rated`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($Donneur, $Receveur, $Etat, $Titre, $Quantite, $DateLimiteDeConsommation,$AdresseDeLaRencontre,$CodePostale, $NumeroDeTel,$CommentJeLaiCuisine,$Latitude,$Longitude,$Rated));      
    }

/* Permet de modifier une offre déjà postée en ligne */    
    public static function modiferOffre($dbh,$id, $Titre, $Quantite, $DateLimiteDeConsommation,$AdresseDeLaRencontre,$CodePostale,$NumeroDeTel,$CommentJeLaiCuisine,$Latitude,$Longitude){
        $query = "UPDATE `Offres` SET `Titre`= ? , `Quantite`= ?, `DateLimiteDeConsommation`= ?, `AdresseDeLaRencontre`= ?, `CodePostale`= ?, `NumeroDeTel`= ?, `CommentJeLaiCuisine`= ?, `Latitude`= ?, `Longitude`= ? WHERE `id`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($Titre, $Quantite, $DateLimiteDeConsommation,$AdresseDeLaRencontre,$CodePostale, $NumeroDeTel,$CommentJeLaiCuisine,$Latitude,$Longitude,$id)); 
    }

/* Permet de retirer une offre postée */    
    public static function retirerOffre($dbh,$id){
        $query = "DELETE FROM `Offres` WHERE `id`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
    }

/* Retire toutes les offres postées par l'utilisateur */     
    public static function retirerOffreQuandSuppression($dbh,$user){
        $query = "DELETE FROM `Offres` WHERE `Donneur`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($user));
    }
    
/* Libère toutes les offres acceptées par l'utilisateur */
    public static function libererOffreQuandSuppression($dbh,$user){
        $query = "UPDATE `Offres` SET `Receveur`= null, Etat = True WHERE `Receveur`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($user));
    }
 
    
/* Envoie des messages à tous les donneurs dont le don a été accepté par l'utilsateur courant */
    public static function envoieMessagesInformations($dbh,$user,$message){
        $query = "SELECT * FROM Offres WHERE Receveur = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Offres');
        $sth->execute(array($user));
        $offres = $sth->fetchAll();
        $sth->closeCursor();
        if($offres!=null){
            foreach($offres as $offre){
                Messagerie::insererMessagerie($dbh, 'olivier', $offre->Donneur, 'Désistement', $message);
            }
        }
    }
    
    
    
    
    
/* Marque une offre comme ayant été acceptée */    
    public static function offreAcceptee($dbh,$id,$receveur){
        $query = "UPDATE `Offres` SET `Receveur`= ?, Etat = False WHERE `id`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($receveur,$id));        
    }
    
/* Repositionne une offre comme disponible alors qu'elle avait été acceptée */    
    public static function retirerOffreAcceptee($dbh,$id){
        $query = "UPDATE `Offres` SET Etat = ? , Receveur = ? WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array(TRUE, NULL, $id));
    }
    
/* Récupère l'offre repérée par son id (ou renvoie null si une telle offre n'existe pas)... */    
    public static function offreId($dbh,$id){
        $query = "SELECT * FROM Offres WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Offres');
        $sth->execute(array($id));
        $offre = $sth->fetch();
        $sth->closeCursor();
        if($offre==null){
            return null;
        }
        else{
            return $offre;
        }
    }

/*... et les fonctions sous-jacentes permettant  de récupérer un élément précis de l'objet précédemment récupéré*/     
        public static function getDonneurId($dbh,$id){
            return Offres::offreId($dbh,$id)->Donneur;
        }
        public static function getReceveurId($dbh,$id){
            return Offres::offreId($dbh,$id)->Receveur;
        } 
        public static function getTitreId($dbh,$id){
            return Offres::offreId($dbh,$id)->Titre;
        }    
        public static function getQuantite($dbh,$id){
            return Offres::offreId($dbh,$id)->Quantite;
        }
        public static function getDateLimiteDeConsommationId($dbh,$id){
            return Offres::offreId($dbh,$id)->DateLimiteDeConsommation;
        }
        public static function getAdresse($dbh,$id){
            return Offres::offreId($dbh,$id)->AdresseDeLaRencontre;
        } 
        public static function getCodePostale($dbh,$id){
            return Offres::offreId($dbh,$id)->CodePostale;
        }
        public static function getEtat($dbh,$id){
            return Offres::offreId($dbh,$id)->Etat;
        }
        public static function getDescriptionPlat($dbh,$id){
            return Offres::offreId($dbh,$id)->CommentJeLaiCuisine;
        } 
        public static function getNumeroId($dbh,$id){
            return Offres::offreId($dbh,$id)->NumeroDeTel;
        }
        public static function getRate($dbh,$id){
            return Offres::offreId($dbh,$id)->Rated;
        }
    

/* Positionne une offre comme ayant été notée */    
    public static function getRated($dbh,$id){
        $query = "UPDATE `Offres` SET `Rated`= ? WHERE `id`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array(True,$id));        
    }



/* Renvoie l'ensemble des offres postées par l'utilisateur qui n'ont pas encore été acceptée */    
    public static function getHisoriqueDonneurEnCours($dbh,$user){
        $query = "SELECT * FROM Offres "
                . "WHERE Donneur = ? AND Etat = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Offres');
        $sth->execute(array($user, TRUE));
        $offres = $sth->fetchAll();
        $sth->closeCursor();
        return $offres;
    }

/* Renvoie l'ensemble des offres postées par l'utilisateur qui ont été acceptées(mais pas forcément encore notées */    
    public static function getHisoriqueDonneurOver($dbh,$user){
        $query = "SELECT * FROM Offres "
                . "WHERE Donneur = ? AND Etat =  ? ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Offres');
        $sth->execute(array($user, FALSE));
        $offres = $sth->fetchAll();
        $sth->closeCursor();
        return $offres;;
    }
    
/* Renvoie l'ensemble des offres choisies par l'utilisateur qu'il doit encore noter */        
    public static function getHisoriqueReceveurEnCours($dbh,$user){
        $query = "SELECT * FROM Offres "
                . "WHERE Receveur = ? AND Rated = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Offres');
        $sth->execute(array($user, FALSE));
        $offres = $sth->fetchAll();
        $sth->closeCursor();
        return $offres;
    }

/* Renvoie l'ensemble des offres choisies par l'utilisateur qu'il a noté */            
    public static function getHisoriqueReceveurOver($dbh,$user){
        $query = "SELECT * FROM Offres "
                . "WHERE Receveur = ? AND Rated = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Offres');
        $sth->execute(array($user,TRUE));
        $offres = $sth->fetchAll();
        $sth->closeCursor();
        return $offres;
    }
    


    
}




?>