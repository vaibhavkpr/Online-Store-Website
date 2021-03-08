<?php

class Supplier{
  
    // Database connection and table name
    private $db;
    private $table_name = "supplier";
  
    // supplier properties
    public $id;
    public $name;
    public $phone_no;
    public $email;
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read supplier
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one supplier
    function readOne(){
    
        // Query: Read single supplier entry using SKU
        $query = "SELECT * FROM " .$this->table_name. " WHERE id=? LIMIT 0,1";
        
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        // If row found
        if($row){
            // Set values to object properties
            $this->id=$row['id'];
            $this->name=$row['name'];
            $this->phone_no=$row['phone_no'];
            $this->email=$row['email'];
        }
    }

    // Create supplier
    function create(){

        // Check if customer exists before creating it
        $check_query = "SELECT id FROM " .$this->table_name. " WHERE id=" .$this->id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row){
            return false;
        }
        else{      
            // Query: Insert supplier        
            $query = "INSERT INTO " .$this->table_name. " SET id=:id,  name=:name, phone_no=:phone_no, email=:email";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
            $this->email=htmlspecialchars(strip_tags($this->email));
        
            // Bind values
            $statement->bindParam(":id", $this->id);
            $statement->bindParam(":name", $this->name);
            $statement->bindParam(":phone_no", $this->phone_no);
            $statement->bindParam(":email", $this->email);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;   
        }     
    }

    // Update supplier
    function update(){        

        // Check if customer exists before updating it
        $check_query = "SELECT id FROM " .$this->table_name. " WHERE id=" .$this->id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{         
            // Query: update supplier
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        name = :name,
                        phone_no = :phone_no,
                        email = :email
                    WHERE
                        id = :id";

            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone_no=htmlspecialchars(strip_tags($this->phone_no));
            $this->email=htmlspecialchars(strip_tags($this->email));
        
            // Bind values
            $statement->bindParam(":id", $this->id);
            $statement->bindParam(":name", $this->name);
            $statement->bindParam(":phone_no", $this->phone_no);
            $statement->bindParam(":email", $this->email);
            
            // execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete supplier
    function delete(){

        // Check if product exists before deleting it
        $check_query = "SELECT id FROM " .$this->table_name. " WHERE id=" .$this->id. "";
        $statement = $this->db->prepare($check_query);
        $statement->bindParam(1, $this->id);
        $statement->execute();
    
        // Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return false;
        }
        else{ 
            // Query: Delete product
            $query = "DELETE FROM " .$this->table_name. " WHERE id=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // Bind SKU of the product to be deleted
            $statement->bindParam(1, $this->id);
        
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }
}
?>
