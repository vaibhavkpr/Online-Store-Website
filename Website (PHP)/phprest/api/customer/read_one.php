<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and customer object
    include_once '../config/config.php';
    include_once '../objects/customer.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize customer object
    $customer = new Customer($db);
    
    // Set customer_id property of customer to read
    $customer->customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
    
    // Read the details of customer to be modified
    $customer->readOne();
    
    // customer exists
    if($customer->username!=null){

        // Create array
        $customer_arr = array(
            "customer_id" => $customer->customer_id,	
            "first_name" => $customer->first_name,	
            "last_name" => $customer->last_name,
            "username" => $customer->username,
            "password" =>$customer->password,	
            "email_id" => $customer->email_id,	
            "phone_no" => $customer->phone_no    
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($customer_arr);
    }
    
    // No such customer exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "customer does not exist."));
    }
?>