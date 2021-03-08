<?php

class Store_branch{
  
    // Database connection and table name
    private $db;
    private $table_name = "store_branch";
  
    // Branch properties
    public $branch_id;
    public $email;
    public $phone_no;
    public $province;
    public $city;
    public $street_no;
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read branch
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one
    function readOne(){
    
        // Query: Read single entry using branch_id
        $query = "SELECT * FROM " .$this->table_name. " WHERE branch_id=? LIMIT 0,1";
        
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);
        $statement->bindParam(1, $this->branch_id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // If row found
        if($row){
            // Set values to object properties
            $this->branch_id=$row['branch_id'];
            $this->email=$row['email'];
            $this->phone_no=$row['phone_no'];
            $this->province=$row['province'];
            $this->city=$row['city'];
            $this->street_no=$row['street_no'];
        }
    }

    // Create product
    function create(){

        // Check if customer exists before creating it
        $check_query = "SELECT branch_id FROM " .$this->table_name. " WHERE branch_id=" .$this->branch_id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->branch_id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row){
            return false;
        }
        else{         
            // Query: Insert product        
            $query = "INSERT INTO " .$this->table_name. " SET branch_id=:branch_id, email=:email, phone_no=:phone_no, province=:province, city=:city, street_no=:street_no";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
            $this->province=htmlspecialchars(strip_tags($this->province));
            $this->city=htmlspecialchars(strip_tags($this->city));
            $this->street_no=htmlspecialchars(strip_tags($this->street_no));
        
            // Bind values
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":email", $this->email);
            $statement->bindParam(":phone_no", $this->phone_no);
            $statement->bindParam(":province", $this->province);
            $statement->bindParam(":city", $this->city);
            $statement->bindParam(":street_no", $this->street_no);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;
        }        
    }

    // Update product
    function update(){        

        // Check if customer exists before creating it
        $check_query = "SELECT branch_id FROM " .$this->table_name. " WHERE branch_id=" .$this->branch_id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->branch_id);
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
                        email = :email,
                        phone_no = :phone_no,
                        province = :province,
                        city = :city,
                        street_no = :street_no,
                    WHERE
                        branch_id = :branch_id";

            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
            $this->province=htmlspecialchars(strip_tags($this->province));
            $this->city=htmlspecialchars(strip_tags($this->city));
            $this->street_no=htmlspecialchars(strip_tags($this->street_no));
        
            // Bind values
            $statement->bindParam(":branch_id", $this->branch_id);
            $statement->bindParam(":email", $this->email);
            $statement->bindParam(":phone_no", $this->phone_no);
            $statement->bindParam(":province", $this->province);
            $statement->bindParam(":city", $this->city);
            $statement->bindParam(":street_no", $this->street_no);
            
            // execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete store_branch
    function delete(){

        // Check if customer exists before deleting it
        $check_query = "SELECT branch_id FROM " .$this->table_name. " WHERE branch_id=" .$this->branch_id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->branch_id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{ 
            // Query: Delete store_branch
            $query = "DELETE FROM " .$this->table_name. " WHERE branch_id=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));
        
            // Bind branch_id of the store_branch to be deleted
            $statement->bindParam(1, $this->branch_id);
        
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }
}
?>
