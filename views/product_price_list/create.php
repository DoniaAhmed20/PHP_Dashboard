<?php 
    session_start();
    include ('../../controller/product.php');
    include ('../../controller/customer.php');
    include ('../../controller/priceList.php');
    $db = new priceList();

    if (isset($_POST['submit'])) {


        $priceList_id = $_POST['priceList_id'];
        $product_id = $_POST['product_id'];
        $price = $_POST['price'];
        
      
      if (empty($_POST['priceList_id']) || empty($_POST['product_id']) || empty($_POST['price'])) {
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
      include('../includes/header.php'); 
?>
    
    <div class="container-fluid px-4" >
    <div class="row">

    
    
        <!-- <div class="col-lg-6">
            <button type="button" class="btn btn-primary m-1 py-2 float-right" data-toggle="modal" data-target="#addModal">Add new user</button>
        </div>
    -->
    <hr class="my-1">
    <div class="row">
        <div class="col-lg-12">
        <div class="content-header">
    <!-- <div class="container-fluid"> -->
    <form class=" mt-5 " method="post" class="container" enctype="multipart/form-data">
      <div class="shadow p-3 mb-5  rounded-4  container ">
        <p class="text-center fs-1 fst-italic" style="color: #BC8CE9; text-shadow: 1px 2px #A8BBC9; margin-top: -50px"> Register user</p>
        <?php  if(isset($error_message)){
                echo " <h5 style='color: red; margin-left:50px'>$error_message</h5>";
            }  ?>
        
       


        <div class="mb-3 mx-5 mt-3 " style="color: #BC8CE9; font-size: 20px; margin-top: -30px">
          <label for="priceList_id" class="form-label">PriceList_id</label>
          <select class="form-control  rounded-end" class="js-example-basic-single myselect" name="state" id="priceList_id" style="background-color: rgba(0, 0, 0, 0.1); border-color: #B988E9; color:white" name="priceList_id">

            <?php
            $dbs = new priceList("groups");
            $groups = $dbs->get_all_record();
            foreach ($groups as $group) {
              echo '<option value="' . $group['id'] . '">' . $group['name'] . '</option>';
            }
            ?>
          </select>

        </div>


        <div class="mb-3 mx-5  mt-3 " style="color: #BC8CE9; font-size: 20px; margin-top: -30px">
          <label for="product_id" class="form-label">Product_id</label>
          <select class="form-control  rounded-end" id="product_id" style="background-color: rgba(0, 0, 0, 0.1); border-color: #B988E9; color:white" name="product_id">

              <?php
                  $dbs = new product("groups");
                  $groups = $dbs->get_all_record();
                  foreach ($groups as $group) {
                      echo '<option value="' . $group['id'] . '">' . $group['name'] . '</option>';
                  }
              ?>
          </select>
        </div>
        <?php  if(isset($error_name)){
                echo " <h5 style='color: red; margin-left:50px'>$error_name</h5>";
            }  ?>
        
        <div class="mb-3 mx-5  mt-3 " style="color: #BC8CE9; font-size: 20px; margin-top: -30px">
          <label for="price" class="form-label">Price</label>
          <input type="text" class="form-control  rounded-end" required style="background-color: rgba(0, 0, 0, 0.1); border-color: #B988E9; color:white" id="price" name="price">
        </div>

        <div class="d-flex justify-content-center">
          <button type="submit" class="btn " name="submit" style="background-color: #B988E9; border-color: #B988E9; color:white" >Submit</button>
        </div>
      </div>
    </form>
  </div>
            
    </div>


  
<?php 
    include('../includes/footer.php');
?>
