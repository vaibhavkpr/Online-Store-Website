<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and aisle files
    include_once '../config/config.php';
    include_once '../objects/aisle.php';
    
    // Instantiate database and aisle object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize aisle object
    $aisle = new Aisle($db);

    // Aisles Query
    $statement = $aisle->read();
    $num = $statement->rowCount();
    
    // Aisle data exist
    if($num>0){
    
        // Aisles array
        $aisles_arr=array();
        $aisles_arr["aisles"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){

            extract($row);
    
            $aisle_item=array(
                "AID" => $AID,	
                "branch_id" => $branch_id	
            );
    
            array_push($aisles_arr["aisles"], $aisle_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($aisles_arr);
    }
    // No aisle data found
    else{
        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No aisles found."));
    }
?>