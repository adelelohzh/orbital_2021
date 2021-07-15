<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleSignupLogin.css">
        <style>
            <?php include '../Header/styleHeader.css'; ?>
        </style>

    <body class = "full grey">
    <?php include_once '../Header/Header.php'; ?>
    
    <div class="form">
        <p class="title fontsset1">Log In</p>
        <p class = "member"> Not a member? <a href = 'Signup.php'>Sign up</a></p>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">Log In</button>
        </form>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p class = 'error-message fontsset1'>Not all fields were filled in!</p>";
        } else if ($_GET["error"] == "wronglogin") {
            echo "<p class = 'error-message fontsset1'>Username or password is incorrect!</p>";
        }
    }
    ?>
    </div>
    </body>
</html>