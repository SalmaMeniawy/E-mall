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
        /**
         * function read all records it take table as parameter 
         * to retrive all records in the given table as array
         */
        public function read_all_records(string $table)
        {
            $query = 'SELECT * FROM $table ';
            $result = $this->connection->query($query);
            return $result;

        }
        /**
         * function that take table name and array which contain fields
         * names to get them from all records in a given table name
         */
        public function read_fields(string $table , array $fields)
        {
            $query = "SELECT "; //start the query
            for($x = 0 ;$x <sizeof($fields);$x++)
            {
                $query.= $fields[$x]; //add the fields to the query statment
                if($fields[$x+1]!= NULL){
                    $query.=' , ';
                }
            }
            $query .=" FROM $table";//finally add the table name to the query
            $result = $this->connection->query($query);
        
            return $result;      
        }
        /**
         * function read that take three parameters the table name
         * , array of specific fields and finally array for condetion 
         *  statment
         */
        public function read(string $table , array $fields , array $where)
        {
            $query = "SELECT "; //start the query
            for($x = 0 ;$x <sizeof($fields);$x++)
            {
                $query.= $fields[$x]; //add the fields to the query statment
                if($fields[$x+1]!= NULL){
                    $query.=' , ';
                }
            }
            $query .="FROM $table";
            $query .=" WHERE ";
            $keys = array_keys($where);
            $count = count($where);
            for($i = 0 ;$i <$count;$i++) // add the condetion values to query statment
            {
                $add = $where[$keys[$i]];
                $query .= "$keys[$i] = $add";
                if($where[$keys[$i+1]]!= NULL)
                {
                   $query.=" AND ";
                }
            }
            $result = $this->connection->query($query);
            return $result;
        }
        
        /**
         * function insert take three parameters table name , fields in the table,
         * finally data that will be insert to the given table
         */
        public function insert($table , $fields ,$data)
        {
            $query = "INSERT INTO $table ( "; //start the query 
            if(isset($fields) && isset($data) && count($fields) == count($data))
            {
                foreach($fields as $field)
                {   
                    $next = next($fields);
                    $query .= " {$field} ";
                    if(isset($next) && !empty($next))
                    {
                        $query .= " , ";
                    }else{
                        $query .= " ) ";
                    }
                }
                $query .= "VALUES ( ";
                foreach($data as $value)
                {
                    $next = next($data);
                    if(is_string($value))
                    {
                        $query .= " '$value' ";
                        if(isset($next) && !empty($next))
                        {
                            $query .= " ,";
                        }else{
                            $query .= " )";
                        }
                    }elseif( is_int($value) || is_double($value) || is_float($value))
                    {
                        $query .= " $value ";
                        if(isset($next) && !empty($next))
                        {
                            $query .= " ,";
                        }else{
                            $query .= " )";
                        }
                    }
                }  
               
            }
            $result = $this->connection->query($query);
            return $result; 
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
            $stmt->prepare($query);
            $stmt->bind_param($table, $edit_field, $edit_value, $field, $value);
            $stmt->execute();
        }

        /**
         * delete a record based on multiple condition
         */
        public function delete_record_with_values($table, array $field_vals){
            $query = "DELETE FROM $table WHERE ";
            $counter = 0;
            foreach ($field_vals as $field => $value) {
                $query .= $field . " = " . $value;
                
                if($counter != count($field_vals) - 1){
                    $query .= " and ";
                }
                $counter++;
            }
            $query .= ";";
            $this->connection->query($query);
        }
    }
?>
