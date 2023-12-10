<?php 
    include ('../../controller/priceList.php');
    include ('../../controller/product.php');
    $db = new priceList();
    $items = $db->get_all_record_product_price_list();
    include('../includes/header.php');
?>
    
    <div class="container-fluid px-4" >
    <div class="row">

    <hr class="my-1">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive" id='showUser'>
            <div class="d-flex justify-content-end ms-auto  ">
    <button class="btn btn-info mt-5 ms-1" style="background-color: #8487C0; border-color: #8487C0;">
        <a class="text-decoration-none text-white" href="./user_create.php">Add New User</a>
    </button>
</div>
                <table class="table table-striped table-sm table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>PriceList_name</th>
                            <th>Product_name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php



$dbs = new priceList();
$users = $dbs->get_all_record_product_price_list();

$pro = new product();
$products = $pro->get_all_record();

$price = new priceList();
$price_lists = $dbs->get_all_record();

$user_names = array();
$product_names = array();


foreach($price_lists as $price_list) {
    $user_names[$price_list["id"]] = $price_list["name"];
  }
  foreach($products as $product) {
    $product_names[$product["id"]] = $product["name"];
    // var_dump($product_names[$product["id"]]);
  }
      foreach ($users as $user) {
        // var_dump($user);
        echo '<tr><td>' . $user["id"] . '</td>
   <td>' . $user_names[$user["priceList_id"]] . '</td>
   <td>' . $product_names[$user["product_id"]] . '</td>
   <td>' . $user["price"] . '</td>
   
     <td><button class="btn " style="background-color:#D3B2B7"><a class="text-decoration-none text-black"href="user_update.php?updateId=' . $user["id"] . '" ><i class="fa fa-edit "></i></a></button>
     <button class="btn btn-danger"><a class="text-decoration-none text-black"  class="text-decoration-non text-black" href="user_delete.php?deleteId=' . $user["id"] . '" ><i class="fas fa-trash-alt"></i></a></button>
    </td></tr>';
    }
      ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- datatables -->
<script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<!-- fontawesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include DataTables CSS and JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<!-- sweetalert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("table").DataTable();
    })
</script>
<?php 
    include('../includes/footer.php');
?>
