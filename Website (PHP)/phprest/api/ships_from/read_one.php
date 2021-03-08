<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and ships_from object
    include_once '../config/config.php';
    include_once '../objects/ships_from.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize ships_from object
    $ships_from = new Ships_from($db);
    
    // Set customer_id property of ships_from to read
    $ships_from->customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
    
    // Read the details of ships from to be modified
    $ships_from->readOne();
    
    // Ships_from exists
    if($ships_from->branch_id!=null){

        // Create array
        $ships_from_arr = array(
            "customer_id" => $ships_from->customer_id,	
            "order_id" => $ships_from->order_id,	
            "branch_id" => $ships_from->branch_id,
            "ship_date" => $ships_from->ship_date
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($ships_from_arr);
    }
    
    // No such ships_from exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "Ships_from does not exist."));
    }
?>