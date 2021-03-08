<?php

class Found_in{
  
    // Database connection and table name
    private $db;
    private $table_name = "found_in";
  
    // found_in properties
    public $SKU;	
    public $AID;	
    public $branch_id;	
    public $segment_of_aisle;	
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read found_ins
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one found_in
    function readOne(){
    
        // Query: Read single found_in entry using SKU
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
            $this->AID=$row['AID'];	
            $this->branch_id=$row['branch_id'];
            $this->segment_of_aisle=$row['segment_of_aisle'];
        }
    }

    // Create found_in
    function create(){

        // Check if found_in exists before creating it
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
            // Query: Insert found_in        
            $query = "INSERT INTO " .$this->table_name. " SET SKU=:SKU, AID=:AID, branch_id=:branch_id, segment_of_aisle=:segment_of_aisle";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
            $this->AID=htmlspecialchars(strip_tags($this->AID));	
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));	
            $this->segment_of_aisle=htmlspecialchars(strip_tags($this->segment_of_aisle));	
        
            // Bind values
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":AID", $this->AID);
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":segment_of_aisle", $this->segment_of_aisle);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;   
        }     
    }

    // Update found_in
    function update(){ 
        
        // Check if found_in exists before updating it
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
            // Query: Update found_in
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        AID = :AID,
                        branch_id = :branch_id,
                        segment_of_aisle = :segment_of_aisle
                    WHERE
                        SKU = :SKU";

            // Prepare query statement
            $statement = $this->db->prepare($query);
            
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
            $this->AID=htmlspecialchars(strip_tags($this->AID));	
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));	
            $this->segment_of_aisle=htmlspecialchars(strip_tags($this->segment_of_aisle));	
            
            // Bind values
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":AID", $this->AID);
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":segment_of_aisle", $this->segment_of_aisle);
                
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete found_in
    function delete(){

        // Check if found_in exists before deleting it
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
            // Query: Delete found_in
            $query = "DELETE FROM " .$this->table_name. " WHERE SKU=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
        
            // Bind SKU of the found_in to be deleted
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