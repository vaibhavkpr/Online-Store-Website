<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and aisle object
    include_once '../config/config.php';
    include_once '../objects/aisle.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize aisle object
    $aisle = new Aisle($db);
    
    // Set AID property of aisle to read
    $aisle->AID = isset($_GET['AID']) ? $_GET['AID'] : die();
    
    // Read the details of aisle to be modified
    $aisle->readOne();
    
    // Aisle exists
    if($aisle->branch_id!=null){

        // Create array
        $aisle_arr = array(
            "AID" => $aisle->AID,	
            "branch_id" => $aisle->branch_id	  
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($aisle_arr);
    }
    
    // No such aisle exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "Aisle does not exist."));
    }
?>