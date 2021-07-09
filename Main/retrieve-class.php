<?php 
    require('database_connection.php');
    $useruid = $_SESSION["useruid"];

    $user = $conn -> query("SELECT * FROM users where usersUid = '$useruid'");
    $currUser = $user->fetch_assoc();
    $userid = $currUser['usersid'];

    date_default_timezone_set('Singapore');

    $todayDay = date('l');
    $currentTime = date("H:i");

    switch($todayDay) {
        case "Monday":
            $dayOn = 1;
            break;
        case "Tuesday":
            $dayOn = 2;
            break;
        case "Wednesday":
            $dayOn = 3;
            break;
        case "Thursday":
            $dayOn = 4;
            break;
        case "Friday":
            $dayOn = 5;
            break;
        default:
            echo "switch statement not working";
    }

    $classes = $conn -> query("SELECT * FROM schedules WHERE userId = '$userid' AND dayOn = '$dayOn' ORDER BY startTime ASC");
?>

<?php if (mysqli_num_rows($classes) > 0) { ?>
        <?php while($row = $classes->fetch_assoc()) {       
            if ($currentTime >= $row['startTime']) { // class either started or over alr
                if ($currentTime <= $row['endTime']) { ?>  
                    <p style = "font-size: 30px;"><?php echo $row['moduleName']?></p>
                    <p><?php echo $row['moduleCode']?></p>
                    <p> NOW &nbsp; — &nbsp;From <?php echo $row['startTime']?> to <?php echo $row['endTime']?></p>
                <?php 
                    break;
                } else { ?>
                    <p> No Upcoming Classes Today </p> 
        <?php       break;
                }
            } else if ($currentTime <= $row['startTime']) { ?> 
                <p><?php echo $row['moduleName']?></p>
                <p><?php echo $row['moduleCode']?></p>
                <p> At <?php echo $row['startTime']?> to <?php echo $row['endTime']?></p>
        <?php   break;
            } else { ?> 
                <p> No Upcoming Classes Today </p>
        <?php break;
            } 
        } 
    } else { ?> 
        <p> No Upcoming Classes Today </p>
<?php } ?>
    