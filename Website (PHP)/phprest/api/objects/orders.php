<?php

class Order{
  
    // Database connection and table name
    private $db;
    private $table_name = "orders";
  
    // order properties
    public $SKU;	
    public $supplier_id;	
    public $branch_id;	
    public $quantity;	
    public $cost;	
    public $ship_date;	
    public $expected_receive_date;	
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read orders
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one order
    function readOne(){
    
        // Query: Read single order entry using SKU
        $query = "SELECT * FROM " .$this->table_name. " WHERE SKU=? LIMIT 0,1";
        
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);
        $statement->bindParam(1, $this->SKU);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // If row found
        if($row){
            // Set values to object properties
            $this->SKU=$row['SKU'];
            $this->supplier_id=$row['supplier_id'];	
            $this->branch_id=$row['branch_id'];
            $this->quantity=$row['quantity'];
            $this->cost=$row['cost'];	
            $this->ship_date=$row['ship_date'];
            $this->expected_receive_date=$row['expected_receive_date'];	
        }
    }

    // Create order
    function create(){

        // Check if order exists before creating it
        $check_query = "SELECT SKU FROM " .$this->table_name. " WHERE SKU=" .$this->SKU. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->SKU);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row){
            return false;
        }
        else{     
            // Query: Insert order        
            $query = "INSERT INTO " .$this->table_name. " SET SKU=:SKU, supplier_id=:supplier_id, branch_id=:branch_id, quantity=:quantity, cost=:cost, ship_date=:ship_date, expected_receive_date=:expected_receive_date";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
            $this->supplier_id=htmlspecialchars(strip_tags($this->supplier_id));	
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));	
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));	
            $this->cost=htmlspecialchars(strip_tags($this->cost));	
            $this->ship_date=htmlspecialchars(strip_tags($this->ship_date));	
            $this->expected_receive_date=htmlspecialchars(strip_tags($this->expected_receive_date));	
        
            // Bind values
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":supplier_id", $this->supplier_id);
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":quantity", $this->quantity);
            $statement->bindParam(":cost", $this->cost);
            $statement->bindParam(":ship_date", $this->ship_date);
            $statement->bindParam(":expected_receive_date", $this->expected_receive_date);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;   
        }     
    }

    // Update order
    function update(){ 
        
        // Check if order exists before updating it
        $check_query = "SELECT SKU FROM " .$this->table_name. " WHERE SKU=" .$this->SKU. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->SKU);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{       
            // Query: Update order
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        supplier_id = :supplier_id,
                        branch_id = :branch_id,
                        quantity = :quantity,
                        cost = :cost,
                        ship_date = :ship_date,
                        expected_receive_date = :expected_receive_date
                    WHERE
                        SKU = :SKU";

            // Prepare query statement
            $statement = $this->db->prepare($query);
            
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
            $this->supplier_id=htmlspecialchars(strip_tags($this->supplier_id));	
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));	
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));	
            $this->cost=htmlspecialchars(strip_tags($this->cost));	
            $this->ship_date=htmlspecialchars(strip_tags($this->ship_date));	
            $this->expected_receive_date=htmlspecialchars(strip_tags($this->expected_receive_date));	
            
            // Bind values
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":supplier_id", $this->supplier_id);
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":quantity", $this->quantity);
            $statement->bindParam(":cost", $this->cost);
            $statement->bindParam(":ship_date", $this->ship_date);
            $statement->bindParam(":expected_receive_date", $this->expected_receive_date);
                
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete order
    function delete(){

        // Check if order exists before deleting it
        $check_query = "SELECT SKU FROM " .$this->table_name. " WHERE SKU=" .$this->SKU. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->SKU);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{ 
            // Query: Delete order
            $query = "DELETE FROM " .$this->table_name. " WHERE SKU=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
        
            // Bind SKU of the order to be deleted
            $statement->bindParam(1, $this->SKU);
        
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }
}

?>