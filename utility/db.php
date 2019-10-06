<?php
    //create class DB for database connection
    class DB{
        private static $connection = NULL;

        private function __construct($db_host ,$db_user,$db_pswd ,$db_name)
        {

        }
        public static function set_connection($host,$user,$pswd,$name)
        {   
            $db_host = $host;
            $db_user = $user;
            $db_pswd = $pswd;
            $db_name = $name;
            $this->connection = new mysqli($db_host,$db_user,$db_pswd,$db_name);
            
        }
    }
?>