<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and ships_to object
    include_once '../config/config.php';
    include_once '../objects/ships_to.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize ships_to object
    $ships_to = new Ships_to($db);
    
    // Set customer_id property of ships_to to read
    $ships_to->customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
    
    // Read the details of ships from to be modified
    $ships_to->readOne();
    
    // ships_to exists
    if($ships_to->branch_id!=null){

        // Create array
        $ships_to_arr = array(
            "customer_id" => $ships_to->customer_id,	
            "order_id" => $ships_to->order_id,	
            "branch_id" => $ships_to->branch_id,
            "receive_date" => $ships_to->receive_date
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($ships_to_arr);
    }
    
    // No such ships_to exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "ships_to does not exist."));
    }
?>