<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and supplier object
    include_once '../config/config.php';
    include_once '../objects/supplier.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare supplier object
    $supplier = new Supplier($db);
    
    // Get supplier_id of the supplier to be deleted
    $supplier->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    // Delete the supplier
    if($supplier->delete()){
    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "supplier was deleted."));
    }
    
    // Unable to delete the supplier
    else{
    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete supplier."));
    }
?>