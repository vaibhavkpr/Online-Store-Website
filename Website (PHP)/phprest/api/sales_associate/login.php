<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/sales_associate.php';
    
    // Instantiate database and sales_associate object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize customer object
    $sales_associate = new Sales_associate($db);

    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
 
    // Set property values
    $sales_associate->username = $data->username;
    $username_check = $sales_associate->usernameCheck();

    // Check if username exists and if password is correct
    if($username_check && $data->password == $sales_associate->password){    
        // set response code
        http_response_code(200);
        echo json_encode(array("message" => "Login successful."));   
    }
    // login failed
    else{     
        // set response code and message user
        http_response_code(401);
        echo json_encode(array("message" => "Login failed."));
    }

?>