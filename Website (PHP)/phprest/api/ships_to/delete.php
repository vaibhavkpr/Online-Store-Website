<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and ships_to object
    include_once '../config/config.php';
    include_once '../objects/ships_to.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare ships_to object
    $ships_to = new Ships_to($db);
    
    // Get customer_id of the ships_to to be deleted
    $ships_to->customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
    
    // Delete the ships_to
    if($ships_to->delete()){
    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "ships_to was deleted."));
    }
    
    // Unable to delete the ships_to
    else{
    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete ships_to."));
    }
?>