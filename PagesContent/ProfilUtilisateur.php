<?php

/* Côté admin */
if(isset($_SESSION['loggedInAdmin']) && isset($_POST['userConsulteParAdmin'])){
    /* D'abord, on vérifié que l'user consulté existe bien */
    $user = Utilisateurs::getUtilisateur($dbh, $_POST['userConsulteParAdmin']);
    if($user == null){
        echo '<h3 class="tit3"> L\'utilisateur que vous recherchez n\'existe pas </h3>';
    }
    else{
        $userConsulte = $_POST['userConsulteParAdmin'];
        printProfil($dbh,$userConsulte);
        echo'<br/><br/><br/>'
        . '<a class="LienReport" href="index.php?todo=deleteuser&user='.$userConsulte.'">Supprimer cet utilisateur</a>';
    }
}
    
/* Côté utilisateur */ 
if(isset($_GET['userConsulte'])){
    /* D'abord, on vérifié que l'user consulté existe bien */
    $user = Utilisateurs::getUtilisateur($dbh, $_GET['userConsulte']);
    if($user == null){
        echo '<h3 class="tit3"> L\'utilisateur que vous recherchez n\'existe pas </h3>';
    }
    else{
        $userConsulte = $_GET['userConsulte'];
        printProfil($dbh,$userConsulte);
        echo'<br/><br/><br/>
        <a class="LienReport" href="index.php?name=Report&nature=utilisateur&utilisateur='.$userConsulte.'">Sginaler cet utilisateur</a>';
        }
    }
?>
    
        