<?php
    session_start();
?>

<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleHeader.css">
        <style>
            body {font-family: "Times New Roman", Georgia, Serif;}
            h1, h2, h3, h4, h5, h6 {
                font-family: "Playfair Display";
                letter-spacing: 5px;
            }
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
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco mylogofont blockdisplay">my</a></li>
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco nuslogofont blockdisplay">NUS</a></li>
                </ul>
                <ul class = "header-right">
                    <li class = "nostyle inlineblock"><a href='../Main/Main.php' class = "nodeco blockdisplay">Home</a></li>
                    <li class = "nostyle inlineblock"><a href='../Timetable/Timetable.php' class = "nodeco blockdisplay">Timetable</a></li>
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">To-Do List</a></li>
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">Shuttle Bus</a></li>
                    <li class = "nostyle inlineblock"><a href='../Login_Signup/includes/logout.inc.php' class = "nodeco blockdisplay">Logout</a></li>
                </ul>
        <?php } ?>       
    </div>

    </body>
</html>