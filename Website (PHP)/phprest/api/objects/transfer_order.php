<?php

class Transfer_order{
  
    // Database connection and table name
    private $db;
    private $table_name = "transfer_order";
  
    // Transfer_order properties
    public $customer_id;
    public $order_id;
    public $date_ordered;
    public $invoiced;
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read transfer
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);
        $statement->execute();
    
        return $statement;
    }

    // Read one transfer
    function readOne(){
    
        // Query: Read single transfer entry using SKU
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
            $this->date_ordered=$row['date_ordered'];
            $this->invoiced=$row['invoiced'];
        }
    }

    // Create transfer
    function create(){

        // Check if customer exists before creating it
        $check_query = "SELECT order_id FROM " .$this->table_name. " WHERE order_id=" .$this->order_id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->order_id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row){
            return false;
        }
        else{     
            // Query: Insert transfer
            $query = "INSERT INTO " .$this->table_name. " SET customer_id=:customer_id, order_id=:order_id, date_ordered=:date_ordered, invoiced=:invoiced";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
            $this->order_id=htmlspecialchars(strip_tags($this->order_id));
            $this->date_ordered=htmlspecialchars(strip_tags($this->date_ordered));
            $this->invoiced=htmlspecialchars(strip_tags($this->invoiced));
        
            // Bind values
            $statement->bindParam(":customer_id", $this->customer_id);
            $statement->bindParam(":order_id", $this->order_id);
            $statement->bindParam(":date_ordered", $this->date_ordered);
            $statement->bindParam(":invoiced", $this->invoiced);
            
            // Execute query
            if($statement->execute()){
                return true;
            }
            return false;
        }
    }

    // Update transfer
    function update(){

        // Check if customer exists before updating it
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
            // Query: update transfer
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        order_id = :order_id,
                        date_ordered = :date_ordered,
                        invoiced = :invoiced,
                    WHERE
                        customer_id = :customer_id";

            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));
            $this->order_id=htmlspecialchars(strip_tags($this->order_id));
            $this->date_ordered=htmlspecialchars(strip_tags($this->date_ordered));
            $this->invoiced=htmlspecialchars(strip_tags($this->invoiced));
        
            // Bind values
            $statement->bindParam(":customer_id", $this->customer_id);
            $statement->bindParam(":order_id", $this->order_id);
            $statement->bindParam(":date_ordered", $this->date_ordered);
            $statement->bindParam(":invoiced", $this->invoiced);
            
            // execute the query
            if($statement->execute()){
                return true;
            }
            return false;
        }
    }

    // Delete transfer_order
    function delete(){

        // Check if transfer_order exists before deleting it
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
            // Query: Delete transfer_order
            $query = "DELETE FROM " .$this->table_name. " WHERE order_id=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->order_id=htmlspecialchars(strip_tags($this->order_id));
        
            // Bind order_id of the transfer_order to be deleted
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
