<?php include('loginServer.php') ?>
<!DOCTYPE html>

<html>
<head>
    <title>Registration</title>
</head>
<body>
    <center>
    <div class = "container">
        <div class = "header">
            <h2> Customer Registration </h2>
            <style>
                .header{
                    position:fixed;
                    top:15%;
                    left:42%;
                    width:250px;
                }
            </style>
        </div>
        <form action = "registration.php" method = "post">
            <?php include('loginErrors.php'); ?>

            <style type = "text/css">
            body{
                background-image:url(background.png);
                background-size:75%;
                background-attachment:fixed;
            }   
            form{
                position:fixed;
                top:25%;
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
                <label for = "username">Enter Username</label>
                <input type = "text" name = "username" required><br />
            </div>

            <div>
                <label for = "first_name">Enter First Name</label>
                <input type = "text" name = "first_name" required><br />
            </div>

            <div>
                <label for = "last_name">Enter Last Name</label>
                <input type = "text" name = "last_name" required><br />
            </div>

            <div>
                <label for = "email">Enter Email</label>
                <input type = "email" name = "email" required><br />
            </div>

            <div>
                <label for = "phone">Enter Phone No</label>
                <input type = "tel" name = "phone" required><br />
            </div>

            <div>
                <label for = "password">Enter Password</label>
                <input type = "password" name = "password_input" required><br />
            </div>

            <div>
                <label for = "password">Confirm Password</label>
                <input type = "password" name = "password_check" required><br />
            </div>

            <button type = "submit" name = "registerCustomer"> Submit </button>

            <p> Registered Customer?  <a href = "login.php"> <b> Customer Login </b></a></p>

        </form>
    </div>
    </center>
</body>
</html>