<?php
/* Classe associées à la table AlimentsExistant de notre base de données. Elle associe à l'offre 'id', 
l'aliment phare de sa composition*/

Class AlimentsExistant {
    public $id; /*Clé PRIMARY*/
    public $Aliment;
 

/* Insère l'élément phare choisi par l'utilisateur courant */
public static function registerAliment($dbh,$aliment){
    $query ="INSERT INTO `AlimentsExistant`(`Aliment`) VALUES (?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($aliment));      
}

/* Modifie l'élément phare choisi par l'utilisateur courant */
public static function modifierAliment($dbh,$id,$Aliment){
    $query = "UPDATE `AlimentsExistant` SET Aliment = ? WHERE id=?";
    $sth = $dbh->prepare($query);
    $sth->execute(array($Aliment,$id));      
}

/* Supprime l'élément phare de la recette repérée par id */
public static function retirerAliment($dbh,$id){
        $query = "DELETE FROM `AlimentsExistant` WHERE `id`=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
    }



}
?>



