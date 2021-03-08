<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and found_in object
    include_once '../config/config.php';
    include_once '../objects/found_in.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize found_in object
    $found_in = new Found_in($db);
    
    // Set SKU property of found_in to read
    $found_in->SKU = isset($_GET['SKU']) ? $_GET['SKU'] : die();
    
    // Read the details of found_in to be modified
    $found_in->readOne();
    
    // found_in exists
    if($found_in->branch_id!=null){

        // Create array
        $found_in_arr = array(
            "SKU" => $found_in->SKU,	
            "AID" => $found_in->AID,	
            "branch_id" => $found_in->branch_id,
            "segment_of_aisle" => $found_in->segment_of_aisle   
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($found_in_arr);
    }
    
    // No such found_in exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "found_in does not exist."));
    }
?>