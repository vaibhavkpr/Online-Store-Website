<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and sales_associate files
    include_once '../config/config.php';
    include_once '../objects/sales_associate.php';
    
    // Instantiate database and sales_associate object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize sales_associate object
    $sales_associate = new Sales_associate($db);

    // Products Query
    $statement = $sales_associate->read();
    $num = $statement->rowCount();
    
    // sales_associate data exist
    if($num>0){
    
        // Products array
        $sales_associate_arr=array();
        $sales_associate_arr["sales_associates"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['last_name'] to
            // just $last_name only
            extract($row);
    
            $sales_associate_item=array(
                "SID" => $SID,	
                "first_name" => $first_name,	
                "last_name" => $last_name,
                "username" => $username,
                "password" => $password,
                "section" => $section
            );
    
            array_push($sales_associate_arr["sales_associates"], $sales_associate_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($sales_associate_arr);
    }
    // No sales_associate data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No sales_associates found."));
    }
?>