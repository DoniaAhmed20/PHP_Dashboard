<?php

require_once __DIR__ . '/../model/dbcon.php';
require_once __DIR__ . '/../model/DbHandler.php';
// include('../../config/config.php');
// include('../model/dbcon.php');
// include('../model/DbHandler.php');

class priceList extends dbConnect  implements DbHandler  {  
            
    function __construct() {  
          
        // connecting to database  
        $this->db = new dbConnect();
           
    }  
    // destructor  
    function __destruct() {  
          
    }  

 

    public function create(){  
        $name = $_POST['name'];
        $code = $_POST['code'];
        //$description = $_POST['description'];
        $qr = "INSERT INTO product_pricelist(name, code) values('".$name."','".$code."')";  
        return mysqli_query($this->db->conn, $qr);  
       
}  

public function Create_Product_Price_List(){  
    $priceList_id = $_POST['priceList_id'];
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $qr = "INSERT INTO product_pricelist(product_id, priceList_id, price) values('".$priceList_id."','".$product_id."', '".$price."')";  
    return mysqli_query($this->db->conn, $qr);  
   
}  
   
    
    
    
    // get user details
//     public function get_record_by_id($id) {
//         $query = "SELECT * FROM price_list WHERE id = ?";
//         $stmt = mysqli_prepare($this->db->conn, $query);
//         mysqli_stmt_bind_param($stmt, "i", $id);
//         mysqli_stmt_execute($stmt);
//         $result = mysqli_stmt_get_result($stmt);
//         $userDetails = mysqli_fetch_assoc($result);
//         mysqli_stmt_close($stmt);

//         return $userDetails;
    
// }




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
    $data = array();

    // Assuming your table name is 'users'
    $query = "SELECT * FROM price_list";
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


public function get_all_record_product_price_list(){
    $data = array();

    // Assuming your table name is 'users'
    $query = "SELECT * FROM product_pricelist";
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


public function get_record_by_iid($id) {
    $query = "SELECT * FROM price_list WHERE id = ?";
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



// Inside priceList.php
public function get_record_by_id($id1, $id2) {
    $query = "SELECT * FROM product_pricelist WHERE product_id = ? AND priceList_id = ?";
    $stmt = mysqli_prepare($this->db->conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $id1, $id2);  // Assuming both id1 and id2 are integers
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $productDetails = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return $productDetails;
}




}


?>  