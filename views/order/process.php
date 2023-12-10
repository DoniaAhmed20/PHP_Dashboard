<?php
// if(isset($_POST["getNewOrderItem"])){
    include ('../../controller/order.php');

    if(isset($_POST['order_date']) AND isset($_POST['code']) AND isset($_POST['customer_id']) AND isset($_POST['priceListId']) AND isset($_POST['qty']) AND isset($_POST['des']) AND isset($_POST['price']) AND isset($_POST['pid'])){
        $order_date = $_POST['order_date'];
        $code = $_POST['code'];
        $customer_id = $_POST['customer_id'];
        $priceListId = $_POST['priceListId'];

        //Now getting array from order_form
        $ar_qty = $_POST["qty"];
        $ar_des = $_POST["des"];
        $ar_price = $_POST["price"];
        $ar_pid = $_POST["pid"];
        // $ar_pro_name = $_POST["pro_name"];


        $rr = new order();
        // $res = $rr->storeCustomerOrder($order_date,$code,$product_id,$priceListId,$ar_qty,$ar_des,$ar_price);
        // var_dump($res);
        // echo $res;
        $res = $rr->storeCustomerOrder($order_date, $code, $customer_id, $priceListId,$ar_pid, $ar_qty, $ar_des, $ar_price);
        var_dump($res);
        echo $res;


    }



    
    
