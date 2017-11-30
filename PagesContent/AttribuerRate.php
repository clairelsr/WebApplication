<?php
    if(isset($_GET['ID']) && $_GET['Donneur']){
        $ID = $_GET['ID'];
        $Donneur = $_GET['Donneur'];
        printformRate($ID,$Donneur);
    }
?>

                
