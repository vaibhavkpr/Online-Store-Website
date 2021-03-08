<?php

class Ships_from{
  
    // Database connection and table name
    private $db;
    private $table_name = "ships_from";
  
    // Product properties
    public $customer_id;
    public $order_id;
    public $branch_id;
    public $ship_date;
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read ships_from
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one product
    function readOne(){
    
        // Query: Read single product entry using SKU
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
            $this->order_id=$row['order_id'];
            $this->branch_id=$row['branch_id'];
            $this->ship_date=$row['ship_date'];
        }
    }

    // Create product
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
            // Query: Insert product        
            $query = "INSERT INTO " .$this->table_name. " SET customer_id=:customer_id, order_id=:order_id, branch_id=:branch_id, ship_date=:ship_date";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
            $this->order_id=htmlspecialchars(strip_tags($this->order_id));
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));
            $this->ship_date=htmlspecialchars(strip_tags($this->ship_date));
        
            // Bind values
            $statement->bindParam(":customer_id", $this->customer_id);
            $statement->bindParam(":order_id", $this->order_id);
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":ship_date", $this->ship_date);
            
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;    
        }    
    }

    // Update product
    function update(){        

        // Check if ships_from exists before creating it
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
            // Query: update product
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        order_id = :order_id,
                        branch_id = :branch_id,
                        ship_date = :ship_date,
                    WHERE
                        customer_id = :customer_id";

            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
            $this->order_id=htmlspecialchars(strip_tags($this->order_id));
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));
            $this->ship_date=htmlspecialchars(strip_tags($this->ship_date));
        
            // Bind values
            $statement->bindParam(":customer_id", $this->customer_id);
            $statement->bindParam(":order_id", $this->order_id);
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":ship_date", $this->ship_date);
            
            // execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete ships_from
    function delete(){

        // Check if ships_from exists before deleting it
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
            // Query: Delete ships_from
            $query = "DELETE FROM " .$this->table_name. " WHERE customer_id=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
        
            // Bind customer_id of the ships_from to be deleted
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
