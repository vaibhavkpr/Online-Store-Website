<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and transfer_order object
    include_once '../config/config.php';
    include_once '../objects/transfer_order.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize transfer_order object
    $transfer_order = new Transfer_order($db);
    
    // Set order_id property of transfer_order to read
    $transfer_order->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();
    
    // Read the details of transfer_order to be modified
    $transfer_order->readOne();
    
    // transfer_order exists
    if($transfer_order->date_ordered!=null){

        // Create array
        $transfer_order_arr = array(
            "customer_id" => $transfer_order->customer_id,	
            "order_id" => $transfer_order->order_id,	
            "date_ordered" => $transfer_order->date_ordered,
            "invoiced" => html_entity_decode($transfer_order->invoiced)
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($transfer_order_arr);
    }
    
    // No such transfer_order exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "transfer_order does not exist."));
    }
?>