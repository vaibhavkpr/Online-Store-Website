<?php include('loginServer.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Login </title>
    </head>
<body>
<center>
    <div class = "container">
        <div class = "header">
            <h2> Admin Login </h2>
            <style>
                .header{
                    position:fixed;
                    top:25%;
                    left:42%;
                    width:250px;
                }
            </style>
        </div>
        <form action = "admin.php" method = "post">      
        <?php include('loginErrors.php'); ?>  

            <style type = "text/css">
            body{
                background-image:url(background.png);
                background-size:75%;
                background-attachment:fixed;
            }   
            form{
                position:fixed;
                top:35%;
                left:42%;
                width:250px;
            }
            </style>

            <!-- Formatting code for input boxes -->
            <style>
            .container {
                width: 500px;
                clear: both;
            }
            .container input {
                width: 100%;
                clear: both;
            }
            </style>
            <div>
                <label for = "username">Username </label>
                <input type = "text" name = "username" required><br>

                <label for = "password">Password </label>
                <input type = "password" name = "password_input" required><br>
            </div>

            <button type="submit" name="loginAdmin"> Login </button>
            <p> Customer?  <a href = "login.php"> <b> Customer Login </b></a></p>
        </form>
    </div>
</center>
</body>
</html>