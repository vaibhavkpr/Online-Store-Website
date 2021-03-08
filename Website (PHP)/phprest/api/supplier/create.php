<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/supplier.php';
    
    // Instantiate database and supplier object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize supplier object
    $supplier = new Supplier($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->id) &&
        !empty($data->name) &&
        !empty($data->phone_no) &&
        !empty($data->email)
    ){
    
        // Set supplier property values
        $supplier->id = $data->id;
        $supplier->name = $data->name;
        $supplier->phone_no = $data->phone_no;
        $supplier->email = $data->email;
    
        // Create the supplier
        if($supplier->create()){
    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "supplier was created."));
        }
    
        // Unable to create the supplier
        else{
    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create supplier."));
        }
    }
    
    // User data is incomplete
    else{
     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create supplier. Data is incomplete."));
    }
?>