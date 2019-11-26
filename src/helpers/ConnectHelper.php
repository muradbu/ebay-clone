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
        $sql = mysql_real_escape_string($sql);

        $connection = new mysqli(Config::DATABASE_HOSTNAME, Config::DATABASE_USERNAME, Config::DATABASE_PASSWORD, Config::DATABASE_DATABASE);
        if($connection->connect_error){
            die("Connectie met database mislukt.");
        }
        
        $result = $conn->query($sql);
        
        $connection.close();

        return $result;
    }

}

?>