<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and contains object
    include_once '../config/config.php';
    include_once '../objects/contains.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize contains object
    $contains = new Contains($db);
    
    // Set order_id property of contains to read
    $contains->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();
    
    // Read the details of contains to be modified
    $contains->readOne();
    
    // contains exists
    if($contains->customer_id!=null){

        // Create array
        $contains_arr = array(
            "customer_id" => $contains->customer_id,	
            "order_id" => $contains->order_id,	
            "SKU" => $contains->SKU,
            "customer_id" => $contains->customer_id,
            "quantity" => $contains->quantity,
            "cost" => $contains->cost  
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($contains_arr);
    }
    
    // No such contains exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "Contains does not exist."));
    }
?>