<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and places_hold object
    include_once '../config/config.php';
    include_once '../objects/places_hold.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize places_hold object
    $places_hold = new Places_hold($db);
    
    // Set SKU property of places_hold to read
    $places_hold->SKU = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
    
    // Read the details of places_hold to be modified
    $places_hold->readOne();
    
    // places_hold exists
    if($places_hold->SKU!=null){

        // Create array
        $places_hold_arr = array(
            "customer_id" => $places_hold->customer_id,	
            "SKU" => $places_hold->SKU,	
            "quantity" => $places_hold->quantity,
            "date_placed" => $places_hold->date_placed,
            "date_released" => $places_hold->date_released,	
            "price" => $places_hold->price
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($places_hold_arr);
    }
    
    // No such places_hold exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "places_hold does not exist."));
    }
?>