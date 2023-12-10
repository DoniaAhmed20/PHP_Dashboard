<?php 
    include ('../../controller/order.php');
    include ('../../controller/customer.php');
    include_once '../../controller/priceList.php';
    include_once '../../controller/product.php';
    $db = new order();
    $items = $db->get_all_record();
    
    //  Check if the showId parameter is set in the URL
if (isset($_GET['showId'])) {
    $orderId = $_GET['showId'];

    // Fetch order details by ID
    $orderDb = new order();
    $orderDetails = $orderDb->get_record_by_id($orderId);

    // Fetch customer details
    $customerDb = new customer();
    $customerDetails = $customerDb->get_record_by_id($orderDetails['customer_id']);

    // Fetch price list details
    $priceListDb = new priceList();
    $priceListDetails = $priceListDb->get_record_by_iid($orderDetails['priceList_id']);
} else {
    // Redirect to the main page if showId is not set
    header('Location: index.php');
    exit();
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
            <div class="table-responsive" id='showUser'>
            <div class="d-flex justify-content-end ms-auto  ">
                <button class="btn btn-info mt-5 ms-1" style="background-color: #8487C0; border-color: #8487C0;">
                    <a class="text-decoration-none text-white" href="./create.php">Add New Order</a>
                </button>
            </div>
                <table class="table table-striped table-sm table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Order Code</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php



$dbs = new order();
$order_detailes = $dbs->get_all_order_detailes();
$orders = $dbs->get_all_record();


$productDb = new product();
$products = $productDb->get_all_record();

$ordersNames = array();
foreach ($orders as $order) {
    $ordersNames[$order["id"]] = $order["code"];
}

$productsNames = array();
foreach ($products as $product) {
    $productsNames[$product["id"]] = $product["name"];
}
      foreach ($order_detailes as $order_detaile) {
        echo '<tr><td>' . $order_detaile["id"] . '</td>
   
   <td>' . (isset($ordersNames[$order_detaile["order_code"]]) ? $ordersNames[$order_detaile["order_code"]] : '') . '</td>
   <td>' . (isset($productsNames[$order_detaile["product_id"]]) ? $productsNames[$order_detaile["product_id"]] : '') . '</td>
   <td>' . $order_detaile["price"] . '</td>
   <td>' . $order_detaile["quantity"] . '</td>
   
     <td>
     </button>
            <button class="btn btn-info">
                <a class="text-decoration-none text-white" href="show.php?showId=' . $order_detaile["id"] . '">
                <i class="fa fa-eye" style="font-size:17px"></i>
                </a>
            </button>
     <button class="btn " style="background-color:#66CDAA"><a class="text-decoration-none text-black"href="user_update.php?updateId=' . $order_detaile["id"] . '" ><i class="fa fa-edit "></i></a></button>
     
     <button class="btn btn-danger"><a class="text-decoration-none text-black"  class="text-decoration-non text-black" href="user_delete.php?deleteId=' . $order_detaile["id"] . '" ><i class="fas fa-trash-alt"></i></a></button>
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
