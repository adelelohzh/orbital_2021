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
            <?php echo "<p class = 'fontsset2'>Hello there, " . $_SESSION["useruid"] . "</p>"; ?>               
        </div>

        <div class = "main-right">
            <p class="fontsset1"></p>
            <div class="dashboard">
            <h1> What's due soon? </h1>
                <ul id = "upcoming-tasks">
                </ul>
            </div>
        </div>

        <?php
            }
        ?>
        
    </div>

    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script language="javascript" type="text/javascript">

    $(document).ready(function() {  

        function loadTasks() {
            $.ajax({ 
                    type: "POST", 
                    url: "retrieve.php", 
                    success: function(data) { 
                        $('#upcoming-tasks').html(data);
                    } 
            });
        }

        loadTasks();
    });

</script>