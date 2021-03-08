<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and displayed_in object
    include_once '../config/config.php';
    include_once '../objects/displayed_in.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare displayed_in object
    $displayed_in = new Displayed_in($db);
    
    // Get SKU of the displayed_in to be deleted
    $displayed_in->SKU = isset($_GET['SKU']) ? $_GET['SKU'] : die();
    
    // Delete the displayed_in
    if($displayed_in->delete()){
    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "displayed_in was deleted."));
    }
    
    // Unable to delete the displayed_in
    else{
    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete displayed_in."));
    }
?>