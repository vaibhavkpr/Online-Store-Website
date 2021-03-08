<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and customer object
    include_once '../config/config.php';
    include_once '../objects/customer.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare customer object
    $customer = new Customer($db);
    
    // Get customer_id of the customer to be deleted
    $customer->customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
    
    // Delete the customer
    if($customer->delete()){
    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "customer was deleted."));
    }
    
    // Unable to delete the customer
    else{
    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete customer."));
    }
?>