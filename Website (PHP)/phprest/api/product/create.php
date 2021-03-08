<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include config and project files
    include_once '../config/config.php';
    include_once '../objects/product.php';
    
    // Instantiate database and product object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize product object
    $product = new Product($db);
    
    // Get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // Check whether data is not empty
    if(
        !empty($data->SKU) &&
        !empty($data->type) &&
        !empty($data->name) &&
        !empty($data->description) &&
        !empty($data->additional_info) &&
        !empty($data->UPC) &&
        !empty($data->regular_price) &&
        !empty($data->sale_price) &&
        !empty($data->club_price) &&
        !empty($data->quantity) 
    ){
    
        // Set product property values
        $product->SKU = $data->SKU;
        $product->type = $data->type;
        $product->name = $data->name;
        $product->description = $data->description;
        $product->additional_info = $data->additional_info;
        $product->UPC = $data->UPC;
        $product->regular_price = $data->regular_price;
        $product->sale_price = $data->sale_price;
        $product->club_price = $data->club_price;
        $product->quantity = $data->quantity;
    
        // Create the product
        if($product->create()){
    
            // Set response code - 201 created and send response message
            http_response_code(201);
            echo json_encode(array("message" => "Product was created."));
        }
    
        // Unable to create the product
        else{
    
            // Set response code - 503 service unavailable and send response message
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create product."));
        }
    }
    
    // User data is incomplete
    else{
     
        // Set response code - 400 bad request and send response message
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
    }
?>