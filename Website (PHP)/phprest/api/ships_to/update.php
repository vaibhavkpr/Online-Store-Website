<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and ships_to object
    include_once '../config/config.php';
    include_once '../objects/ships_to.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare ships_to object
    $ships_to = new Ships_to($db);
    
    // Get customer_id of the ships_to to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set customer_id of the ships_to to be updated
    $ships_to->customer_id = $data->customer_id;
     
    // Set ships_to property values
    $ships_to->order_id = $data->order_id;	
    $ships_to->branch_id = $data->branch_id;
    $ships_to->receive_date = $data->receive_date;

    // Update the ships_to
    if($ships_to->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "ships_to was updated."));
    }
    
    // Unable to update the ships_to
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update ships_to."));
    }

?>