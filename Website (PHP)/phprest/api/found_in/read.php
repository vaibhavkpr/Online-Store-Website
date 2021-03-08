<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and found_in files
    include_once '../config/config.php';
    include_once '../objects/found_in.php';
    
    // Instantiate database and found_in object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize found_in object
    $found_in = new Found_in($db);

    // found_ins Query
    $statement = $found_in->read();
    $num = $statement->rowCount();
    
    // found_in data exist
    if($num>0){
    
        // found_ins array
        $found_in_arr=array();
        $found_in_arr["found_in"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $found_in_item=array(
                "SKU" => $SKU,	
                "AID" => $AID,	
                "branch_id" => $branch_id,
                "segment_of_aisle" => $segment_of_aisle
            );
    
            array_push($found_in_arr["found_in"], $found_in_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($found_in_arr);
    }
    // No found_in data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No found_ins found."));
    }
?>