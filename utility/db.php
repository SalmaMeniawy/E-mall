<?php
    //create class DB for database connection
    class DB{
        private static $connection = NULL;

         /**
         * create the constructor of our class that will set the connection by using 
         * function set_connection and take the parameterts for connection to database
         */
        private function __construct($db_host ,$db_user,$db_pswd ,$db_name)
        {
            $this->connection = new mysqli($db_host,$db_user,$db_pswd,$db_name);
            return $this->connection;
        }

        /**create public function to set the connection of the database that 
         * take the host_name ,user_name ,password and finally the name of the 
         * database that will be use in this connection
         */
        public static function create_connection($db_host,$db_user,$db_pswd,$db_name)
        {   
           $connection = $this->__construct($db_host,$db_user,$db_pswd,$db_name);            
           return $connection;
        }
    }
?>