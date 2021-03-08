<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and displayed_in object
    include_once '../config/config.php';
    include_once '../objects/displayed_in.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare displayed_in object
    $displayed_in = new Displayed_in($db);
    
    // Get SKU of the displayed_in to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set SKU of the displayed_in to be updated
    $displayed_in->SKU = $data->SKU;
     
    // Set displayed_in property values
    $displayed_in->AID = $data->AID;	
    $displayed_in->branch_id = $data->branch_id;
    $displayed_in->segment_of_aisle = $data->segment_of_aisle;	

    // Update the displayed_in
    if($displayed_in->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "displayed_in was updated."));
    }
    
    // Unable to update the displayed_in
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update displayed_in."));
    }

?>