<div id="cd-nav">
		<a href="#0" class="cd-nav-trigger">Menu<span></span></a>

		<nav id="cd-main-nav">
			<ul>
                            <li><a class="LienDeroulant" href="index.php?name=Accueil">PasDeGaspX</a></li>
                            <li><a class="LienDeroulant" href="index.php?name=NotreAction">Notre Action</a></li>
                            <li><a class="LienDeroulant" href="index.php?name=Offrir">Faire un don</a></li>
                            <li><a class="LienDeroulant" href="index.php?name=ListeOffres">La liste des offres</a></li>
			
                        
<?php   if($_SESSION['loggedIn']){
        /* Côté admin */
            if($_SESSION['Pseudo'] == 'olivier'){
                             echo'<li><a class="LienDeroulant" href="index.php?name=pageadministrateur">Côté admin</a></li>';
                            echo'<li><a class="LienDeroulant" href="index.php?todo=logout">Déconnection</a></li>';   

            }
        /* Côté utilisateur */
            else{
                

                            echo'<li><a class="LienDeroulant" href="index.php?name=MonProfilAccueil">'.$_SESSION['Pseudo'].'</a></li>';
                            echo'<li><a class="LienDeroulant" href="index.php?name=HistoriqueOffres">Votre parcours</a></li>
                            <li><a class="LienDeroulant" href="index.php?name=MonProfilMessagerie">Messagerie</a></li>
                            <li><a class="LienDeroulant" href="index.php?todo=logout">Déconnection</a></li>';   
            }                                    
?>                        
                        </ul>
		</nav>
<?php   }

        else{
            echo'</ul>
		</nav>';
        }
?>
    
</div>


<br/><br/><br/><br/><br/>