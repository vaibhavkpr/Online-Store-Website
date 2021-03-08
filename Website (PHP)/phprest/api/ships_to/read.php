<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and ships_to files
    include_once '../config/config.php';
    include_once '../objects/ships_to.php';
    
    // Instantiate database and ships_to object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize ships_to object
    $ships_to = new Ships_to($db);

    // ships_to Query
    $statement = $ships_to->read();
    $num = $statement->rowCount();
    
    // Ships from data exist
    if($num>0){
    
        // ships_to array
        $ships_to_arr=array();
        $ships_to_arr["ships_to"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['branch_id'] to
            // just $branch_id only
            extract($row);
    
            $ships_to_item=array(
                "customer_id" => $customer_id,	
                "order_id" => $order_id,	
                "branch_id" => $branch_id,
                "receive_date" => html_entity_decode($receive_date)
            );
    
            array_push($ships_to_arr["ships_to"], $ships_to_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($ships_to_arr);
    }
    // No ships_to data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No ships_to found."));
    }
?>