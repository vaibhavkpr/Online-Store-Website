<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/customer.php';
    
    // Instantiate database and customer object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize customer object
    $customer = new Customer($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->customer_id) &&
        !empty($data->first_name) &&
        !empty($data->last_name) &&
        !empty($data->username) &&
        !empty($data->password) &&
        !empty($data->email_id) &&
        !empty($data->phone_no) 
    ){
    
        // Set customer property values
        $customer->customer_id = $data->customer_id;
        $customer->first_name = $data->first_name;
        $customer->last_name = $data->last_name;
        $customer->username = $data->username;
        $customer->password = $data->password;
        $customer->email_id = $data->email_id;
        $customer->phone_no = $data->phone_no;
    
        // Create the customer
        if($customer->create()){    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "customer was created."));
        }
    
        // Unable to create the customer
        else{    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create customer."));
        }
    }
    
    // User data is incomplete
    else{     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create customer. Data is incomplete."));
    }
?>