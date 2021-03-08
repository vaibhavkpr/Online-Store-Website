<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/store_branch.php';
    
    // Instantiate database and store_branch object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize store_branch object
    $store_branch = new Store_branch($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->branch_id) &&
        !empty($data->email) &&
        !empty($data->phone_no) &&
        !empty($data->province) &&
        !empty($data->city) &&
        !empty($data->street_no)
    ){
    
        // Set store_branch property values
        $store_branch->branch_id = $data->branch_id;
        $store_branch->email = $data->email;
        $store_branch->phone_no = $data->phone_no;
        $store_branch->province = $data->province;
        $store_branch->city = $data->city;
        $store_branch->street_no = $data->street_no;
    
        // Create the store_branch
        if($store_branch->create()){    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "store_branch was created."));
        }
    
        // Unable to create the store_branch
        else{    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create store_branch."));
        }
    }
    
    // User data is incomplete
    else{     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create store_branch. Data is incomplete."));
    }
?>
