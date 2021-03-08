<?php
   
?>

<!DOCTYPE html>
<html>

<style>
    h2{text-align: center;}
    label{
        display: inline-block;
        width: 150px;
        text-align: right;
    }
    button{text-align: center;}

</style>

    <head>
        <title> Admin Items </title>

        <style type = "text/css">
            body{
                background-image:url(background.png);
                background-size:75%;
                background-attachment:fixed;
            }
        </style>

    </head>
<center>
<body>
    <div class = "container">
        <div class = "header">
            <h2> Add an Item </h2>
        </div>

        <label for = "item"> Item Name: </label>
        <input type = "text" name = "item" required placeholder = "wrench"><br><br>

        <label for = "itype"> Type: </label>
        <input type = "text" name = "itype" required placeholder = "tool"><br><br>

        <label for = "quantity"> Quantity Available: </label>
        <input type = "number" name = "quantity" required min = "0" placeholder = "0"><br><br>

        <label for = "reg_price"> Regular Price: </label>
        <input type = "number" name = "reg_price" required step = "0.01" placeholder ="0.00"><br><br>

        <button type="Submit"> Add Item </button>
    </div>
</body>
</center>
</html>