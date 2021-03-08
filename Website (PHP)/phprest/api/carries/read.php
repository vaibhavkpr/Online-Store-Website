<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and carries files
    include_once '../config/config.php';
    include_once '../objects/carries.php';
    
    // Instantiate database and carries object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize carries object
    $carries = new Carries($db);

    // carriess Query
    $statement = $carries->read();
    $num = $statement->rowCount();
    
    // carries data exist
    if($num>0){
    
        // carriess array
        $carries_arr=array();
        $carries_arr["carries"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $carries_item=array(
                "SKU" => $SKU,	
                "branch_id" => $branch_id,	
                "quantity" => $quantity,
                "on_display" => $on_display
            );
    
            array_push($carries_arr["carries"], $carries_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($carries_arr);
    }
    // No carries data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No carries found."));
    }
?>