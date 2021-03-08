<?php

class Works_for{
  
    // Database connection and table name
    private $db;
    private $table_name = "works_for";
  
    // Works_for properties
    public $branch_id;
    public $SID;
    public $shift;
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read works_for
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one works_for
    function readOne(){
    
        // Query: Read single works_for entry using SID
        $query = "SELECT * FROM " .$this->table_name. " WHERE SID=? LIMIT 0,1";
        
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);
        $statement->bindParam(1, $this->SID);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // If row found
        if($row){
            // Set values to object properties
            $branch_id->branch_id=$row['branch_id'];
            $SID->SID=$row['SID'];
            $shift->shift=$row['shift'];
        }
    }

    // Create works_for
    function create(){

        // Check if customer exists before creating it
        $check_query = "SELECT SID FROM " .$this->table_name. " WHERE SID=" .$this->SID. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->SID);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row){
            return false;
        }
        else{          
            // Query: Insert works_for        
            $query = "INSERT INTO " .$this->table_name. " SET branch_id=:branch_id, SID=:SID, shift=:shift";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));
            $this->SID=htmlspecialchars(strip_tags($this->SID));
            $this->shift=htmlspecialchars(strip_tags($this->shift));
        
            // Bind values
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":SID", $this->SID);
            $statement->bindParam(":shift", $this->shift);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;  
        }      
    }

    // Update works_for
    function update(){        

        // Check if customer exists before updating it
        $check_query = "SELECT SID FROM " .$this->table_name. " WHERE SID=" .$this->SID. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->SID);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{ 
            // Query: update works_for
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        branch_id = :branch_id,
                        shift = :shift,
                    WHERE
                        SID = :SID";

            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));
            $this->SID=htmlspecialchars(strip_tags($this->SID));
            $this->shift=htmlspecialchars(strip_tags($this->shift));
        
            // Bind values
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":SID", $this->SID);
            $statement->bindParam(":shift", $this->shift);
            
            // execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete works_for
    function delete(){

        // Check if works_for exists before deleting it
        $check_query = "SELECT SID FROM " .$this->table_name. " WHERE SID=" .$this->SID. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->SID);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{ 
            // Query: Delete customer
            $query = "DELETE FROM " .$this->table_name. " WHERE SID=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SID=htmlspecialchars(strip_tags($this->SID));
        
            // Bind SID of the customer to be deleted
            $statement->bindParam(1, $this->SID);
        
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }
}
?>
