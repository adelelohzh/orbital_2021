<?php
    session_start();
?>

<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleHeader.css">
        <link rel="stylesheet" href="styleMain.css">
        <style>
            <?php include 'styleHeader.css'; ?>
        </style>

    <body class = "full grey">
     
    <!-- Header -->
    <div class = "header">
        <?php if (!isset($_SESSION["useruid"])) { ?>
                <ul class = "header-left">
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco mylogofont blockdisplay">my</a></li>
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco nuslogofont blockdisplay">NUS</a></li>
                </ul>
        <?php } else { ?>
                <ul class = "header-left">
                    <li class = "nostyle inlineblock leftfloat centered"><a href='#' class = "nodeco mylogofont blockdisplay">my</a></li>
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco nuslogofont blockdisplay">NUS</a></li>
                </ul>
                <ul class = "header-right">
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">Home</a></li>
                    <li class = "nostyle inlineblock"><a href='../Timetable/Timetable.php' class = "nodeco blockdisplay">Timetable</a></li>
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">To-Do List</a></li>
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">Shuttle Bus</a></li>
                    <li class = "nostyle inlineblock"><a href='../Login_Signup/includes/logout.inc.php' class = "nodeco blockdisplay">Logout</a></li>
                </ul>
        <?php } ?>       
    </div>
    <!-- End of header -->
    <!-- Main -->
    <div class="main">

        <div class = "main-left">
            <p class="fontsset1">
                Welcome Back, <br> Adele.
            </p>
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

    </div>

    </div> <!-- Container end -->
    </body>
</html>