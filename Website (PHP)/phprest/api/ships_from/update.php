<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and ships_from object
    include_once '../config/config.php';
    include_once '../objects/ships_from.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare ships_from object
    $ships_from = new Ships_from($db);
    
    // Get customer_id of the ships_from to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set customer_id of the ships_from to be updated
    $ships_from->customer_id = $data->customer_id;
     
    // Set ships_from property values
    $ships_from->order_id = $data->order_id;	
    $ships_from->branch_id = $data->branch_id;
    $ships_from->ship_date = $data->ship_date;

    // Update the ships_from
    if($ships_from->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "ships_from was updated."));
    }
    
    // Unable to update the ships_from
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update ships_from."));
    }

?>