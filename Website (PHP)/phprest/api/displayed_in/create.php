<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/displayed_in.php';
    
    // Instantiate database and displayed_in object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize displayed_in object
    $displayed_in = new Displayed_in($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->SKU) &&
        !empty($data->AID) &&
        !empty($data->branch_id) &&
        !empty($data->segment_of_aisle)
    ){
    
        // Set displayed_in property values
        $displayed_in->SKU = $data->SKU;
        $displayed_in->AID = $data->AID;
        $displayed_in->branch_id = $data->branch_id;
        $displayed_in->segment_of_aisle = $data->segment_of_aisle;
    
        // Create the displayed_in
        if($displayed_in->create()){    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "displayed_in was created."));
        }
    
        // Unable to create the displayed_in
        else{    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create displayed_in."));
        }
    }
    
    // User data is incomplete
    else{     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create displayed_in. Data is incomplete."));
    }
?>