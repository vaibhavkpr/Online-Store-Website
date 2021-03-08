<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and contains object
    include_once '../config/config.php';
    include_once '../objects/contains.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare contains object
    $contains = new Contains($db);
    
    // Get customer_id of the contains to be deleted
    $contains->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();
    
    // Delete the contains
    if($contains->delete()){    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "contains was deleted."));
    }
    
    // Unable to delete the contains
    else{    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete contains."));
    }
?>