<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and displayed_in files
    include_once '../config/config.php';
    include_once '../objects/displayed_in.php';
    
    // Instantiate database and displayed_in object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize displayed_in object
    $displayed_in = new Displayed_in($db);

    // displayed_ins Query
    $statement = $displayed_in->read();
    $num = $statement->rowCount();
    
    // displayed_in data exist
    if($num>0){
    
        // displayed_ins array
        $displayed_in_arr=array();
        $displayed_in_arr["displayed_in"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $displayed_in_item=array(
                "SKU" => $SKU,	
                "AID" => $AID,	
                "branch_id" => $branch_id,
                "segment_of_aisle" => $segment_of_aisle
            );
    
            array_push($displayed_in_arr["displayed_in"], $displayed_in_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($displayed_in_arr);
    }
    // No displayed_in data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No displayed_ins found."));
    }
?>