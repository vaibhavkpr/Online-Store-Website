<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/orders.php';
    
    // Instantiate database and order object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize order object
    $order = new Order($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->SKU) &&
        !empty($data->supplier_id) &&
        !empty($data->branch_id) &&
        !empty($data->quantity) &&
        !empty($data->cost) &&
        !empty($data->ship_date) &&
        !empty($data->expected_receive_date) 
    ){
    
        // Set order property values
        $order->SKU = $data->SKU;
        $order->supplier_id = $data->supplier_id;
        $order->branch_id = $data->branch_id;
        $order->quantity = $data->quantity;
        $order->cost = $data->cost;
        $order->ship_date = $data->ship_date;
        $order->expected_receive_date = $data->expected_receive_date;
    
        // Create the order
        if($order->create()){    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "order was created."));
        }
    
        // Unable to create the order
        else{    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create order."));
        }
    }
    
    // User data is incomplete
    else{     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create order. Data is incomplete."));
    }
?>