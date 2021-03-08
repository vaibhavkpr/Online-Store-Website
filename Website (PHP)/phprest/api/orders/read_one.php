<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and order object
    include_once '../config/config.php';
    include_once '../objects/orders.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize order object
    $order = new Order($db);
    
    // Set SKU property of order to read
    $order->SKU = isset($_GET['SKU']) ? $_GET['SKU'] : die();
    
    // Read the details of order to be modified
    $order->readOne();
    
    // order exists
    if($order->branch_id!=null){

        // Create array
        $order_arr = array(
            "SKU" => $order->SKU,	
            "supplier_id" => $order->supplier_id,	
            "branch_id" => $order->branch_id,
            "quantity" => $order->quantity,
            "cost" => $order->cost,	
            "ship_date" => $order->ship_date,	
            "expected_receive_date" => $order->expected_receive_date  
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($order_arr);
    }
    
    // No such order exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "order does not exist."));
    }
?>