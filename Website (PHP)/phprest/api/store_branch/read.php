<?php

    // Required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    // Include config and store_branch files
    include_once '../config/config.php';
    include_once '../objects/store_branch.php';
    
    // Instantiate database and store_branch object
    $database = new Config();
    $db = $database->getConnection();
    
    // Initialize store_branch object
    $store_branch = new Store_branch($db);

    // Products Query
    $statement = $store_branch->read();
    $num = $statement->rowCount();
    
    // store_branch data exist
    if($num>0){
    
        // store_branch array
        $store_branch_arr=array();
        $store_branch_arr["store_branch"]=array();
    
        // Retrieve table data
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $store_branch_item=array(
                "branch_id" => $branch_id,
                "email" => $email,
                "phone_no" => $phone_no,
                "province" => $province,
                "city" => $city,
                "street_no" => $street_no
            );
    
            array_push($store_branch_arr["store_branch"], $store_branch_item);
        }
    
        // Set response code: 200 OK and show data in json format
        http_response_code(200);
        echo json_encode($store_branch_arr);
    }
    // No store_branch data found
    else{

        // Set response code: 404 Not found and send message
        http_response_code(404);
        echo json_encode(array("message" => "No store_branch found."));
    }
?>
