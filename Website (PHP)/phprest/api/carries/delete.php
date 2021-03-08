<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and carries object
    include_once '../config/config.php';
    include_once '../objects/carries.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare carries object
    $carries = new Carries($db);
    
    // Get SKU of the carries to be deleted
    $carries->SKU = isset($_GET['SKU']) ? $_GET['SKU'] : die();
    
    // Delete the carries
    if($carries->delete()){    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "Carries was deleted."));
    }
    
    // Unable to delete the carries
    else{    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete carries."));
    }
?>