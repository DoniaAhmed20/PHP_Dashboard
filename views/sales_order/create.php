<?php 
    session_start();
    include ('../../controller/product.php');
    $db = new product();

    if (isset($_POST['submit'])) {


        $name = $_POST['name'];
        $code = $_POST['code'];
        
      
      if (empty($_POST['name']) || empty($_POST['code'])) {
        $error_message = "All fields are required";
      }
      
    //   $error_name = validateName($name);
    //   $error_email = validateEmail($email);
    //   $error_password = validatePassword($password);
    //   $error_username = validateUsername($username);
    //   if ($error_name == "" && $error_message == "" && $error_email == "" && $error_password == "" && $error_username == "") {
      
        $new_values = array(
      
          'name' => $name,
          'code' => $code

        );
        $result = $db->create();
        $_SESSION['status'] = "Created Successfully";
        header('location:show.php');
        
    
        
      }
      include('../includes/header.php'); 
?>
    
    <div class="card-body">
      <form action="orders_code.php" method="POST">
        <div class="row">
          <div class="col-md-3 mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="col-md-3 mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="1">
          </div>

          <div class="col-md-3 mb-3">
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Add </button>
          </div>
        </div>
      </form>
    </div>

  
<?php 
    include('../includes/footer.php');
?>
