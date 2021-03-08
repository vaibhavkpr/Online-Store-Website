<?php

class Contains{
  
    // Database connection and table name
    private $db;
    private $table_name = "contains";
  
    // contains properties
    public $customer_id;	
    public $order_id;	
    public $SKU;	
    public $quantity;	
    public $cost;
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read contains
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one contains
    function readOne(){
    
        // Query: Read single contains entry using order_id
        $query = "SELECT * FROM " .$this->table_name. " WHERE order_id=? LIMIT 0,1";
        
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);
        $statement->bindParam(1, $this->order_id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // If row found
        if($row){
            // Set values to object properties
            $this->customer_id=$row['customer_id'];
            $this->order_id=$row['order_id'];	
            $this->SKU=$row['SKU'];
            $this->quantity=$row['quantity'];
            $this->cost=$row['cost'];
        }
    }

    // Create contains
    function create(){

        // Check if contains exists before creating it
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
            // Query: Insert contains        
            $query = "INSERT INTO " .$this->table_name. " SET customer_id=:customer_id, order_id=:order_id, SKU=:SKU, quantity=:quantity, cost=:cost";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
            $this->order_id=htmlspecialchars(strip_tags($this->order_id));	
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));	
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));	
            $this->cost=htmlspecialchars(strip_tags($this->cost));
        
            // Bind values
            $statement->bindParam(":customer_id", $this->customer_id);
            $statement->bindParam(":order_id", $this->order_id);
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":quantity", $this->quantity);
            $statement->bindParam(":cost", $this->cost);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;   
        }     
    }

    // Update contains
    function update(){ 
        
        // Check if contains exists before updating it
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
            // Query: Update contains
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        order_id = :order_id,
                        SKU = :SKU,
                        quantity = :quantity,
                        cost = :cost
                    WHERE
                        customer_id = :customer_id";

            // Prepare query statement
            $statement = $this->db->prepare($query);
            
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
            $this->order_id=htmlspecialchars(strip_tags($this->order_id));	
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));	
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));
            $this->cost=htmlspecialchars(strip_tags($this->cost));		
            
            // Bind values
            $statement->bindParam(":customer_id", $this->customer_id);
            $statement->bindParam(":order_id", $this->order_id);
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":quantity", $this->quantity);
            $statement->bindParam(":cost", $this->cost);
                
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete contains
    function delete(){

        // Check if contains exists before deleting it
        $check_query = "SELECT order_id FROM " .$this->table_name. " WHERE order_id=" .$this->order_id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->order_id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{ 
            // Query: Delete contains
            $query = "DELETE FROM " .$this->table_name. " WHERE order_id=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->order_id=htmlspecialchars(strip_tags($this->order_id));
        
            // Bind customer_id of the contains to be deleted
            $statement->bindParam(1, $this->order_id);
        
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }
}

?>