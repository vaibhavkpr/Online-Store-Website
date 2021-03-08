<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and supplier files
    include_once '../config/config.php';
    include_once '../objects/supplier.php';
    
    // Instantiate database and supplier object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize supplier object
    $supplier = new Supplier($db);

    // Supplier Query
    $statement = $supplier->read();
    $num = $statement->rowCount();
    
    // Supplier data exist
    if($num>0){
    
        // Supplier array
        $supplier_arr=array();
        $supplier_arr["suppliers"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['phone_no'] to
            // just $phone_no only
            extract($row);
    
            $supplier_item=array(
                "id" => $id,	
                "name" => $name,	
                "phone_no" => $phone_no,
                "email" => html_entity_decode($email)
            );
    
            array_push($supplier_arr["suppliers"], $supplier_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($supplier_arr);
    }
    // No supplier data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No suppliers found."));
    }
?>