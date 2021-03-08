<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and found_in object
    include_once '../config/config.php';
    include_once '../objects/found_in.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare found_in object
    $found_in = new Found_in($db);
    
    // Get SKU of the found_in to be deleted
    $found_in->SKU = isset($_GET['SKU']) ? $_GET['SKU'] : die();
    
    // Delete the found_in
    if($found_in->delete()){
    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "found_in was deleted."));
    }
    
    // Unable to delete the found_in
    else{
    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete found_in."));
    }
?>