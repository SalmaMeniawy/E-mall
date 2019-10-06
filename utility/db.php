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
           $connection = $this->__construct($db_host,$db_user,$db_pswd,$db_name);            
           return $connection;
        }
        /**
         * delete a record from the specified table
         * $table: name of table to delete from
         * $field: name of field to delete using
         * $value: value used in the where condition
         */
        public function delete_record($table, $field, $value){
            $query = "DELETE FROM ? WHERE ? = ?";
            $stmt = $this->connection->stmt_init();
            $stmt->prepate($query);
            $stmt->bind_param($table, $field, $value);
            $stmt->execute();
        }

        /**
         * update a value of a record
         * $table: table in which the value updates resides
         * $edit_field: field to edit its value
         * $edit_value: new value
         * $field: field used in where statement
         * $value: value used in the where statement
         */
        public function update_record($table, $edit_field, $edit_value, $field, $value){
            $query = "UPDATE ? SET ? = ? WHERE ? = ?";
            $stmt = $this->connection->stmt_init();
            $stmt->bind_param($table, $edit_field, $edit_value, $field, $value);
            $stmt->execute();
        }
    }
?>
