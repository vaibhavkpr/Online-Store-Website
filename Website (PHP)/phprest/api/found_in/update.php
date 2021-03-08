<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and found_in object
    include_once '../config/config.php';
    include_once '../objects/found_in.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare found_in object
    $found_in = new Found_in($db);
    
    // Get SKU of the found_in to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set SKU of the found_in to be updated
    $found_in->SKU = $data->SKU;
     
    // Set found_in property values
    $found_in->AID = $data->AID;	
    $found_in->branch_id = $data->branch_id;
    $found_in->segment_of_aisle = $data->segment_of_aisle;	

    // Update the found_in
    if($found_in->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "found_in was updated."));
    }
    
    // Unable to update the found_in
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update found_in."));
    }

?>