<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and transfer_order object
    include_once '../config/config.php';
    include_once '../objects/transfer_order.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare transfer_order object
    $transfer_order = new Transfer_order($db);
    
    // Get customer_id of the transfer_order to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set customer_id of the transfer_order to be updated
    $transfer_order->order_id = $data->order_id;
     
    // Set transfer_order property values
    $transfer_order->customer_id = $data->customer_id;	
    $transfer_order->date_ordered = $data->date_ordered;
    $transfer_order->invoiced = $data->invoiced;	

    // Update the transfer_order
    if($transfer_order->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "transfer_order was updated."));
    }
    
    // Unable to update the transfer_order
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update transfer_order."));
    }

?>