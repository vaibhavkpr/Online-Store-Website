<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and places_hold object
    include_once '../config/config.php';
    include_once '../objects/places_hold.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare places_hold object
    $places_hold = new Places_hold($db);
    
    // Get SKU of the places_hold to be deleted
    $places_hold->SKU = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
    
    // Delete the places_hold
    if($places_hold->delete()){
    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "places_hold was deleted."));
    }
    
    // Unable to delete the places_hold
    else{
    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete places_hold."));
    }
?>