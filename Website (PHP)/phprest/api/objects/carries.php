<?php

class Carries{
  
    // Database connection and table name
    private $db;
    private $table_name = "carries";
  
    // Carries properties
    public $SKU;	
    public $branch_id;	
    public $quantity;	
    public $on_display;	
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read Carries
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one carries
    function readOne(){
    
        // Query: Read single carries entry using SKU
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
            $this->branch_id=$row['branch_id'];	
            $this->quantity=$row['quantity'];
            $this->on_display=$row['on_display'];
        }
    }

    // Create carries
    function create(){

        // Check if carries exists before creating it
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
            // Query: Insert carries        
            $query = "INSERT INTO " .$this->table_name. " SET SKU=:SKU, branch_id=:branch_id, quantity=:quantity, on_display=:on_display";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));	
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));	
            $this->on_display=htmlspecialchars(strip_tags($this->on_display));	
        
            // Bind values
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":quantity", $this->quantity);
            $statement->bindParam(":on_display", $this->on_display);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;   
        }     
    }

    // Update carries
    function update(){ 
        
        // Check if carries exists before updating it
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
            // Query: Update carries
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        branch_id = :branch_id,
                        quantity = :quantity,
                        on_display = :on_display
                    WHERE
                        SKU = :SKU";

            // Prepare query statement
            $statement = $this->db->prepare($query);
            
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));	
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));	
            $this->on_display=htmlspecialchars(strip_tags($this->on_display));	
            
            // Bind values
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":quantity", $this->quantity);
            $statement->bindParam(":on_display", $this->on_display);
                
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete carries
    function delete(){

        // Check if carries exists before deleting it
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
            // Query: Delete carries
            $query = "DELETE FROM " .$this->table_name. " WHERE SKU=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
        
            // Bind SKU of the carries to be deleted
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