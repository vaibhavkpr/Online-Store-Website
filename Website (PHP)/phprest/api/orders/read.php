<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and order files
    include_once '../config/config.php';
    include_once '../objects/orders.php';
    
    // Instantiate database and order object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize order object
    $order = new Order($db);

    // orders Query
    $statement = $order->read();
    $num = $statement->rowCount();
    
    // order data exist
    if($num>0){
    
        // orders array
        $orders_arr=array();
        $orders_arr["orders"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $order_item=array(
                "SKU" => $SKU,	
                "supplier_id" => $supplier_id,	
                "branch_id" => $branch_id,
                "quantity" => $quantity,
                "cost" => $cost,	
                "ship_date" => $ship_date,	
                "expected_receive_date" => $expected_receive_date
            );
    
            array_push($orders_arr["orders"], $order_item);
        }    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($orders_arr);
    }
    // No order data found
    else{
        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No orders found."));
    }
?>