<!-- <?php 
    // include ('../../controller/priceList.php');
    // $db = new priceList();
    // $items = $db->get_all_record();
    // include('../includes/header.php');
?> -->
<?php 
    session_start();
    include ('../../controller/product.php');
    include ('../../controller/customer.php');
    include ('../../controller/priceList.php');
    // include ('../../controller/order.php');
    $db = new priceList();

    if (isset($_POST['submit'])) {


        $priceList_id = $_POST['priceList_id'];
        $customer_id = $_POST['customer_id'];
        $price = $_POST['price'];
        
      
      if (empty($_POST['priceList_id']) || empty($_POST['customer_id']) || empty($_POST['price'])) {
        $error_message = "All fields are required";
      }
      
    //   $error_name = validateName($name);
    //   $error_email = validateEmail($email);
    //   $error_password = validatePassword($password);
    //   $error_username = validateUsername($username);
    //   if ($error_name == "" && $error_message == "" && $error_email == "" && $error_password == "" && $error_username == "") {
      
        $new_values = array(
      
          'priceList_id' => $priceList_id,
          'product_id' => $product_id,
          'price' => $price

        );
        $result = $db->Create_Product_Price_List();
        $_SESSION['status'] = "Created Successfully";
        header('location:show.php');
        
    
        
      }












    //   if(isset($_POST['order_date']) AND isset($_POST['code']) AND isset($_POST['product_id']) AND isset($_POST['priceListId'])){
    //     $order_date = $_POST[order_date];
    //     $code = $_POST[code];
    //     $product_id = $_POST[product_id];
    //     $priceListId = $_POST[priceListId];

    //     //Now getting array from order_form
    //     $ar_qty = $_POST["qty"];
    //     $ar_des = $_POST["des"];
    //     $ar_price = $_POST["price"];
    //     $ar_pro_name = $_POST["pro_name"];


    //     $rr = new order();
    //     $res = $rr->storeCustomerOrder($order_date,$code,$product_id,$priceListId,$ar_qty,$ar_des,$ar_price,$ar_pro_name);
    //     var_dump($res);
    //     echo $res;


    // }
      include('../includes/header.php'); 
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript" src="order.js"></script>

<div class="overlay"><div class="loader"></div></div>


<div class="container">
    <div class="row">
        <div class="col-md-10 mt-5 mx-auto">
        <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
  <div class="card-header">
    <h4>New order<h4>
  </div>
  <div class="card-body">
    <form id="get_order_data">
        <div class="form-group row">
            <label class="col-sm-3" align="right">Order Date</label>
            <div class="col-sm-6">
                <input type="text" id="order_date" name="order_date" class="form-control form-control-sm order_date" value="<?php echo date('Y-d-m')?>">
            </div> 
        </div>
        <div class="form-group row">
            <label class="col-sm-3" align="right">Code</label>
            <div class="col-sm-6">
                <input type="text" id="code" name="code" class="form-control form-control-sm" placeholder="Enter Order Code" required>
            </div> 
        </div>

        <div class="form-group row">
            <label class="col-sm-3" align="right">Customer Name</label>
            <div class="col-sm-6">
            <select class="form-control  rounded-end" id="customer_id"  name="customer_id">
                <option value="">Chooes Customer Name</option>
<?php
    $dbs = new customer("groups");
    $groups = $dbs->get_all_record();
    foreach ($groups as $group) {
        echo '<option value="' . $group['id'] . '">' . $group['name'] . '</option>';
    }
?>
</select>
            </div> 
        </div>


        <div class="form-group row">
            <label class="col-sm-3" align="right">Price_List Name</label>
            <div class="col-sm-6">
            <select class="form-control  rounded-end priceListId"   id="priceListId"  name="priceListId">
                <option value="">Chooes Price_List Name</option>
                    <?php
                        $dbs = new priceList("groups");
                        $groups = $dbs->get_all_record();
                        foreach ($groups as $group) {
                            echo '<option value="' . $group['id'] . '">' . $group['name'] . '</option>';
                        }
                    ?>
            </select>
            </div> 
        </div>



        <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
            <div class="card-body">
                <h3> Make a order list</h3>
                <table align="center" style="width: 800px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="text-align:center;">name</th>
                            <th style="text-align:center;">quantity</th>
                            <th style="text-align:center;">description</th>
                            <th style="text-align:center;">price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="invoice_item">
                        <tr>
                            <td><b class="number">1</b></td>
                            <td>
                               
                                <!-- <select class="form-control form-control-sm pid" required id="pid[]"  name="pid[]"> -->
                               <select class="form-control form-control-sm pid" required id="pid[]" name="pid[]" data-price-id="">
                                    <option value="">Chooes Product</option>
                                    <?php
                                        $dbs = new product("groups");
                                        $groups = $dbs->get_all_record();
                                        foreach ($groups as $group) {
                                            echo '<option value="' . $group['id'] . '">' . $group['name'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                            <td><input name="qty[]" type="number" value="1" class="form-control form-control-sm qty" required></td>
                            <td><input name="des[]" readonly type="text" class="form-control form-control-sm des"></td>
                            <td><input name="price[]" readonly type="text" class="form-control form-control-sm price" data-price-id=""></td>
                            <!-- <span><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"></span> -->

                            <!-- <td><input name="price[]" readonly type="text" class="form-control form-control-sm price"></td> -->
                            <!-- hidden column -->
                            <td><span class="amt">0</span></td>
                        </tr>
                    </tbody>
                </table>
                <center style="padding: 10px;">
                    <button id="add" style="width:150px" class="btn btn-success">Add</button>
                    <button id="remove" style="width:150px" class="btn btn-danger">Remove</button>

                </center>
            </div>
        </div>

        <center style="padding: 10px; margin-top:15px">
            <input type="submit" id="order_form" style="width:150px" class="btn btn-info" value="order">
            <input type="submit" id="pribt_invoice" style="width:150px" class="btn btn-success d-none" value="print">
        </center>
    </form>
    </div>
</div>
        </div>
    </div>
</div>


<!-- <script>
    $(document).ready(function(){
    var DOMAIN = "http://localhost/working/views/order/create.php";

    alert("hello");
})
</script> -->

<?php 
    include('../includes/footer.php');
?>