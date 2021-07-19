<?php 
    require('database_connection.php');
    $userid = $_SESSION["userid"];

    // $user = $conn -> query("SELECT * FROM users where usersUid = '$useruid'");
    // $currUser = $user->fetch_assoc();
    // $userid = $currUser['usersId'];

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
        case "Saturday":
            $dayOn = 6;
            break;
        case "Sunday":
            $dayOn = 7;
            break;
        default:
            echo "switch statement not working";
    }

    $timetable = $conn -> query("SELECT * FROM schedules");
    $classes = $conn -> query("SELECT * FROM schedules WHERE userId = '$userid' AND dayOn = '$dayOn' ORDER BY startTime ASC");
?>

<?php if (mysqli_num_rows($timetable) > 0) {
            if (mysqli_num_rows($classes) > 0) { ?>

            <?php while($row = $classes->fetch_assoc()) {    
                $start = substr( $row['startTime'], -4 );   
                $end = substr( $row['endTime'], -4 );   
                if ($currentTime >= $start) { // class either started or over alr
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
                } else if ($currentTime <= $start) { ?>
                    <p><?php echo $row['moduleName']?></p>
                    <p><?php echo $row['moduleCode']?></p>
                    <p> At <?php echo $start?> to <?php echo $end?></p>
            <?php   break;
                } else { ?> 
                    <p> No Upcoming Classes Today </p>
            <?php break;
                } 
            } 
        } else { ?> 
            <p> No Upcoming Classes Today </p>
    <?php } 
    } else { ?>
        <div class="emptyTimetable">
            <p class = "line1"> You do not have a timetable <p>
            <p class = "line2"> Start designing your timetable now! <p>
            <a class = 'start' href = '../Timetable/Timetable.php'> START </a>
        </div>
        
    <?php } ?>
    