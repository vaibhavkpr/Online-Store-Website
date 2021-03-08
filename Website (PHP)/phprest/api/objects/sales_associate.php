<?php

class Sales_associate{
  
    // Database connection and table name
    private $db;
    private $table_name = "sales_associate";
  
    // Employee properties
    public $SID;
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $section;
  
    // Constructor sets $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    // Read sales_associates
    function read(){
    
        // Query: Select All
        $query = "SELECT * FROM " .$this->table_name;
    
        // Prepare and execute query statement
        $statement = $this->db->prepare($query);    
        $statement->execute();
    
        return $statement;
    }

    // Read one sales_associate
    function readOne(){
    
        // Query: Read single sales_associate entry using SID
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
            $this->SID=$row['SID'];
            $this->type=$row['first_name'];
            $this->last_name=$row['last_name'];
            $this->username = $row['username'];
            $this->password=$row['password'];
            $this->section=$row['section'];
        }
    }

    // Create sales_associate
    function create(){

        // Check if sales_associate exists before creating it
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
            // Query: Insert sales_associate        
            $query = "INSERT INTO " .$this->table_name. " SET SID=:SID, first_name=:first_name, last_name=:last_name, username=:username, password=:password, section=:section";

            // Prepare query
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SID=htmlspecialchars(strip_tags($this->SID));
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));
            $this->last_name=htmlspecialchars(strip_tags($this->last_name));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->section=htmlspecialchars(strip_tags($this->section));
        
            // Bind values
            $statement->bindParam(":SID", $this->SID);
            $statement->bindParam(":first_name", $this->first_name);
            $statement->bindParam(":last_name", $this->last_name);
            $statement->bindParam(":username", $this->username);
            $statement->bindParam(":password", $this->password);
            $statement->bindParam(":section", $this->section);
        
            // Execute query
            if($statement->execute()){
                return true;
            }    
            return false; 
        }       
    }

    // Update sales_associate
    function update(){        

        // Check if sales_associate exists before creating it
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
            // Query: update sales_associate
            $query = "UPDATE
                        " .$this->table_name. "
                    SET
                        first_name = :first_name,
                        last_name = :last_name,
                        username = :username,
                        password = :password,
                        section = :section,
                    WHERE
                        SID = :SID";

            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SID=htmlspecialchars(strip_tags($this->SID));
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));
            $this->last_name=htmlspecialchars(strip_tags($this->last_name));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->section=htmlspecialchars(strip_tags($this->section));
        
            // Bind values
            $statement->bindParam(":SID", $this->SID);
            $statement->bindParam(":first_name", $this->first_name);
            $statement->bindParam(":last_name", $this->last_name);
            $statement->bindParam(":username", $this->username);
            $statement->bindParam(":password", $this->password);
            $statement->bindParam(":section", $this->section);
            
            // execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Delete sales_associate
    function delete(){

        // Check if customer exists before deleting it
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
            // Query: Delete sales_associate
            $query = "DELETE FROM " .$this->table_name. " WHERE SID=?";
        
            // Prepare query statement
            $statement = $this->db->prepare($query);
        
            // Clean up
            $this->SID=htmlspecialchars(strip_tags($this->SID));
        
            // Bind SID of the sales_associate to be deleted
            $statement->bindParam(1, $this->SID);
        
            // Execute the query
            if($statement->execute()){
                return true;
            }    
            return false;
        }
    }

    // Check if given username exists in the database
    function usernameCheck(){
    
        // Query to check if username exists
        $query = "SELECT * FROM " .$this->table_name. " WHERE username=? LIMIT 0,1";
    
        // prepare the query
        $statement = $this->db->prepare( $query );
    
        // Clean up and Bind
        $this->username=htmlspecialchars(strip_tags($this->username));
        $statement->bindParam(1, $this->username);
    
        // Execute the query
        $statement->execute();
    
        // Get number of rows
        $num = $statement->rowCount();
    
        // if username exists, assign values to object properties 
        if($num>0){
    
            // get record details / values
            $row = $statement->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->username = $row['username'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->password = $row['password'];
            $this->section = $row['section'];
            $this->SID = $row['SID'];
    
            // Return true because username exists in the database
            return true;
        }    
        // Return false if username does not exist in the database
        return false;
    }
}
?>
