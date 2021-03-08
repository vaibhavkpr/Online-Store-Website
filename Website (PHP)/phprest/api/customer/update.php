<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and customer object
    include_once '../config/config.php';
    include_once '../objects/customer.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare customer object
    $customer = new Customer($db);
    
    // Get customer_id of the customer to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set customer_id of the customer to be updated
    $customer->customer_id = $data->customer_id;
     
    // Set customer property values
    $customer->first_name = $data->first_name;	
    $customer->last_name = $data->last_name;
    $customer->username = $data->username;
    $customer->password = $data->password;	
    $customer->email_id = $data->email_id;
    $customer->phone_no = $data->phone_no;	

    // Update the customer
    if($customer->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "customer was updated."));
    }
    
    // Unable to update the customer
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update customer."));
    }

?>