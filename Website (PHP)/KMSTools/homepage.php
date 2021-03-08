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
    <title> KMS TOOLS HOME PAGE </title>
</head>
<body>
    <center>
    <h1> Welcome to KMS TOOLS </h1>

    <style type = "text/css">
            body{
                background-image:url(background.png);
                background-size:75%;
                background-attachment:fixed;
            }
    </style>
        
    <?php if(isset($_SESSION['success'])) : ?>
    
    <div>
        <h3>
            <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            ?>
        </h3>
    </div>
    <?php endif ?>
    
    <div>
    <!-- Show customer login info -->
    <?php if(isset($_SESSION['username'])): ?>
        
        <h3> Welcome <strong> <?php echo $_SESSION['username']; ?> </strong> </h3>

        <!-- <button> <a href="homepage.php?logout='1'"> </a> </button> -->

    <?php endif ?>
    </div>
    <h3></h3>
    <!-- Homepage options as buttons -->

    <div>
    <!-- 1: Browse items -->
    <button id="browse button" class="float-left submit-button" >BROWSE ITEMS</button>

    <script type="text/javascript">
        document.getElementById("browse button").onclick = function () {
            // Replace with page reference -----------------------------------------------------------------
            location.href = "browseItems.php";
        };
    </script>
    </div>
    
    <h3></h3>
    <div>
    <!-- 1: Reserve -->
    <button id="reserve button" class="float-left submit-button" >RESERVE AN ITEM</button>

    <script type="text/javascript">
        document.getElementById("reserve button").onclick = function () {
            // Replace with page reference -----------------------------------------------------------------
            location.href = "reservation.php";
        };
    </script>
    </div>

    <h3></h3>
    <div>
    <form method="POST">
        <button type = "submit" name = "logout"> LOGOUT </button>
    </form>
    </div>

    </center>
</body>
</html>