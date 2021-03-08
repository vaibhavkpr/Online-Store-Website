<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/ships_to.php';
    
    // Instantiate database and ships_ships_to object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize ships_ships_to object
    $ships_to = new Ships_to($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->customer_id) &&
        !empty($data->order_id) &&
        !empty($data->branch_id) &&
        !empty($data->receive_date)
    ){
    
        // Set ships_to property values
        $ships_to->customer_id = $data->customer_id;
        $ships_to->order_id = $data->order_id;
        $ships_to->branch_id = $data->branch_id;
        $ships_to->receive_date = $data->receive_date;
    
        // Create the ships_to
        if($ships_to->create()){
    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "ships_to was created."));
        }
    
        // Unable to create the ships from
        else{
    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create ships_to."));
        }
    }
    
    // User data is incomplete
    else{
     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create ships_to. Data is incomplete."));
    }
?>