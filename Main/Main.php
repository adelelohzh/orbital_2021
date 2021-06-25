<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleMain.css">
        <style>
            <?php include '../Header/styleHeader.css'; ?>
        </style>

    <body class = "full grey">
   
    <!-- Main -->
    <div class="main">

        <?php
            include_once '../Header/Header.php';          
            if (!isset($_SESSION["useruid"])) {
        ?>

        <div class="main0">
            <p class="main0-left fontsset1"><a href="../Login_Signup/Signup.php">Sign Up</a></p>
            <p class="main0-right fontsset1"><a href="../Login_Signup/Login.php">Log In</a></p>
        </div>
        
        <?php 
            } else { 
        ?>

        <div class = "main-left">
            <?php echo "<p class = 'fontsset1'>Hello there, " . $_SESSION["usersuid"] . "</p>"; ?>               
        </div>

        <div class = "main-right">
            <p class="fontsset1">What's due soon?</p>
            <div class="dashboard">
                <ul>
                    <li><a href="#">To be linked with to-do list</a></li>
                    <li><a href="#">To be linked with to-do list</a></li>
                    <li><a href="#">To be linked with to-do list</a></li>
                    <li><a href="#">To be linked with to-do list</a></li>
                    <li><a href="#">To be linked with to-do list</a></li>
                </ul>
            </div>
        </div>

        <?php
            }
        ?>
        
    </div>

    </body>
</html>