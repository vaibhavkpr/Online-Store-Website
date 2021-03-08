<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and displayed_in object
    include_once '../config/config.php';
    include_once '../objects/displayed_in.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize displayed_in object
    $displayed_in = new Displayed_in($db);
    
    // Set SKU property of displayed_in to read
    $displayed_in->SKU = isset($_GET['SKU']) ? $_GET['SKU'] : die();
    
    // Read the details of displayed_in to be modified
    $displayed_in->readOne();
    
    // displayed_in exists
    if($displayed_in->branch_id!=null){

        // Create array
        $displayed_in_arr = array(
            "SKU" => $displayed_in->SKU,	
            "AID" => $displayed_in->AID,	
            "branch_id" => $displayed_in->branch_id,
            "segment_of_aisle" => $displayed_in->segment_of_aisle   
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($displayed_in_arr);
    }
    
    // No such displayed_in exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "displayed_in does not exist."));
    }
?>