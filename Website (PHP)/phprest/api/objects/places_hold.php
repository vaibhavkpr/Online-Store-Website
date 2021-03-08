<?php

class Places_hold{
  
    // Database connection and table name
    private $db;
    private $table_name = "places_hold";
  
    // places_hold properties
    public $customer_id;	
    public $SKU;	
    public $quantity;	
    public $date_placed;	
    public $date_released;	
    public $price;	
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read places_holds
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one places_hold
    function readOne(){
    
        // Query: Read single places_hold entry using customer_id
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
            $this->SKU=$row['SKU'];	
            $this->quantity=$row['quantity'];
            $this->date_placed=$row['date_placed'];
            $this->date_released=$row['date_released'];	
            $this->price=$row['price'];
        }
    }

    // Create places_hold
    function create(){

        // Check if places_hold exists before creating it
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
            // Query: Insert places_hold        
            $query = "INSERT INTO " .$this->table_name. " SET customer_id=:customer_id, SKU=:SKU, quantity=:quantity, date_placed=:date_placed, date_released=:date_released, price=:price";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));	
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));	
            $this->date_placed=htmlspecialchars(strip_tags($this->date_placed));	
            $this->date_released=htmlspecialchars(strip_tags($this->date_released));	
            $this->price=htmlspecialchars(strip_tags($this->price));	
        
            // Bind values
            $statement->bindParam(":customer_id", $this->customer_id);
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":quantity", $this->quantity);
            $statement->bindParam(":date_placed", $this->date_placed);
            $statement->bindParam(":date_released", $this->date_released);
            $statement->bindParam(":price", $this->price);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;   
        }     
    }

    // Update places_hold
    function update(){ 
        
        // Check if places_hold exists before updating it
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
            // Query: Update places_hold
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        SKU = :SKU,
                        quantity = :quantity,
                        date_placed = :date_placed,
                        date_released = :date_released,
                        price = :price
                    WHERE
                        customer_id = :customer_id";

            // Prepare query statement
            $statement = $this->db->prepare($query);
            
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));	
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));	
            $this->date_placed=htmlspecialchars(strip_tags($this->date_placed));	
            $this->date_released=htmlspecialchars(strip_tags($this->date_released));	
            $this->price=htmlspecialchars(strip_tags($this->price));	
            
            // Bind values
            $statement->bindParam(":customer_id", $this->customer_id);
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":quantity", $this->quantity);
            $statement->bindParam(":date_placed", $this->date_placed);
            $statement->bindParam(":date_released", $this->date_released);
            $statement->bindParam(":price", $this->price);
                
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete places_hold
    function delete(){

        // Check if places_hold exists before deleting it
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
            // Query: Delete places_hold
            $query = "DELETE FROM " .$this->table_name. " WHERE customer_id=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
        
            // Bind customer_id of the places_hold to be deleted
            $statement->bindParam(1, $this->customer_id);
        
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }
}

?>