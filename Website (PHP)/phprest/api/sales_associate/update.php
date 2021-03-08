<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and sales_associate object
    include_once '../config/config.php';
    include_once '../objects/sales_associate.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare sales_associate object
    $sales_associate = new Sales_associate($db);
    
    // Get sales_associate_id of the sales_associate to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set sales_associate_id of the sales_associate to be updated
    $sales_associate->SID = $data->SID;
     
    // Set sales_associate property values
    $sales_associate->first_name = $data->first_name;	
    $sales_associate->last_name = $data->last_name;
    $sales_associate->username = $data->username;
    $sales_associate->password = $data->password;	
    $sales_associate->section = $data->section;	

    // Update the sales_associate
    if($sales_associate->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "sales_associate was updated."));
    }
    
    // Unable to update the sales_associate
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update sales_associate."));
    }

?>