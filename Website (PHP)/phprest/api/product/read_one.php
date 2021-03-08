<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
    
    // Include database and product object
    include_once '../config/config.php';
    include_once '../objects/product.php';
    
    // get database connection
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize product object
    $product = new Product($db);
    
    // Set SKU property of product to read
    $product->SKU = isset($_GET['SKU']) ? $_GET['SKU'] : die();
    
    // Read the details of product to be modified
    $product->readOne();
    
    // Product exists
    if($product->name!=null){

        // Create array
        $product_arr = array(
            "SKU" => $product->SKU,	
            "type" => $product->type,	
            "name" => $product->name,
            "description" => html_entity_decode($product->description),
            "additional_info" => html_entity_decode($product->additional_info),	
            "UPC" => $product->UPC,	
            "regular_price" => $product->regular_price,	
            "sale_price" => $product->sale_price,	
            "club_price" => $product->club_price,	
            "quantity" => $product->quantity    
        );
    
        // Set response code - 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($product_arr);
    }
    
    // No such product exists
    else{
        // Set response code - 404 Not found and inform user
        http_response_code(404);
        echo json_encode(array("message" => "Product does not exist."));
    }
?>