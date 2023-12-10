<?php

require_once __DIR__ . '/../model/dbcon.php';
require_once __DIR__ . '/../model/DbHandler.php';
include ('product.php');
include ('priceList.php');

class order extends dbConnect implements DbHandler
{
    function __construct()
    {
        // connecting to the database
        $this->db = new dbConnect();
    }

    // destructor
    function __destruct()
    {
    }

    public function create()
    {
        $name = $_POST['name'];
        $code = $_POST['code'];
        $description = $_POST['description'];
        $qr = "INSERT INTO product(name, code, description) values('" . $name . "','" . $code . "', '" . $description . "')";
        return mysqli_query($this->db->conn, $qr);
    }

    // get user details
    public function get_record_by_id($id)
    {
        $query = "SELECT * FROM orders WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $userDetails = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        return $userDetails;
    }

    // Delete User
    public function deleteUser()
    {
        if (isset($_GET['deleteId'])) {
            $id = $_GET['deleteId'];
            $result = $this->db->delete($id);
            var_dump($result);
            if ($result) {
                $_SESSION['delete'] = "Deleted Successfully";
                header('location:show.php');
            } else {
                die(mysqli_connect_error());
            }
        }
    }

    // select all users from the database
    public function get_all_record()
    {
        $data = array();

        // Assuming your table name is 'users'
        $query = "SELECT * FROM orders";
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



    public function get_all_order_detailes()
    {
        $data = array();

        // Assuming your table name is 'users'
        $query = "SELECT * FROM order_detailes";
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



    







    // public function storeCustomerOrder($order_date, $code, $product_id, $priceListId, $ar_qty, $ar_des, $ar_price, $ar_pro_name)
    // {
    //     $pre_stmt = $this->db->conn->prepare("INSERT INTO orders(code, order_date, customer_id, priceList_id) VALUES (?, ?, ?, ?)");
    //     $pre_stmt->bind_param("isii", $code, $order_date, $product_id, $priceListId);
    //     $pre_stmt->execute() or die($this->db->conn->error);
    
    //     $invoice_no = $pre_stmt->insert_id;
    
    //     if ($invoice_no != null) {
    //         for ($i = 0; $i < count($ar_price); $i++) {
    //             $insert_product = $this->db->conn->prepare("INSERT INTO order_detailes(order_code, product_id, price, quantity) VALUES (?, ?, ?, ?)");
    //             $insert_product->bind_param("iiid", $invoice_no, $ar_pro_name[$i], $ar_price[$i], $ar_qty[$i]);
    //             $insert_product->execute() or die($insert_product->error);
    //         }
    
    //         return "ORDER_COMPLETED";
    //     }
    // }


    // Function to get the order ID based on the provided code
private function getOrderIdByCode($code)
{
    $select_order_id = $this->db->conn->prepare("SELECT id FROM orders WHERE code = ?");
    $select_order_id->bind_param("i", $code);
    $select_order_id->execute() or die($this->db->conn->error);
    

    $result = $select_order_id->get_result();
    $order_data = $result->fetch_assoc();

    return $order_data['id'] ?? null;
}
    

public function storeCustomerOrder($order_date, $code, $customer_id, $priceListId,$ar_pid, $ar_qty, $ar_des, $ar_price)
{
    $pre_stmt = $this->db->conn->prepare("INSERT INTO orders(code, order_date, customer_id, priceList_id) VALUES (?, ?, ?, ?)");
    $pre_stmt->bind_param("isii", $code, $order_date, $customer_id, $priceListId);  // Assuming you have a variable $customer_id

    // Add error handling
    if (!$pre_stmt->execute()) {
        return "ORDER_INSERT_FAILED" . $pre_stmt->error;
    }

    // if (!$pre_stmt->execute()) {
    //     die("ORDER_INSERT_FAILED: " . $pre_stmt->error);
    // }

    $order_id = $this->db->conn->insert_id;

    if ($order_id) {
        // Iterate over the array of product_ids
        // Use a for loop instead of foreach
        if (is_array($ar_pid)) {
            $numProducts = count($ar_pid);
            for ($i = 0; $i < $numProducts; $i++) {
                $current_product_id = $ar_pid[$i];
                $insert_product = $this->db->conn->prepare("INSERT INTO order_detailes(order_code, product_id, price, quantity) 
                    VALUES (?, ?, ?, ?)");
                $insert_product->bind_param("iiid", $order_id, $current_product_id, $ar_price[$i], $ar_qty[$i]);

                // Add error handling
                if (!$insert_product->execute()) {
                    return "ORDER_DETAILS_INSERT_FAILED";
                }
            }


        return "ORDER_COMPLETED";
    }

    return "ORDER_INSERT_FAILED";
        }



        
    
    }    
    
    }
    


// Inside order.php
if (isset($_POST["getPrice"])) {
    $m = new priceList();

    $pid = $_POST["id1"];
    $plid = isset($_POST["id2"]) ? $_POST["id2"] : null;  // Check if id2 is set

    $result = $m->get_record_by_id($pid, $plid);
    echo json_encode($result);
    exit();
}

// Get Description
if (isset($_POST["getDesc"])) {
    $m = new product();
    $result = $m->get_record_by_id($_POST["id"]);
    echo json_encode($result);
    exit();
}

if (isset($_POST["getPrice"])) {
    $m = new priceList();
    $result = $m->get_record_by_id($_POST["id"]);
    echo json_encode($result);
    exit();
}

if (isset($_POST["getNewOrderItem"]) && $_POST["getNewOrderItem"] == 1) {
    // You can customize the HTML content for a new row based on your requirements
    $html = '
    <tr>
        <td><b class="number">1</b></td>
        <td>
            <select class="form-control form-control-sm pid" required id="pid[]" name="pid[]" data-price-id="">
                <option value="">Choose Product</option>';
    $dbs = new product("groups");
    $groups = $dbs->get_all_record();
    foreach ($groups as $group) {
        $html .= '<option value="' . $group['id'] . '">' . $group['name'] . '</option>';
    }

    $html .= '
            </select>
        </td>
        <td><input name="qty[]" type="number" value="1" class="form-control form-control-sm qty" required></td>
        <td><input name="des[]" readonly type="text" class="form-control form-control-sm des"></td>
        <td><input name="price[]" readonly type="text" class="form-control form-control-sm price" data-price-id=""></td>
        <td>Rs.<span class="amt">0</span></td>
    </tr>';

    echo $html;
    exit;

} elseif (isset($_POST["order_date"]) && isset($_POST["code"]) && isset($_POST["product_id"]) && isset($_POST["priceListId"])) {
    $order_date = $_POST["order_date"];
    $code = $_POST["code"];
    $product_id = $_POST["product_id"];
    $priceListId = $_POST["priceListId"];

    // Now getting array from order_form
    $ar_qty = $_POST["qty"];
    $ar_des = $_POST["des"];
    $ar_price = $_POST["price"];
    // $ar_pro_name = $_POST["pro_name"];

    // Continue processing or calling the necessary function with the obtained data
    // Example: $result = $yourOrderInstance->storeCustomerOrder($order_date, $code, $product_id, $priceListId, $ar_qty, $ar_des, $ar_price, $ar_pro_name);

    // Optionally, you can output the result
    // echo json_encode($result);

} else {
    // Handle other cases or provide an error message
    echo "Invalid request!";
}


?>
