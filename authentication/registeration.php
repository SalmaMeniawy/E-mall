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
        // echo $email;
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
        // echo $dob;
        $country = $this->__get('country');
        if($resultForEmail == 0 && $resultForUsername == 0){
            $check = $this->check_user_data();
            if($check  == 1){
                $database = DB::create_connection(config('dbhost'),config('dbuser'),config('dbpass'),config('dbname'));
                $result = $database->insert('users',['name','email','passwd','dateOfBirth','country'],["$username","$email","$password","$dob","$country"]);
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
    /**
     * check_length_of_passsword method that check the length of the password
     * if it is like the requirment or not 
     * return 1 if it is like the requirment and 0 if not
     */
    public function check_length_of_password(){
        $emailBeforeCheck = $this->__get('password');
        if(strlen($emailBeforeCheck) == 8)
        {
            
            echo "<br> hello from check length it is OK <br>";
            return 1;
        }else{
            echo "<br> It is NOT OK <br>";
            return 0;

        }
    }
    /**
     * check_containing_number_in_password method check if the password contain 
     * numbers and return int 
     */
    public function check_containing_number_in_password(){
        $passwordBeforeCheck = $this->__get('password'); 
        $result = preg_match("^[0-9]+$^" ,$passwordBeforeCheck);
        echo "<br> hello from check numbers";
        return $result;
    }
    // public function check_containing_letters_in_password(){
    //     $passwordBeforeCheck = $this->__get('password');
    //     $result = preg_match("[^a-zA-Z\d]",$passwordBeforeCheck);
    //     echo "<br> hello from check letters <br>";
    //     return $result;
    // }
    public function check_password(){
        $check_length = $this->check_length_of_password();
        // $checl_letters = $this->check_containing_letters_in_password();
        $check_numbers = $this->check_containing_number_in_password();
          
        echo "<br>";
        // echo "$check_numbers AND $checl_letters <br>";
        if($check_length == 1 && $check_numbers == true ){
            echo "<br><h1> the length return $check_length AND contain number $check_numbers </h1>  <br>";  

            return $this->__get('password');

        }else {
            echo "<br> It is not Valid Password <br>";
        }
    }
    /**
     * method check_email it does n't take any parameter 
     * it get the email by using the getter in registration class
     * and check on it and return the email 
     */
    public function check_email(){
        $emailBeforeCheck = $this->__get('email');
        $email = filter_var($emailBeforeCheck ,FILTER_VALIDATE_EMAIL);
        echo "Hello from check email method <br>";
        echo "<br>$email </br>";
        return $email;
    }
    public function check_user_data(){
        $username = $this->__get('username');
        $email = $this->check_email();
        echo $email;
        $password = $this->check_password();
        // $password = $this->__get('password');
        // password_hash($password,PASSWORD_DEFAULT);
        // echo $password;
        $dobBeforeEdite = $this->__get('dob');
        $dob = date('Y-m-d',strtotime($dobBeforeEdite));
        $country = $this->__get('country');
        // echo "Hello from check method";
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

    if(isset($_POST['submit'])){
    $regist = new Registration($_POST['username'],$_POST['email'],$_POST['password'],$_POST['dob'],$_POST['country']);
    $resultForUsername =$regist->username_available_before();
    $resultForEmail = $regist->email_available_before();
    $addResult = $regist->add_new_user($resultForUsername,$resultForEmail);
   
   }
    
?>
