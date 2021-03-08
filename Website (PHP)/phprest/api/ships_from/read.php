<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and ships_from files
    include_once '../config/config.php';
    include_once '../objects/ships_from.php';
    
    // Instantiate database and ships_from object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize ships_from object
    $ships_from = new Ships_from($db);

    // Ships_from Query
    $statement = $ships_from->read();
    $num = $statement->rowCount();
    
    // Ships from data exist
    if($num>0){
    
        // Ships_from array
        $ships_from_arr=array();
        $ships_from_arr["ships_from"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['branch_id'] to
            // just $branch_id only
            extract($row);
    
            $ships_from_item=array(
                "customer_id" => $customer_id,	
                "order_id" => $order_id,	
                "branch_id" => $branch_id,
                "ship_date" => html_entity_decode($ship_date)
            );
    
            array_push($ships_from_arr["ships_from"], $ships_from_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($ships_from_arr);
    }
    // No ships_from data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No ships_from found."));
    }
?>