<?php

class Aisle{
  
    // Database connection and table name
    private $db;
    private $table_name = "aisle";
  
    // Aisle properties
    public $AID;	
    public $branch_id;	

    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read aisle
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one aisle
    function readOne(){
    
        // Query: Read single aisle entry using AID
        $query = "SELECT * FROM " .$this->table_name. " WHERE AID=? LIMIT 0,1";
        
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);
        $statement->bindParam(1, $this->AID);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // If row found
        if($row){
            // Set values to object properties
            $this->AID=$row['AID'];
            $this->branch_id=$row['branch_id'];	
        }
    }

    // Create aisle
    function create(){

        // Check if aisle exists already
        $check_query = "SELECT AID FROM " .$this->table_name. " WHERE AID=" .$this->AID. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->AID);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row){
            return false;
        }
        else{        
            // Query: Insert aisle        
            $query = "INSERT INTO " .$this->table_name. " SET AID=:AID, branch_id=:branch_id";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->AID=htmlspecialchars(strip_tags($this->AID));
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));	
        
            // Bind values
            $statement->bindParam(":AID", $this->AID);
            $statement->bindParam(":branch_id", $this->branch_id);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;
        }        
    }

    // Update aisle
    function update(){ 
        
        // Check if aisle exists before updating it
        $check_query = "SELECT AID FROM " .$this->table_name. " WHERE AID=" .$this->AID. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->AID);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{       
            // Query: Update aisle
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        branch_id = :branch_id
                    WHERE
                        AID = :AID";

            // Prepare query statement
            $statement = $this->db->prepare($query);
            
            // Clean up
            $this->AID=htmlspecialchars(strip_tags($this->AID));
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));	
            
            // Bind values
            $statement->bindParam(":AID", $this->AID);
            $statement->bindParam(":branch_id", $this->branch_id);
                
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete aisle
    function delete(){

        // Check if aisle exists before deleting it
        $check_query = "SELECT AID FROM " .$this->table_name. " WHERE AID=" .$this->AID. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->AID);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{ 
            // Query: Delete aisle
            $query = "DELETE FROM " .$this->table_name. " WHERE AID=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->AID=htmlspecialchars(strip_tags($this->AID));
        
            // Bind AID of the aisle to be deleted
            $statement->bindParam(1, $this->AID);
        
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }
}

?>