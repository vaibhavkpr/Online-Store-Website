<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and carries object
    include_once '../config/config.php';
    include_once '../objects/carries.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare carries object
    $carries = new Carries($db);
    
    // Get SKU of the carries to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set SKU of the carries to be updated
    $carries->SKU = $data->SKU;
     
    // Set carries property values
    $carries->branch_id = $data->branch_id;	
    $carries->quantity = $data->quantity;
    $carries->on_display = $data->on_display;

    // Update the carries
    if($carries->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "Carries was updated."));
    }
    
    // Unable to update the carries
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update carries."));
    }

?>