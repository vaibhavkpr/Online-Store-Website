<?php

    session_start();

    // Initialize Variables
    $username = "";
    $first_name = "";
    $last_name = "";
    $email = "";
    $phone = "";
    $type = "";

    $errors = array();
    $login_url = "http://localhost/phprest/api/customer/login.php";
    $admin_url = "http://localhost/phprest/api/sales_associate/login.php";
    $customer_read_url = "http://localhost/phprest/api/customer/read.php";
    $customer_create_url = "http://localhost/phprest/api/customer/create.php";
    
    // Connection Variables
    $host    = "localhost";     // Host Name
    $user    = "root";          // User Name
    $pass    = "";              // User Password
    $db_name = "project";       // Name of database

    //create connection
    $db = mysqli_connect($host, $user, $pass, $db_name) or die("Failed to connect to database!");

    // Register Customers
    if(isset($_POST['registerCustomer'])){
        // Get the input data from the registration form
        $username = isset($_POST['username']) ? mysqli_real_escape_string($db, $_POST['username']) : false;
        $first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($db, $_POST['first_name']) : false;
        $last_name = isset($_POST['last_name']) ? mysqli_real_escape_string($db, $_POST['last_name']) : false;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : false;
        $phone = isset($_POST['phone']) ? mysqli_real_escape_string($db, $_POST['phone']) : false;
        $password_input = isset($_POST['password_input']) ? mysqli_real_escape_string($db, $_POST['password_input']) : false;
        $password_check = isset($_POST['password_check']) ? mysqli_real_escape_string($db, $_POST['password_check']) : false;
        $type = "customer";

        // Check if username field is blank
        if(empty($username)) {array_push($errors, "Username is a required field");}

        // Check if first_name field is blank
        if(empty($first_name)) {array_push($errors, "First Name is a required field");}

        // Check if last_name field is blank
        if(empty($last_name)) {array_push($errors, "Last Name is a required field");}

        // Check if email field is blank
        if(empty($email)) {array_push($errors, "Email is a required field");}

        // Check if password field is blank
        if(empty($password_input)) {array_push($errors, "Password is a required field");}

        // Check if password confirmation field is blank
        if(empty($password_check)) {array_push($errors, "Please confirm your password");}

        // Check if both entered passwords match
        if($password_input != $password_check) {array_push($errors, "Passwords do not match");}
        
        // Register customer if information is accurate
        if(count($errors) == 0){
           
            $ch = curl_init($customer_read_url);                                              
            curl_setopt($ch, CURLOPT_URL, $customer_read_url);                               
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $result = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $data = json_decode($result, true);
            curl_close($ch);

            $arr = (array)$data['customers'];

            $num = count($arr);

            $id_to_set = 1000 + $num;

            $data = array(
                "customer_id" => $id_to_set,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "username" => $username,
                "password" => $password_input,
                "email_id" => $email,
                "phone_no" => $phone
            );
            $data_json = json_encode($data);

            $ch = curl_init($customer_create_url);                                    
            curl_setopt($ch, CURLOPT_URL, $customer_create_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_ENCODING, "");                         
            
            $result = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $data = json_decode($result, true);
            curl_close($ch);

            if ($code == 201) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Successfully registered and logged in";
                header("location: homepage.php");
            } else {
                array_push($errors, "Incorrect details entered, try again.");
            }


        }/*

        // Check if customer exists with the same username, email or phone
        $customer_reg_query = "SELECT * FROM users WHERE username = '$username' or email_id = '$email' or phone_no = '$phone' LIMIT 1";
        $results = mysqli_query($db, $customer_reg_query);
        $customer = mysqli_fetch_assoc($results);

        if($customer){
            if($customer['username'] ===$username){
                array_push($errors, "Username already exists");
            }
            if($customer['email_id'] === $email){
                array_push($errors, "Email ID is already associated with another account");
            }
            if($customer['phone_no'] === $phone){
                array_push($errors, "Phone number is already associated with another account");
            }
        }

        // Register customer if information is accurate
        if(count($errors) == 0){
            //$password = $md5($password_input); // Encrypt Password for security
            $insert_query = "INSERT INTO users (username, first_name, last_name, password, email_id, phone_no, type) VALUES ('$username', '$first_name', '$last_name', '$password_input', '$email', '$phone', '$type')";
            mysqli_query($db, $insert_query); // Run the Query on the database
            
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Successfully Logged In";
            header("location: homepage.php");
        }*/
    }

    // Admin Login
    if(isset($_POST['loginAdmin'])){
        // Get the input data from login form
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password_input']);
        $type = "admin";

        $data = array(                                              
            "username" => $username,
            "password" => $password
        );
        $data_json = json_encode($data);

        // Check if fields are left empty
        if(empty($username)){
            array_push($errors, "Username cannot be blank!");
        }
        if(empty($password)){
            array_push($errors, "Enter a password!");
        }

        if(count($errors) == 0){

            $ch = curl_init($admin_url);                                    
            curl_setopt( $ch, CURLOPT_URL, $admin_url );
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_ENCODING, "");                         
            
            $result = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $data = json_decode($result, true);

            if ($code == 200) {
                $result = json_decode($result, true);
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Login successful";
                header("location: adminPage.php");
            } else {
                $result = json_decode($result, true);
                array_push($errors, "Incorrect 'username' or 'password' entered, try again.");
            }
        }
    }

    // Login Customers
    if(isset($_POST['loginCustomer'])){
        // Get the input data from login form
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password_input']);
        $type = "customer";

        $data = array(                                              
            "username" => $username,
            "password" => $password
        );
        $data_json = json_encode($data);

        // Check if fields are left empty
        if(empty($username)){
            array_push($errors, "Username cannot be blank!");
        }
        if(empty($password)){
            array_push($errors, "Enter a password!");
        }

        if(count($errors) == 0){

            $ch = curl_init($login_url);                                    
            curl_setopt( $ch, CURLOPT_URL, $login_url );
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_ENCODING, "");                         
            
            $result = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $data = json_decode($result, true);

            if ($code == 200) {
                $result = json_decode($result, true);
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Login successful";
                header("location: homepage.php");
            } else {
                $result = json_decode($result, true);
                array_push($errors, "Incorrect 'username' or 'password' entered, try again.");
            }
        }
    }
?>