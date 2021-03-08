<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and places_hold object
    include_once '../config/config.php';
    include_once '../objects/places_hold.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare places_hold object
    $places_hold = new Places_hold($db);
    
    // Get customer_id of the places_hold to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set customer_id of the places_hold to be updated
    $places_hold->customer_id = $data->customer_id;
     
    // Set places_hold property values
    $places_hold->SKU = $data->SKU;	
    $places_hold->quantity = $data->quantity;
    $places_hold->date_placed = $data->date_placed;
    $places_hold->date_released = $data->date_released;	
    $places_hold->price = $data->price;

    // Update the places_hold
    if($places_hold->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "places_hold was updated."));
    }
    
    // Unable to update the places_hold
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update places_hold."));
    }

?>