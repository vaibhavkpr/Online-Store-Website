<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/places_hold.php';
    
    // Instantiate database and places_hold object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize places_hold object
    $places_hold = new Places_hold($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->customer_id) &&
        !empty($data->SKU) &&
        !empty($data->quantity) &&
        !empty($data->date_placed) &&
        !empty($data->date_released) &&
        !empty($data->price)
    ){
    
        // Set places_hold property values
        $places_hold->customer_id = $data->customer_id;
        $places_hold->SKU = $data->SKU;
        $places_hold->quantity = $data->quantity;
        $places_hold->date_placed = $data->date_placed;
        $places_hold->date_released = $data->date_released;
        $places_hold->price = $data->price;
    
        // Create the places_hold
        if($places_hold->create()){    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "places_hold was created."));
        }
    
        // Unable to create the places_hold
        else{    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create places_hold."));
        }
    }
    
    // User data is incomplete
    else{     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create places_hold. Data is incomplete."));
    }
?>