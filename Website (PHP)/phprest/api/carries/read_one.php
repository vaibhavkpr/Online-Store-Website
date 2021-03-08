<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and carries object
    include_once '../config/config.php';
    include_once '../objects/carries.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize carries object
    $carries = new Carries($db);
    
    // Set SKU property of carries to read
    $carries->SKU = isset($_GET['SKU']) ? $_GET['SKU'] : die();
    
    // Read the details of carries to be modified
    $carries->readOne();
    
    // carries exists
    if($carries->branch_id!=null){

        // Create array
        $carries_arr = array(
            "SKU" => $carries->SKU,	
            "branch_id" => $carries->branch_id,	
            "quantity" => $carries->quantity,
            "on_display" => $carries->on_display  
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($carries_arr);
    }
    
    // No such carries exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "Carries does not exist."));
    }
?>