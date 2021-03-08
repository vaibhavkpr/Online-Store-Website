<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and store_branch object
    include_once '../config/config.php';
    include_once '../objects/store_branch.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize store_branch object
    $store_branch = new Store_branch($db);
    
    // Set branch_id property of store_branch to read
    $store_branch->branch_id = isset($_GET['branch_id']) ? $_GET['branch_id'] : die();
    
    // Read the details of branch to be modified
    $store_branch->readOne();
    
    // store_branch exists
    if($store_branch->phone_no!=null){

        // Create array
        $store_branch_arr = array(
            "branch_id" => $store_branch->branch_id,	
            "email" => $store_branch->email,	
            "phone_no" => $store_branch->phone_no,
            "province" => $store_branch->province,
            "city" => $store_branch->city,	
            "street_no" => $store_branch->street_no,	   
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($store_branch_arr);
    }
    
    // No such store_branch exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "store_branch does not exist."));
    }
?>