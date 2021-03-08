<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/carries.php';
    
    // Instantiate database and carries object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize carries object
    $carries = new Carries($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->SKU) &&
        !empty($data->branch_id) &&
        !empty($data->quantity) &&
        !empty($data->on_display) 
    ){
    
        // Set carries property values
        $carries->SKU = $data->SKU;
        $carries->branch_id = $data->branch_id;
        $carries->quantity = $data->quantity;
        $carries->on_display = $data->on_display;
    
        // Create the carries
        if($carries->create()){    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "Carries was created."));
        }
    
        // Unable to create the carries
        else{    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create carries."));
        }
    }
    
    // User data is incomplete
    else{     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create carries. Data is incomplete."));
    }
?>