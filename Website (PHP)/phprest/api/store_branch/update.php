<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and store_branch object
    include_once '../config/config.php';
    include_once '../objects/store_branch.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare store_branch object
    $store_branch = new Store_branch($db);
    
    // Get SKU of the store_branch to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set SKU of the store_branch to be updated
    $store_branch->branch_id = $data->branch_id;
     
    // Set store_branch property values
    $store_branch->email = $data->email;	
    $store_branch->phone_no = $data->phone_no;
    $store_branch->province = $data->province;
    $store_branch->city = $data->city;	
    $store_branch->street_no = $data->street_no;

    // Update the store_branch
    if($store_branch->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "store_branch was updated."));
    }
    
    // Unable to update the store_branch
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update store_branch."));
    }

?>