<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and sales_associate object
    include_once '../config/config.php';
    include_once '../objects/sales_associate.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare sales_associate object
    $sales_associate = new Sales_associate($db);
    
    // Get sales_associate_id of the sales_associate to be deleted
    $sales_associate->SID = isset($_GET['SID']) ? $_GET['SID'] : die();
    
    // Delete the sales_associate
    if($sales_associate->delete()){
    
        // Set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "sales_associate was deleted."));
    }
    
    // Unable to delete the sales_associate
    else{
    
        // Set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete sales_associate."));
    }
?>