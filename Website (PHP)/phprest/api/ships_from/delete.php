<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and ships_from object
    include_once '../config/config.php';
    include_once '../objects/ships_from.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare ships_from object
    $ships_from = new Ships_from($db);
    
    // Get customer_id of the ships_from to be deleted
    $ships_from->customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
    
    // Delete the ships_from
    if($ships_from->delete()){
    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "ships_from was deleted."));
    }
    
    // Unable to delete the ships_from
    else{
    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete ships_from."));
    }
?>