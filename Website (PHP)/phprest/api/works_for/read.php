<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and works_for files
    include_once '../config/config.php';
    include_once '../objects/works_for.php';
    
    // Instantiate database and works_for object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize works_for object
    $works_for = new Works_for($db);

    // Works_for Query
    $statement = $works_for->read();
    $num = $statement->rowCount();
    
    // Works_for data exist
    if($num>0){
    
        // Works_for array
        $works_for_arr=array();
        $works_for_arr["works_for"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $works_for_item=array(
                "branch_id" => $branch_id,	
                "SID" => $SID,	
                "shift" => html_entity_decode($shift)
            );
    
            array_push($works_for_arr["works_for"], $works_for_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($works_for_arr);
    }
    // No works_for data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No works_for found."));
    }
?>