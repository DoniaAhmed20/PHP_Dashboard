<?php

require_once __DIR__ . '/../model/dbcon.php';
require_once __DIR__ . '/../model/DbHandler.php';
// include('../../config/config.php');
// include('../model/dbcon.php');
// include('../model/DbHandler.php');

class customer extends dbConnect  implements DbHandler  {  
            
    function __construct() {  
          
        // connecting to database  
        $this->db = new dbConnect();
        // $this->_table=$table;
        // $this->_log = new Logger('exceptions');
        // $this->_log->pushHandler(new StreamHandler($this->path.'exceptions.log', Logger::DEBUG));
        // $this->connect();
           
    }  
    // destructor  
    function __destruct() {  
          
    }  


    public function UserRegister($username, $emailid, $password){  
            // $password = md5($password);  
            $password = password_hash($password, PASSWORD_BCRYPT);
            $qr = "INSERT INTO users(name, email, password) values('".$username."','".$emailid."','".$password."')";  
            return mysqli_query($this->db->conn, $qr);  
           
    }  

    public function create(){  
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $code = $_POST['code'];
        $country = $_POST['country'];
        // $password = md5($password);  
        $password = password_hash($password, PASSWORD_BCRYPT);
        $qr = "INSERT INTO customer(name, email, password, code, country) values('".$name."','".$email."','".$password."','".$code."','".$country."')";  
        return mysqli_query($this->db->conn, $qr);  
       
}  
    public function Login($email, $password){  
       // $res = mysql_query("SELECT * FROM users WHERE email = '".$emailid."' AND password = '".md5($password)."'"); 
       //$password = password_hash($password, PASSWORD_BCRYPT); 
       $res = "select * FROM users WHERE email='$email' AND password='$password'";
        //$user_data = mysql_fetch_array($res);
        $log_query_run = mysqli_query($this->db->conn, $res);  
        $user_data = mysqli_fetch_array($log_query_run);
        $no_rows = mysqli_num_rows($log_query_run);
          
        if ($no_rows == 1)   
        {  
       
            $_SESSION['login'] = true;  
            $_SESSION['uid'] = $user_data['id'];  
            $_SESSION['username'] = $user_data['username'];  
            $_SESSION['email'] = $user_data['emailid'];  
            return TRUE;  
        }  
        else  
        {  
            return FALSE;  
        }  
    }  
    public function isUserExist($emailid){  
        $qr = "SELECT * FROM users WHERE email = '$emailid'";  
        $log_query_run = mysqli_query($this->db->conn, $qr);  
        // $row = mysqli_num_rows($qr);  
        if ($log_query_run) {
            $row = mysqli_num_rows($log_query_run);
    
            if ($row > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            // Handle query execution error
            echo "Error executing query: " . mysqli_error($this->db->conn);
            return false;
        }
    }
    
    
    // get user details
    public function get_record_by_id($id) {
        $query = "SELECT * FROM customer WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $userDetails = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        return $userDetails;
         // Execute the statement
    // mysqli_stmt_execute($stmt);

    // Bind the result
    // mysqli_stmt_bind_result($stmt, $username, $emailid);

    // Fetch the result
    // mysqli_stmt_fetch($stmt);

    // Close the statement
    // mysqli_stmt_close($stmt);

    // return ['username' => $username, 'emailid' => $emailid];
}



//LogOut
public function logout() {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    // Redirect to the login page
    header("location: index.php");
    exit();
}



//Remember me
public function rememberMe(){
    if(isset($_POST['remember_me'])){
        setcookie('email', $_POST['email'], time() + (86400 * 30), "/"); 
        setcookie('password', $_POST['password'], time() + (86400 * 30), "/");
    }
    else{
            setcookie('email' ,"" , time()-1, "/");
            setcookie('password' , "", time()-1, "/");
        }
}


//Delete User
public function deleteUser(){
    if(isset($_GET['deleteId'])){
        $id=$_GET['deleteId'];
        $result =$db->delete($id);
         var_dump($result);
    if($result){
      $_SESSION['delete'] = "Deleted Successfully";
       header('location:show.php');
    }
    else{ 
        die ( mysqli_connect_error());
    }
    
     }
    
}

//select all users from the data base
public function get_all_record(){
    // $data = array();
    // $sql = "SELECT * FROM users";
    // $stml = $this->conn->prepare($sql);
    // $stml->execute();
    // $result = $stml->fetchAll(PDO::FETCH_ASSOC);
    // foreach ($result as $row) {
    //     $data[] = $row;
    // }
    // return $data;
    $data = array();

    // Assuming your table name is 'users'
    $query = "SELECT * FROM customer";
    $result = $this->db->conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        // Handle query execution error
        echo "Error executing query: " . $this->db->conn->error;
    }

    return $data;
}



// public function get_all_record_paginated($field=array(),$start=0)
// {
//      $table=$this->_table;
//     if(empty($field))
//     {
//             $sql="select * from `$table`";

//     }
//     else
//     {
//          $sql="select *";
//          foreach($field as $f){
//                              $sql=" `$f` ,";
//                               }
//           $sql.="from `$table`";
//           $sql=str_replace(", from","from",$sql);
//     }
//          //$sql.="limit $start ," . __RECORDS_PER_PAGE__ ;

//     return $this->getResult($sql);


// }

//get user by id
// public function get_record_by_id($id){
//     $sql = "SELECT * FROM users WHERE id = :id";
//     $stmt = 
// }

}
// $obj = new customer;
//  print_r($obj->get_all_record());

?>  