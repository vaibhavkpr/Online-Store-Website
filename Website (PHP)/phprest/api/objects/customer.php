<?php

class Customer{
  
    // Database connection and table name
    private $db;
    private $table_name = "customer";
  
    // customer properties
    public $customer_id;	
    public $first_name;	
    public $last_name;	
    public $username;	
    public $password;	
    public $email_id;	
    public $phone_no;	
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read customers
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one customer
    function readOne(){
    
        // Query: Read single customer entry using customer_id
        $query = "SELECT * FROM " .$this->table_name. " WHERE customer_id=? LIMIT 0,1";
        
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);
        $statement->bindParam(1, $this->customer_id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // If row found
        if($row){
            // Set values to object properties
            $this->customer_id=$row['customer_id'];
            $this->first_name=$row['first_name'];	
            $this->last_name=$row['last_name'];
            $this->username=$row['username'];
            $this->password=$row['password'];	
            $this->email_id=$row['email_id'];
            $this->phone_no=$row['phone_no'];	
        }
    }

    // Create customer
    function create(){

        // Check if customer exists before creating it
        $check_query = "SELECT customer_id FROM " .$this->table_name. " WHERE customer_id=" .$this->customer_id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->customer_id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row){
            return false;
        }
        else{     
            // Query: Insert customer        
            $query = "INSERT INTO " .$this->table_name. " SET customer_id=:customer_id, first_name=:first_name, last_name=:last_name, username=:username, password=:password, email_id=:email_id, phone_no=:phone_no";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));	
            $this->last_name=htmlspecialchars(strip_tags($this->last_name));	
            $this->username=htmlspecialchars(strip_tags($this->username));	
            $this->password=htmlspecialchars(strip_tags($this->password));	
            $this->email_id=htmlspecialchars(strip_tags($this->email_id));	
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));	
        
            // Bind values
            $statement->bindParam(":customer_id", $this->customer_id);
            $statement->bindParam(":first_name", $this->first_name);
            $statement->bindParam(":last_name", $this->last_name);
            $statement->bindParam(":username", $this->username);
            $statement->bindParam(":password", $this->password);
            $statement->bindParam(":email_id", $this->email_id);
            $statement->bindParam(":phone_no", $this->phone_no);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;   
        }     
    }

    // Update customer
    function update(){ 
        
        // Check if customer exists before updating it
        $check_query = "SELECT customer_id FROM " .$this->table_name. " WHERE customer_id=" .$this->customer_id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->customer_id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{       
            // Query: Update customer
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        first_name = :first_name,
                        last_name = :last_name,
                        username = :username,
                        password = :password,
                        email_id = :email_id,
                        phone_no = :phone_no
                    WHERE
                        customer_id = :customer_id";

            // Prepare query statement
            $statement = $this->db->prepare($query);
            
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));	
            $this->last_name=htmlspecialchars(strip_tags($this->last_name));	
            $this->username=htmlspecialchars(strip_tags($this->username));	
            $this->password=htmlspecialchars(strip_tags($this->password));	
            $this->email_id=htmlspecialchars(strip_tags($this->email_id));	
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));		
            
            // Bind values
            $statement->bindParam(":customer_id", $this->customer_id);
            $statement->bindParam(":first_name", $this->first_name);
            $statement->bindParam(":last_name", $this->last_name);
            $statement->bindParam(":username", $this->username);
            $statement->bindParam(":password", $this->password);
            $statement->bindParam(":email_id", $this->email_id);
            $statement->bindParam(":phone_no", $this->phone_no);
                
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete customer
    function delete(){

        // Check if customer exists before deleting it
        $check_query = "SELECT customer_id FROM " .$this->table_name. " WHERE customer_id=" .$this->customer_id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->customer_id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{ 
            // Query: Delete customer
            $query = "DELETE FROM " .$this->table_name. " WHERE customer_id=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
        
            // Bind customer_id of the customer to be deleted
            $statement->bindParam(1, $this->customer_id);
        
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Check if given username exists in the database
    function usernameCheck(){
    
        // Query to check if username exists
        $query = "SELECT * FROM " .$this->table_name. " WHERE username=? LIMIT 0,1";
    
        // prepare the query
        $statement = $this->db->prepare( $query );
    
        // Clean up and Bind
        $this->username=htmlspecialchars(strip_tags($this->username));
        $statement->bindParam(1, $this->username);
    
        // Execute the query
        $statement->execute();
    
        // Get number of rows
        $num = $statement->rowCount();
    
        // if username exists, assign values to object properties
        if($num>0){
    
            // get record details / values
            $row = $statement->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->username = $row['username'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->password = $row['password'];
            $this->email_id = $row['email_id'];
            $this->phone_no = $row['phone_no'];
            $this->customer_id = $row['customer_id'];
    
            // Return true because username exists in the database
            return true;
        }    
        // Return false if username does not exist in the database
        return false;
    }
}

?>