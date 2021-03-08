<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and works_for object
    include_once '../config/config.php';
    include_once '../objects/works_for.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize works_for object
    $works_for = new Works_for($db);
    
    // Set branch_id property of works_for to read
    $works_for->SID = isset($_GET['SID']) ? $_GET['SID'] : die();
    
    // Read the details of works_for to be modified
    $works_for->readOne();
    
    // Works_for exists
    if($works_for->branch_id!=null){

        // Create array
        $works_for_arr = array(
            "branch_id" => $works_for->branch_id,	
            "SID" => $works_for->SID,	
            "shift" => $works_for->shift 
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($works_for_arr);
    }
    
    // No such works_for exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "Works_for does not exist."));
    }
?>