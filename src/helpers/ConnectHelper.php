<?php

require_once('config.php');
require_once('helpers/DataHelper.php');

class ConnectHelper {

    /**
     *
     * Execute a database query
     *
     * @param string $sql The sql to be executed
     * 
     * @return object Return the retrieved data from the database
     *
     */
    public static function execute($sql){
        $sql = DataHelper::convertInput($sql);

        try{
            $connection = new PDO ("sqlsrv:server=".Config::DATABASE_HOSTNAME.";Database=".Config::DATABASE_DATABASE."",Config::DATABASE_USERNAME,Config::DATABASE_PASSWORD);
        } catch (PDOException $e) {
            die("Connectie met database mislukt.");
        }

        $result = $connection->prepare($sql);
        $result = $connection->query($sql);
        
        return $result->fetch();
    }

}

?>