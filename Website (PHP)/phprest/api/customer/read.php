<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and customer files
    include_once '../config/config.php';
    include_once '../objects/customer.php';
    
    // Instantiate database and customer object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize customer object
    $customer = new Customer($db);

    // customers Query
    $statement = $customer->read();
    $num = $statement->rowCount();
    
    // customer data exist
    if($num>0){
    
        // customers array
        $customers_arr=array();
        $customers_arr["customers"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $customer_item=array(
                "customer_id" => $customer_id,	
                "first_name" => $first_name,	
                "last_name" => $last_name,
                "username" => $username,
                "password" => $password,	
                "email_id" => $email_id,	
                "phone_no" => $phone_no
            );
    
            array_push($customers_arr["customers"], $customer_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($customers_arr);
    }
    // No customer data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No customers found."));
    }
?>