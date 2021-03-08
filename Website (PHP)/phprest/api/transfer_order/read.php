<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and transfer_order files
    include_once '../config/config.php';
    include_once '../objects/transfer_order.php';
    
    // Instantiate database and transfer_order object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize transfer_order object
    $transfer_order = new Transfer_order($db);

    // transfer_order Query
    $statement = $transfer_order->read();
    $num = $statement->rowCount();
    
    // transfer_order data exist
    if($num>0){
    
        // transfer_order array
        $transfer_order_arr=array();
        $transfer_order_arr["transfer_orders"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $transfer_order_item=array(
                "customer_id" => $customer_id,	
                "order_id" => $order_id,	
                "date_ordered" => $date_ordered,
                "invoiced" => html_entity_decode($invoiced)
            );
    
            array_push($transfer_order_arr["transfer_orders"], $transfer_order_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($transfer_order_arr);
    }
    // No transfer_order data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No transfer_order found."));
    }
?>