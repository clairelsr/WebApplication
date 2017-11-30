<?php
/* La classe du cours permettant la connection à la database. Nous n'avons pas modifié 
les valeurs par défaut, à savoir, 'root' et '' */

class Database {
    
    public static function connect() {
        $dsn = 'mysql:dbname=Donnees_Utilisateurs;host=127.0.0.1';
        $user = 'root';
        $password = '';
        $dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }
}
?>