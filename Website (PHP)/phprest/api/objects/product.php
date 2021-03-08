<?php

class Product{
  
    // Database connection and table name
    private $db;
    private $table_name = "product_type";
  
    // Product properties
    public $SKU;	
    public $type;	
    public $name;	
    public $description;	
    public $additional_info;	
    public $UPC;	
    public $regular_price;	
    public $sale_price;	
    public $club_price;	
    public $quantity;	
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read products
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
            $this->type=$row['type'];	
            $this->name=$row['name'];
            $this->description=$row['description'];
            $this->additional_info=$row['additional_info'];	
            $this->UPC=$row['UPC'];
            $this->regular_price=$row['regular_price'];	
            $this->sale_price=$row['sale_price'];	
            $this->club_price=$row['club_price'];
            $this->quantity=$row['quantity'];
        }
    }

    // Create product
    function create(){

        // Check if product exists before creating it
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
            // Query: Insert product        
            $query = "INSERT INTO " .$this->table_name. " SET SKU=:SKU, type=:type, name=:name, description=:description, additional_info=:additional_info, UPC=:UPC, regular_price=:regular_price, sale_price=:sale_price, club_price=:club_price, quantity=:quantity";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
            $this->type=htmlspecialchars(strip_tags($this->type));	
            $this->name=htmlspecialchars(strip_tags($this->name));	
            $this->description=htmlspecialchars(strip_tags($this->description));	
            $this->additional_info=htmlspecialchars(strip_tags($this->additional_info));	
            $this->UPC=htmlspecialchars(strip_tags($this->UPC));	
            $this->regular_price=htmlspecialchars(strip_tags($this->regular_price));	
            $this->sale_price=htmlspecialchars(strip_tags($this->sale_price));	
            $this->club_price=htmlspecialchars(strip_tags($this->club_price));	
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));	
        
            // Bind values
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":type", $this->type);
            $statement->bindParam(":name", $this->name);
            $statement->bindParam(":description", $this->description);
            $statement->bindParam(":additional_info", $this->additional_info);
            $statement->bindParam(":UPC", $this->UPC);
            $statement->bindParam(":regular_price", $this->regular_price);
            $statement->bindParam(":sale_price", $this->sale_price);
            $statement->bindParam(":club_price", $this->club_price);
            $statement->bindParam(":quantity", $this->quantity);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false;   
        }     
    }

    // Update product
    function update(){ 
        
        // Check if product exists before updating it
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
            // Query: Update product
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        type = :type,
                        name = :name,
                        description = :description,
                        additional_info = :additional_info,
                        UPC = :UPC,
                        regular_price = :regular_price,
                        sale_price = :sale_price,
                        club_price = :club_price,
                        quantity = :quantity
                    WHERE
                        SKU = :SKU";

            // Prepare query statement
            $statement = $this->db->prepare($query);
            
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
            $this->type=htmlspecialchars(strip_tags($this->type));	
            $this->name=htmlspecialchars(strip_tags($this->name));	
            $this->description=htmlspecialchars(strip_tags($this->description));	
            $this->additional_info=htmlspecialchars(strip_tags($this->additional_info));	
            $this->UPC=htmlspecialchars(strip_tags($this->UPC));	
            $this->regular_price=htmlspecialchars(strip_tags($this->regular_price));	
            $this->sale_price=htmlspecialchars(strip_tags($this->sale_price));	
            $this->club_price=htmlspecialchars(strip_tags($this->club_price));	
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));	
            
            // Bind values
            $statement->bindParam(":SKU", $this->SKU);
            $statement->bindParam(":type", $this->type);
            $statement->bindParam(":name", $this->name);
            $statement->bindParam(":description", $this->description);
            $statement->bindParam(":additional_info", $this->additional_info);
            $statement->bindParam(":UPC", $this->UPC);
            $statement->bindParam(":regular_price", $this->regular_price);
            $statement->bindParam(":sale_price", $this->sale_price);
            $statement->bindParam(":club_price", $this->club_price);
            $statement->bindParam(":quantity", $this->quantity);
                
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete Product
    function delete(){

        // Check if product exists before deleting it
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
            // Query: Delete product
            $query = "DELETE FROM " .$this->table_name. " WHERE SKU=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SKU=htmlspecialchars(strip_tags($this->SKU));
        
            // Bind SKU of the product to be deleted
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