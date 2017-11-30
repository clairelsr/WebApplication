<?php
/* Classe associée à la table recensant l'ensemble des utilisateurs du site */

Class Utilisateurs{
        
    
    public $Pseudo;
    public $Mdp;
    public $Prenom;
    public $Nom;
    public $Email;
    public $ProfilFb;

            
            
/* Retourne l'ensemble des utilisateurs du site*/                        
    public static function getUsers($dbh){
        $query = "SELECT * FROM Utilisateurs ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $sth->execute();
        $users = $sth->fetchAll(); 
        $sth->closeCursor();
        return $users;
    }
    

/* Renvoie les données relatives à l'utilisateur de pseudo 'log' ou null s'il n'existe pas d'utilisateur avec un tel pseudo... */   
    public static function getUtilisateur($dbh, $log) {
        
        
        $query = "SELECT * FROM Utilisateurs WHERE Pseudo = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $sth->execute(array($log));
        $user = $sth->fetch();
        $sth->closeCursor();
        if($user==null){
            return null;
        }
        else{
            return $user;
        }    
    }
    
/*... et les fonctions sous-jacentes permettant  de récupérer un élément précis de l'utilisateur précédemment récupéré*/     
        public static function getPseudoUtilisateur($dbh, $log) {
            return Utilisateurs::getUtilisateur($dbh, $log)->Pseudo;
        }
        public static function getPrenomUtilisateur($dbh, $log) {
            return Utilisateurs::getUtilisateur($dbh, $log)->Prenom;
        }        
        public static function getNomUtilisateur($dbh, $log) {
            return Utilisateurs::getUtilisateur($dbh, $log)->Nom;
        }
        public static function getMailUtilisateur($dbh, $log) {
            return Utilisateurs::getUtilisateur($dbh, $log)->Email;
        }

           

/* Retourne le pseudo de l'utilisateur si l'email est existant dans la base de données et null sinon */
    
    public static function emailExisted($dbh,$mail){
        $query = "SELECT * FROM Utilisateurs WHERE Email = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $sth->execute(array($mail));
        $user = $sth->fetch();
        $sth->closeCursor();
        if($user==null){
            return null;
        }
        else{
            return $user->Pseudo;
        }    
    }



/* Retourne le pseudo de l'utilisateur si le profil fb est existant dans la base de données et null sinon */
    
    public static function profilFbExisted($dbh,$Fb){
        $query = "SELECT * FROM Utilisateurs WHERE ProfilFb = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $sth->execute(array($Fb));
        $user = $sth->fetch();
        $sth->closeCursor();
        if($user==null){
            return null;
        }
        else{
            return $user->Pseudo;
        }    
    }
    
    


/* Teste si le mdp soumis correspond au login de l'utilisateur. La fonction suppose que le login est effectivement présent dans la table */    
    public static function testerMdp($dbh, $login,$mdp) {
        
        $query = "SELECT * FROM Utilisateurs WHERE Pseudo = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $sth->execute(array($login));
        $user = $sth->fetch();
        $sth->closeCursor();
        $motDePasse = $user->Mdp;
        
        if($motDePasse == SHA1($mdp)){
            return true;
        }
        else{
            return false;
        }
    }
        

    
    
/* Insère un nouvel utilisateur */    
    public static function insererUtilisateur($dbh, $Pseudo, $mdp, $Prenom, $Nom, $email, $ProfilFb) {
        
        
        $sth = $dbh->prepare("INSERT INTO Utilisateurs VALUES(?,SHA1(?),?,?,?,?)");
        $sth->execute(array($Pseudo, $mdp, $Prenom, $Nom, $email, $ProfilFb));
        return true;
         
    }
         

/* Modifie le mot de passe de l'utilisateur repéré par son pseudo */    
    public static function modifierMdp($dbh, $log, $nouveauMdp){
        /* On récupère le sel de la partie secure pour le conserver dans la modification du mdp */
        global $salt;
        
        
        $query =  "UPDATE Utilisateurs SET Mdp=? WHERE Pseudo = ?";   
        $sth = $dbh->prepare($query);
        $sth->execute(array(SHA1($nouveauMdp),$log));;        
        
    }
    
/*Supprime le compte associé au pseudo */    
    public static function supprimerCompte($dbh,$log){
            $sth = $dbh->prepare("DELETE FROM Utilisateurs WHERE Pseudo=?");
            $sth->execute(array($log));
    }
} 


?>

    