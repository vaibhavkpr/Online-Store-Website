<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
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
    
    // Get customer_id of the contains to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set customer_id of the contains to be updated
    $contains->customer_id = $data->customer_id;
     
    // Set contains property values
    $contains->order_id = $data->order_id;	
    $contains->SKU = $data->SKU;
    $contains->quantity = $data->quantity;
    $contains->cost = $data->cost;

    // Update the contains
    if($contains->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "contains was updated."));
    }
    
    // Unable to update the contains
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update contains."));
    }

?>