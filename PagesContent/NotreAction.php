<br/><br/>

<div class ='tit3Jaune'> Sur cette page, vous pouvez en apprendre plus sur : </div>
<ol>
    <li><a class = 'lienAncre' href="#I">Le gaspillage en France</a></li>
    <li><a class = 'lienAncre' href="#II">Notre histoire</a></li>
    <li><a class = 'lienAncre' href="#III">PasDeGaspix, comment ca marche ?</a></li>
</ol>

<br/><br/>

<div class="container">
    <header class="page-header">
    <h1><a id="I" class='t1'>Le gaspillage en France</a> </h1>
    </header>
    <section class="row">
    <br/>
    <p>Le gaspillage en France, c'est 16 milliards d'euros de nourriture gaspillé chaque année.
        Chaque année en France, la quantité de déchets alimentaires s’élève à :</p>
    
    <p>I. Dans la distribution (hyper et supermarchés, hard-discounts, épiceries et commerces de proximité) : 2, 3 millions de tonnes ;</p>
    <p>II. Dans la restauration (collective et commerciale) : 1,6 million de tonnes ;</p>
    <p>III. Dans les foyers : 5,2 millions de tonnes (soit 79 kg par personne) ;</p>
    
    <br/>
    
    <p>Au total : 9 millions de tonnes (soit environ 137 kg par personne) si l’on additionne la distribution, la restauration et les foyers 
        (sans compter les pertes liées à la production agricole ainsi qu’à la transformation et au conditionnement des produits dans les industries agroalimentaires).</p>
    <div class='sourceTexte'>(Source : Global Gâchis)</div>
    
    <br/><br/>

    <p>Dans les foyers français, sur les 79 kg de déchets alimentaires jetés chaque année par chaque individu, tous ne 
        peuvent pas facilement être limités (os, épluchures, etc), mais 20 kg pourraient sans difficulté être évités 
        si l’on acceptait de modifier à la marge nos comportements. En effet, cela correspond à 13 kg de restes de repas,
        de fruits et de légumes non consommés (soit 845 000 tonnes en France), et 7 kg d’aliments même pas déballés 
        (soit 455 000 tonnes en France). Au total, ce sont donc chaque année en France 1,3 million de tonnes de nourriture 
        qui sont purement et simplement gaspillées dans les foyers français, ce qui correspond à 38 kg de nourriture consommable jetés toutes les secondes !</p>
    </section>
    <br/>
    
    <header class="page-header">
    <h1 ><a class ='t1' id="II">Notre histoire</a> </h1>
    </header>
    <section class="row">
    <br/>
    <p>Nous sommes deux étudiants de l'école Polytechnique, effarouchés devant ces chiffres. 
    Conscient qu'on ne pourra pas tous résoudre à nous deux, mais ne pouvant nous résoudre 
    à ne pas agir, nous avons décidé de lancer PasdeGaspX.</p>
    <p>Ainsi, nous pouvons lutter à notre niveau contre le gaspillage en France et permettre 
    à tout le monde de participer. </p>
    </section>
    <br/><br/>
    <<section class="row">
        <div class="col-sm-8">
            <img src="images/Claire.jpg" style="width: 300px;" height="400px" alt="Tigre">
        </div>
        <aside class="col-sm-4">
          <address>
              <br/><br/><br/><br/><br/><br/><br/><br/>
            <p>La finnesse, l'intelligence, l'optimisme</p>
            <strong class='Lie'>Claire Lasserre</strong><br/>
            <div class = 'tit5' >claire.lasserre@polytechnique.edu</div><br>

          </address>
        </aside>       
      </section>

    <br/><br/><br/>
    <section class="row">
        <div class="col-sm-8">
            <img src="images/Luc.jpg" style="width: 300px;" height="400px" alt="Tigre">
        </div>
        <aside class="col-sm-4">
          <address>
              <br/><br/><br/><br/><br/><br/><br/><br/>
            <p>La force, l'abnégation, la confiance en l'autre</p>
            <strong class='Lie'>Luc Le Flem</strong><br/>
            <div class = 'tit5' >luc.le-flem@polytechnique.edu</div><br>

          </address>
        </aside>       
      </section>
    <br/>
    <br/>
    <br/>
    <br/>
    
    <header class="page-header">
    <h1 > <a class='t1' id="III">Pas de Gaspix, comment ca marche ?</a></h1>
    </header>
    <section class="row">
    <br/>
    
    <p>PasDeGaspX est très facile d'utilisation. Nous nous sommes inspirés de tout ce qui existe de mieux de nos jours
    dans le monde du P2P pour monter le site le plus "user friendly" possible. </p>
    
    <br/><br/>
    
    <p>Être un membre de PasDeGaspX, c'est </p>
    


    <ol class='listNotreAction' >
        <li>Se connecter (ou s'inscrire) </li>
        <li>Faire ou profiter d'un don </li>
        <li>Consulter ses deals en cours</li>
    </ol>
    
    </section>

<br/>



 

    <!-- Apparaît uniquement si l'utilisateur n'est pas connecté-->
    <?php
    if ($_SESSION["loggedIn"] == FALSE){
        echo'<a class="Lien" href="index.php?name=PageInscription"> Pas encore inscrit, fonce!</a>';
    }
    else{
        echo'<br/>';
        echo'<a class="Lien" href="index.php?name=Offrir"> Pret à offrir, en 1 clic propose un repas</a>';
    }
    ?>