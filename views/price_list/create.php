<?php 
    session_start();
    include ('../../controller/priceList.php');
    $db = new priceList();

    if (isset($_POST['submit'])) {


        $name = $_POST['name'];
        $code = $_POST['code'];
        // $description = $_POST['description'];
        
      
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
          // 'description' => $description

        );
        $result = $db->create();
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
        
       

        <div class="mb-3 mx-5  mt-3 " style="color: #BC8CE9; font-size: 20px; margin-top: -30px">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control  rounded-end" required style="background-color: rgba(0, 0, 0, 0.1); border-color: #B988E9; color:white" id="name" name="name">
        </div>
        <?php  if(isset($error_name)){
                echo " <h5 style='color: red; margin-left:50px'>$error_name</h5>";
            }  ?>
        
        <div class="mb-3 mx-5 mt-3 " style="color: #BC8CE9; font-size: 20px; margin-top: -30px">
          <label for="code" class="form-label">Code</label>
          <input type="text" class="form-control  rounded-end" required id="code" style="background-color: rgba(0, 0, 0, 0.1); border-color: #B988E9; color:white" name="code">
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
