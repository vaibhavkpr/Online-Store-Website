<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
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
    
    // Get order_id of the transfer_order to be deleted
    $transfer_order->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();
    
    // Delete the transfer_order
    if($transfer_order->delete()){
    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "transfer_order was deleted."));
    }
    
    // Unable to delete the transfer_order
    else{
    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete transfer_order."));
    }
?>