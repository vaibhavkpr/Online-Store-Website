<?php

    session_start();

    // Check if customer is logged in
    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "Login to continue!";
        header("location: login.php"); 
    }

    if(isset($_POST['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title> Reservation </title>
</head>
<body>
    <center>
    <h1> Reserve Product </h1>

    <style type = "text/css">
            body{
                background-image:url(background.png);
                background-size:75%;
                background-attachment:fixed;
            }
    </style>

    <form method="post" action="insert_course.php">
    
        Product ID :<input type="text" name="pid" required><br/>
        <h3></h3>
        Quantity :<input type="number" name="quantity" required><br/>
        <h3></h3>

        <input type="submit" name="reserve" value="Reserve?">

    </form>

    <h3> </h3>
    <div>
    <!-- Return to Home Button -->
    <button id="home button" class="float-left submit-button" >Home</button>

    <script type="text/javascript">
        document.getElementById("home button").onclick = function () {
            // Replace with page reference -----------------------------------------------------------------
            location.href = "homepage.php";
        };
    </script>
    </div>

    </center>
</body>
</html>