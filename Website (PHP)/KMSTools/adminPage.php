<?php

    session_start();

    // Check if customer is logged in
    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "Login to continue!";
        header("location: admin.php"); 
    }

    if(isset($_POST['adminLogout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("location: admin.php");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title> KMS TOOLS ADMIN PAGE </title>

    <style type = "text/css">
            body{
                background-image:url(background.png);
                background-size:75%;
                background-attachment:fixed;
            }
    </style>

</head>
<body>
    <center>
    <h1> KMS TOOLS ADMIN </h1>

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
    <!-- Show admin login info -->
    <?php if(isset($_SESSION['username'])): ?>
        
        <h3> Welcome <strong> <?php echo $_SESSION['username']; ?> </strong> </h3>
        <!-- <button> <a href="homepage.php?logout='1'"> </a> </button> -->

    <?php endif ?>
    </div>
    <h3></h3>
    <!-- Admin options as buttons -->

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
    <!-- 1: Add items -->
    <button id="add button" class="float-left submit-button" >Add AN ITEM TO INVENTORY</button>

    <script type="text/javascript">
        document.getElementById("add button").onclick = function () {
            // Replace with page reference -----------------------------------------------------------------
            location.href = "addItem.php";
        };
    </script>
    </div>

    <h3></h3>
    <div>
    <form method="POST">
        <button type = "submit" name = "adminLogout"> LOGOUT </button>
    </form>
    </div>

    </center>
</body>
</html>