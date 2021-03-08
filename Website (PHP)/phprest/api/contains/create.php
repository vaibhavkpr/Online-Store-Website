<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/contains.php';
    
    // Instantiate database and contains object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize contains object
    $contains = new Contains($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->customer_id) &&
        !empty($data->order_id) &&
        !empty($data->SKU) &&
        !empty($data->quantity) &&
        !empty($data->cost)
    ){
    
        // Set contains property values
        $contains->customer_id = $data->customer_id;
        $contains->order_id = $data->order_id;
        $contains->SKU = $data->SKU;
        $contains->quantity = $data->quantity;
        $contains->cost = $data->cost;
    
        // Create the contains
        if($contains->create()){    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "contains was created."));
        }
    
        // Unable to create the contains
        else{    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create contains."));
        }
    }
    
    // User data is incomplete
    else{     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create contains. Data is incomplete."));
    }
?>