<?php

use function helpers\config;

// require_once('../global_loader.php');
require_once('../utilities/db.php');
require_once('../utilities/helpers.php');
class Registration{
    private $data = array();
    public function  __set($proparty ,$value){
        $this->data[$proparty] = $value;
    }
    public function __construct(String $username,String $email,$password,string $dob,String $country)
    {
        $this->__set($username,$username);
        $this->__set($email,$email);
        $this->__set($password,$password);
        $this->__set($dob,$dob);
        $this->__set($country,$country);
        
    }
    
    
    public function __get($var_name){
        if(array_key_exists($var_name,$this->data)){
            return $this->data[$var_name];
        }
        return $var_name;
    }
    public function username_available_before(){
       $database = DB::create_connection(config('dbhost'),config('dbuser'),config('dbpass'),config('dbname'));
        $username =$this-> __get('username');
       $result = $database->read_all_records('users');
       foreach($result as $var){
           var_dump($var);
       }
    
    }
}

// <?php $_SERVER['PHP_SELF']
?>
<?php
    // $database = DB::create_connection(config('dbhost'),config('dbuser'),config('dbpass'),config('dbname'));
    // $result = $database->read_fields('users',['name']);
    // $result1 = $database->read('users',['name'],["'name'= 'salma'"]);
    // $result = $database->read_all_records('users');
  

?>
