<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and sales_associate object
    include_once '../config/config.php';
    include_once '../objects/sales_associate.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize sales_associate object
    $sales_associate = new Sales_associate($db);
    
    // Set SID property of sales_associate to read
    $sales_associate->SID = isset($_GET['SID']) ? $_GET['SID'] : die();
    
    // Read the details of sales_associate to be modified
    $sales_associate->readOne();
    
    // sales_associate exists
    if($sales_associate->last_name!=null){

        // Create array
        $sales_associate_arr = array(
            "SID" => $sales_associate->SID,	
            "first_name" => $sales_associate->first_name,	
            "last_name" => $sales_associate->last_name,
            "username" => $sales_associate->username,
            "password" => $sales_associate->password,
            "section" => $sales_associate->section	  
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($sales_associate_arr);
    }
    
    // No such sales_associate exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "sales_associate does not exist."));
    }
?>