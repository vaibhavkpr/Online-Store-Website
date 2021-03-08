<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and aisle object
    include_once '../config/config.php';
    include_once '../objects/aisle.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare aisle object
    $aisle = new Aisle($db);
    
    // Get AID of the aisle to be deleted
    $aisle->AID = isset($_GET['AID']) ? $_GET['AID'] : die();
    
    // Delete the aisle
    if($aisle->delete()){    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "Aisle was deleted."));
    }
    
    // Unable to delete the aisle
    else{    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete aisle."));
    }
?>