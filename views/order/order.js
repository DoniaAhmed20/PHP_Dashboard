$(document).ready(function () {
    var DOMAIN = "http://localhost/working";

    $("#add").click(function (event) {
        event.preventDefault(); // Prevent the default form submission behaviorevent.preventDefault(); // Prevent the default form submission behavior
        addNewRow();
    });

    $("form").on("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission behavior
        // Handle form submission here
        // alert("Form submitted!"); // You can replace this with your actual form submission logic
    });

    $("#invoice_item").on("change", ".pid", function () {
        var tr = $(this).closest("tr");
        var pid = $(this).val();
        var plid = $("#priceListId").val(); // Get the selected price list

        $.ajax({
            url: DOMAIN + "/controller/order.php",
            method: "POST",
            dataType: "json",
            data: { getDesc: 1, id: pid },
            success: function (data) {
                tr.find(".des").val(data["description"]);
                tr.find(".pro_name").val(data["product_id"]);
                calculateTotal(tr);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        if (plid) {
            $.ajax({
                url: DOMAIN + "/controller/order.php",
                method: "POST",
                dataType: "json",
                data: { getPrice: 1, id1: pid, id2: plid },
                success: function (data) {
                    tr.find(".price").val(data["price"]);
                    calculateTotal(tr);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    $("#invoice_item").on("input", ".qty", function () {
        var tr = $(this).closest("tr");
        calculateTotal(tr);
    });

    // function calculateTotal(tr) {
    //     var qty = tr.find(".qty").val() || 0;
    //     var price = tr.find(".price").val() || 0;
    //     var total = qty * price;
    //     tr.find(".amt").html("Rs." + total);
    // }

    // function addNewRow() {
    //     $.ajax({
    //         url: DOMAIN + "/controller/order.php",
    //         method: "POST",
    //         data: { getNewOrderItem: 1 },
    //         success: function (data) {
    //             $("#invoice_item").append(data);
    //         },
    //         error: function (xhr, status, error) {
    //             console.error(xhr.responseText);
    //         }
    //     });
    // }




    function calculateTotal(tr) {
        var qty = parseFloat(tr.find(".qty").val()) || 0; // Use parseFloat to handle decimal values
        var price = parseFloat(tr.find(".price").val()) || 0; // Use parseFloat to handle decimal values
        var total = qty * price;
        tr.find(".amt").html("EGP." + total.toFixed(2)); // Use toFixed(2) to show two decimal places
    }
    
    function addNewRow() {
        $.ajax({
            url: DOMAIN + "/controller/order.php",
            method: "POST",
            data: { getNewOrderItem: 1 },
            success: function (data) {
                var newRow = $(data);
                newRow.find(".qty").val(1); // Set default quantity to 1
                newRow.find(".price").val(0); // Set default price to 0
                $("#invoice_item").append(newRow);
                var n = 0;
                $(".number").each(function(){
                    $(this).html(++n);
                })
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    








    $("#remove").click(function () {
        $("#invoice_item").children("tr:last").remove();
    });


    // order accepting



    




    $("#order_form").click(function(){
        var invoice = $("#get_order_data").serialize();
        
        $.ajax({
            url: DOMAIN + "/views/order/process.php",
            method: "POST",
            // dataType: "json",
            data: $("#get_order_data").serialize(),
            success: function (data) {
                alert(data);
                $("#get_order_data").trigger("reset");
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

    });


    

    
});
