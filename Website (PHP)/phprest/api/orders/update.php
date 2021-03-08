<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and order object
    include_once '../config/config.php';
    include_once '../objects/orders.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare order object
    $order = new Order($db);
    
    // Get SKU of the order to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set SKU of the order to be updated
    $order->SKU = $data->SKU;
     
    // Set order property values
    $order->supplier_id = $data->supplier_id;	
    $order->branch_id = $data->branch_id;
    $order->quantity = $data->quantity;
    $order->cost = $data->cost;	
    $order->ship_date = $data->ship_date;
    $order->expected_receive_date = $data->expected_receive_date;	

    // Update the order
    if($order->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "order was updated."));
    }
    
    // Unable to update the order
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update order."));
    }

?>