<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and contains files
    include_once '../config/config.php';
    include_once '../objects/contains.php';
    
    // Instantiate database and contains object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize contains object
    $contains = new Contains($db);

    // contains Query
    $statement = $contains->read();
    $num = $statement->rowCount();
    
    // contains data exist
    if($num>0){
    
        // contains array
        $contains_arr=array();
        $contains_arr["contains"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $contains_item=array(
                "customer_id" => $customer_id,	
                "order_id" => $order_id,	
                "SKU" => $SKU,
                "quantity" => $quantity,
                "cost" => $cost
            );
    
            array_push($contains_arr["contains"], $contains_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($contains_arr);
    }
    // No contains data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No contains found."));
    }
?>