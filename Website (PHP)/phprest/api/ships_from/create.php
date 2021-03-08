<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/ships_from.php';
    
    // Instantiate database and ships_ships_from object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize ships_ships_from object
    $ships_from = new Ships_from($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->customer_id) &&
        !empty($data->order_id) &&
        !empty($data->branch_id) &&
        !empty($data->ship_date)
    ){
    
        // Set ships_from property values
        $ships_from->customer_id = $data->customer_id;
        $ships_from->order_id = $data->order_id;
        $ships_from->branch_id = $data->branch_id;
        $ships_from->ship_date = $data->ship_date;
    
        // Create the ships_from
        if($ships_from->create()){
    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "Ships_from was created."));
        }
    
        // Unable to create the ships from
        else{
    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create ships_from."));
        }
    }
    
    // User data is incomplete
    else{
     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create ships_from. Data is incomplete."));
    }
?>