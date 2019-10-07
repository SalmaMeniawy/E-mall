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
            // first check if there's an object already loaded in memory..
            if($this->connection == NULL){
                $this->connection = new mysqli($db_host,$db_user,$db_pswd,$db_name);
                if($this->connection->connect_errno)
                {
                    error_log(print_r("Unable to connect to the database:{$this->connection->connect_error}"));
                }
            }
            //return the existing object anyway (newly created or created before this function call).
            return $this->connection;
        }

        /**create public function to set the connection of the database that 
         * take the host_name ,user_name ,password and finally the name of the 
         * database that will be use in this connection
         */
        public static function create_connection($db_host,$db_user,$db_pswd,$db_name)
        {   
           $connection = self::__construct($db_host,$db_user,$db_pswd,$db_name);            
           return $connection;
        }
        // public function read_record_by_ID($table ,$id)
        // {
        //     $query = 'SELECT * FROM $table WHERE id = $id';
        //     $result = $this->connection->query($query);
        // }
        /**
         * function read records it take table as parameter 
         * to retrive all records in the given table as array
         */
        public function read_records($table)
        {
            $query = 'SELECT * FROM $table ';

        }
    }
?>
