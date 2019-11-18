<?php

use function helpers\config;
// $_POST = [];
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
    
    /**
     * get method one from magic functions it related to Registration class
     * to get it is properties by take @param String $var_name
     */
    public function __get(String $var_name){
        if(array_key_exists($var_name,$this->data)){
            return $this->data[$var_name];
        }
        return $var_name;
    }
    /**
     * function username_available_before which return boolean return 1 if the name which mean 
     * username defined and in Database  before  and return 0 if it is not defined before
     * 
     */
    public function username_available_before(){
         $database = DB::create_connection(config('dbhost'),config('dbuser'),config('dbpass'),config('dbname'));
         $username =$this-> __get('username');
         $result = $database->read('users',['name'],[" name = '$username'"]);
         if($result->num_rows == 1){
             return 1;
         }else{
             return 0;
         }
    }
    /**
     * function email_available_before that does not take any parameters 
     * check if the email used before in the database if that return 1 
     * if it is't used before return 0
     */
    public function email_available_before(){
        $database = DB::create_connection(config('dbhost'),config('dbuser'),config('dbpass'),config('dbname'));
        $email = $this->__get('email');
        echo "<br>";
        echo $email;
        $result =$database->read('users',['email'],["email = '$email'"]);
        if($result->num_rows == 1){
            return 1;
        }else{
            return 0;
        }
    }
    public function add_new_user(int $resultForUsername , int $resultForEmail){
        $username = $this->__get('username');
        $email = $this->__get('email');
        $password = $this->__get('password');
        $dobBeforeEdite = $this->__get('dob');
        $dob = date('Y-m-d',strtotime($dobBeforeEdite));
        echo $dob;
        $country = $this->__get('country');
        if($resultForEmail == 0 && $resultForUsername == 0){
            $check = $this->check_user_data();
            if($check  == 1){
                $database = DB::create_connection(config('dbhost'),config('dbuser'),config('dbpass'),config('dbname'));
                $result = $database->insert('users',['name','email','passwd','dateOfBirth','country'],["$username","$email","$password","$dob","$country"]);
                // var_dump($result);
                    if($result ){
                        echo "<br>";
                        
                        echo "the data inserted Successfully ";
                        return 1;
                    }else{
                        echo "<br>";
                        echo "the data mda5aletch";
                        return 0;
                    }
            }
        }
    }
    public function check_user_data(){
        $username = $this->__get('username');
        $email = $this->__get('email');
        $password = $this->__get('password');
        $dobBeforeEdite = $this->__get('dob');
        $dob = date('Y-m-d',strtotime($dobBeforeEdite));
        $country = $this->__get('country');
        echo "Hello from check method";
        if(!empty($username)&& !empty($email)&& !empty($password) && !empty($dob)&& !empty($country)
            && !is_null($username)&& !is_null($email) && !is_null($password)&& !is_null($dob)
            && !is_null($country))
            {
               
                return 1;

            }else{
            return 0;
            }

        
    }
    

}

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
                <button type="submit" name="submit" >Sign Up</button>
            </div>
        </form>
    </body>
<?php
//    if(isset($_POST['username']) && !is_null($_POST['username'])){
    if(isset($_POST['submit'])){
    $regist = new Registration($_POST['username'],$_POST['email'],$_POST['password'],$_POST['dob'],$_POST['country']);
    $resultForUsername =$regist->username_available_before();
    $resultForEmail = $regist->email_available_before();
    $addResult = $regist->add_new_user($resultForUsername,$resultForEmail);
   
   }
    // $database = DB::create_connection(config('dbhost'),config('dbuser'),config('dbpass'),config('dbname'));
    // $result2 = $database->insert('users',['name','email','passwd','dateOfBirth','country'],['ali','ssqw@gmail.com','rere','1999-10-5','egypt-alex']);
    // // $result = $database->read_fields('users',['name']);
    // $result1 = $database->read('users',['name'],[" name = 'heba'"]);
    
?>
