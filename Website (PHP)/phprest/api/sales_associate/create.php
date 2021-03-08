<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/sales_associate.php';
    
    // Instantiate database and sales_associate object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize sales_associate object
    $sales_associate = new Sales_associate($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->SID) &&
        !empty($data->first_name) &&
        !empty($data->last_name) &&
        !empty($data->username) &&
        !empty($data->password) &&
        !empty($data->section)
    ){
    
        // Set sales_associate property values
        $sales_associate->SID = $data->SID;
        $sales_associate->first_name = $data->first_name;
        $sales_associate->last_name = $data->last_name;
        $sales_associate->username = $data->username;
        $sales_associate->password = $data->password;
        $sales_associate->section = $data->section;
    
        // Create the sales_associate
        if($sales_associate->create()){
    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "sales_associate was created."));
        }
    
        // Unable to create the sales_associate
        else{
    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create sales_associate."));
        }
    }
    
    // User data is incomplete
    else{
     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create sales_associate. Data is incomplete."));
    }
?>