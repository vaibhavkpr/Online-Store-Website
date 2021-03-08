<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and supplier object
    include_once '../config/config.php';
    include_once '../objects/supplier.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize supplier object
    $supplier = new Supplier($db);
    
    // Set id property of supplier to read
    $supplier->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    // Read the details of supplier to be modified
    $supplier->readOne();
    
    // Supplier exists
    if($supplier->name!=null){

        // Create array
        $supplier_arr = array(
            "id" => $supplier->id,	
            "name" => $supplier->name,	
            "phone_no" => $supplier->phone_no,
            "email" => html_entity_decode($supplier->email)
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($supplier_arr);
    }
    
    // No such supplier exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "Supplier does not exist."));
    }
?>