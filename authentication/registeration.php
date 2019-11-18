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
    public function __construct(String $Name,String $Email,$Password,string $Dob,String $Country)
    {
        $this->__set('username',$Name);
        $this->__set('email',$Email);
        $this->__set('password',$Password);
        $this->__set('dob',$Dob);
        $this->__set('country',$Country);
        
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
         echo $username;
         $result = $database->read('users',['name'],["'name'= '.$username.'"]);
       return $result;
    }
}

// <?php $_SERVER['PHP_SELF']
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <form action="registeration.php" method="POST">
            <div>
                <input type="text" name="username" placeholder="User Name" require>
            </div>
            <div>
                <input type="email" name="email"placeholder="Email" require >
            </div>
            <div>
                <input type="password" name="password" placeholder="password" require>
            </div>
            <div>
                <input type="date" name="dob" placeholder="Date Of Birth" require>
            </div>
            <div>
                <input type="text" name="country" placeholder="Country" require>
            </div>
            <div>
                <button type="submit" >Sign Up</button>
            </div>
        </form>
    </body>
<?php
echo "Hello hiiiiiiiiiiiii";
   if(isset($_POST['username']) && !is_null($_POST['username'])){
    echo "Hello hiiiiiiiiiiiii";
    echo "<br>";

    $regist = new Registration($_POST['username'],$_POST['email'],$_POST['password'],$_POST['dob'],$_POST['country']);
    $result =$regist->username_available_before();
    var_dump($result);
    if($result){
        echo "<br>";
        echo "it is available before";
    }
   }
    // $database = DB::create_connection(config('dbhost'),config('dbuser'),config('dbpass'),config('dbname'));
    // $result = $database->read_fields('users',['name']);
    // $result1 = $database->read('users',['name'],["'name'= 'salma'"]);
    // $result = $database->read_all_records('users');
  

?>
