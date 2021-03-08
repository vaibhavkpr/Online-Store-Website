<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and store_branch object
    include_once '../config/config.php';
    include_once '../objects/store_branch.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare store_branch object
    $store_branch = new Store_branch($db);
    
    // Get branch_id of the store_branch to be deleted
    $store_branch->branch_id = isset($_GET['branch_id']) ? $_GET['branch_id'] : die();
    
    // Delete the store_branch
    if($store_branch->delete()){    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "store_branch was deleted."));
    }
    
    // Unable to delete the store_branch
    else{    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete store_branch."));
    }
?>