<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/transfer_order.php';
    
    // Instantiate database and transfer_order object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize transfer_order object
    $transfer_order = new Transfer_order($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->customer_id) &&
        !empty($data->order_id) &&
        !empty($data->date_ordered) &&
        !empty($data->invoiced)
    ){
    
        // Set transfer_order property values
        $transfer_order->customer_id = $data->customer_id;
        $transfer_order->order_id = $data->order_id;
        $transfer_order->date_ordered = $data->date_ordered;
        $transfer_order->invoiced = $data->invoiced;
    
        // Create the transfer_order
        if($transfer_order->create()){
    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "transfer_order was created."));
        }
    
        // Unable to create the transfer_order
        else{
    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create transfer_order."));
        }
    }
    
    // User data is incomplete
    else{
     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create transfer_order. Data is incomplete."));
    }
?>