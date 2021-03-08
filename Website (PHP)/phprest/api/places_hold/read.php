<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and places_hold files
    include_once '../config/config.php';
    include_once '../objects/places_hold.php';
    
    // Instantiate database and places_hold object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize places_hold object
    $places_hold = new Places_hold($db);

    // places_holds Query
    $statement = $places_hold->read();
    $num = $statement->rowCount();
    
    // places_hold data exist
    if($num>0){
    
        // places_holds array
        $places_holds_arr=array();
        $places_holds_arr["places_hold"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $places_hold_item=array(
                "customer_id" => $customer_id,	
                "SKU" => $SKU,	
                "quantity" => $quantity,
                "date_placed" => $date_placed,
                "date_released" => $date_released,	
                "price" => $price
            );
    
            array_push($places_holds_arr["places_hold"], $places_hold_item);
        }    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($places_holds_arr);
    }
    // No places_hold data found
    else{
        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No places_hold found."));
    }
?>