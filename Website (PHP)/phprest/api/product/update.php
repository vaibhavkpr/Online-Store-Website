<?php
    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Include database and product object
    include_once '../config/config.php';
    include_once '../objects/product.php';
    
    // Get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Prepare product object
    $product = new Product($db);
    
    // Get SKU of the product to be updated
    $data = json_decode(file_get_contents("php://input"));

    // Set SKU of the product to be updated
    $product->SKU = $data->SKU;
     
    // Set product property values
    $product->type = $data->type;	
    $product->name = $data->name;
    $product->description = $data->description;
    $product->additional_info = $data->additional_info;	
    $product->UPC = $data->UPC;
    $product->regular_price = $data->regular_price;	
    $product->sale_price = $data->sale_price;	
    $product->club_price = $data->club_price;	
    $product->quantity = $data->quantity; 

    // Update the product
    if($product->update()){
        // set response code - 200 ok and message the user
        http_response_code(200);
        echo json_encode(array("message" => "Product was updated."));
    }
    
    // Unable to update the product
    else{    
        // set response code - 503 service unavailable and message the user
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update product."));
    }

?>