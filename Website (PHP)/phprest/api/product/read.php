<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and product files
    include_once '../config/config.php';
    include_once '../objects/product.php';
    
    // Instantiate database and product object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize product object
    $product = new Product($db);

    // Products Query
    $statement = $product->read();
    $num = $statement->rowCount();
    
    // Product data exist
    if($num>0){
    
        // Products array
        $products_arr=array();
        $products_arr["products"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $product_item=array(
                "SKU" => $SKU,	
                "type" => $type,	
                "name" => $name,
                "description" => html_entity_decode($description),
                "additional_info" => html_entity_decode($additional_info),	
                "UPC" => $UPC,	
                "regular_price" => $regular_price,	
                "sale_price" => $sale_price,	
                "club_price" => $club_price,	
                "quantity" => $quantity
            );
    
            array_push($products_arr["products"], $product_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($products_arr);
    }
    // No product data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No products found."));
    }
?>