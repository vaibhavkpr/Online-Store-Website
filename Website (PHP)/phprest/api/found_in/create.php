<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/found_in.php';
    
    // Instantiate database and found_in object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize found_in object
    $found_in = new Found_in($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->SKU) &&
        !empty($data->AID) &&
        !empty($data->branch_id) &&
        !empty($data->segment_of_aisle)
    ){
    
        // Set found_in property values
        $found_in->SKU = $data->SKU;
        $found_in->AID = $data->AID;
        $found_in->branch_id = $data->branch_id;
        $found_in->segment_of_aisle = $data->segment_of_aisle;
    
        // Create the found_in
        if($found_in->create()){    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "found_in was created."));
        }
    
        // Unable to create the found_in
        else{    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create found_in."));
        }
    }
    
    // User data is incomplete
    else{     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create found_in. Data is incomplete."));
    }
?>