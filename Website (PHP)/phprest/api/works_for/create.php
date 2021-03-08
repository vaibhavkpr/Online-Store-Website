works_for<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/works_for.php';
    
    // Instantiate database and works_for object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize works_for object
    $works_for = new Works_for($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->branch_id) &&
        !empty($data->SID) &&
        !empty($data->shift) 
    ){
    
        // Set works_for property values
        $works_for->branch_id = $data->branch_id;
        $works_for->SID = $data->SID;
        $works_for->shift = $data->shift;
    
        // Create the works_for
        if($works_for->create()){
    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "Works_for was created."));
        }
    
        // Unable to create the works_for
        else{
    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create works_for."));
        }
    }
    
    // User data is incomplete
    else{
     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create works_for. Data is incomplete."));
    }
?>