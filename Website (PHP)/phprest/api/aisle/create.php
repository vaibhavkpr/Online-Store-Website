<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/aisle.php';
    
    // Instantiate database and aisle object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize aisle object
    $aisle = new Aisle($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->AID) &&
        !empty($data->branch_id)
    ){
    
        // Set aisle property values
        $aisle->AID = $data->AID;
        $aisle->branch_id = $data->branch_id;
    
        // Create the aisle
        if($aisle->create()){    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "Aisle was created."));
        }
    
        // Unable to create the aisle
        else{    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create aisle."));
        }
    }
    
    // User data is incomplete
    else{     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create aisle. Data is incomplete."));
    }
?>